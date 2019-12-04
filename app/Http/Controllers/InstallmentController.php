<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Customer;
use App\Http\Requests\InstallmentRequest;
use App\Installment;
use App\Loan;
use App\LoanSchedule;
use App\Notifications\AuthorizeInstallment;
use App\Notifications\AuthorizeLoan;
use App\Penalty;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('success_message')){
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        }
        $installments=Installment::all();
        return view('installments.index',compact('installments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $currency=Currency::where('currency_code','840')->first();
        return view('installments.create',compact('currency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstallmentRequest $request)
    {
        //
            $checkLoan=Loan::where('loan_id',$request->input('loan_id'))->exists();
            if($checkLoan) {
                $installment = new Installment();
                $installment->loan_id = $request->input('loan_id');
                $installment->amount = $request->input('amount');
                $installment->currency = $request->input('currency');
                $installment->ft_reference=$request->input('ft_reference');
                $installment->effective_date=$request->input('effective_date');
                $installment->status='103';
                $installment->captured_by = auth()->user()->name;

                $loan=Loan::query()->where('loan_id',$installment->loan_id)->first();
                if($loan){
                    if($loan->status=='106' or $loan->status=='107' or $loan->status=='103'){
                        Alert::error('Error', "You cannot pay installments for this loan.Either the loan was fully paid, rolled back or awaiting authorisation. Please verify ".$installment->loan_id)->showConfirmButton('Close', '#b92b27');
                        return back()->withInput();
                    }
                }
                $installment->save();

                //Code to send authorisation notification
                $users=User::query()->where('branch',auth()->user()->branch)->role('authorizer')->get();
                foreach($users as $user){
                    $us=new User();
                    $us->email=$user->email;
                    $us->notify(new AuthorizeInstallment($user,$installment));
                }
                return redirect()->route('installments')->withSuccessMessage("Installment Recorded");
            }
            else{
                Alert::error("Error","Please verify Loan ID and try again")->showConfirmButton('Close', '#b92b27');
                return back()->withInput();
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function show(Installment $installment)
    {
        //
        Alert::info("Info","Nothing to show for Loan id ".$installment->loan_id)->showConfirmButton('Close', '#6dd5ed');
        return back();
    }
    public function clientId(Loan $loan)
    {
        //
      $loan=Loan::where('loan_id',$loan)->first();
      return $loan->client_id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function edit(Installment $installment)
    {
        Alert::error("Error","Contact the administrator for assistance if you want to modify installment details")->showConfirmButton('Close', '#b92b27');
        return back();
        //return view('installments.edit',compact('installment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */

    public function authorizeInstallment(Installment $installment)
    {
        //
        try {
            if($installment->status!='103'){
                Alert::error("Error","This installment was previously authorised by ".$installment->authorised_by)->showConfirmButton('Close', '#b92b27');
                return back();
            }
                $installment->update([
                    'status' => '109',
                    'authorised_by' => auth()->user()->name,
                ]);
           //update loan outstanding balance code was previously here

            // record penalty
            $penaltLoan = Penalty::query()->where('loan_id', $installment->loan_id)->first();
            $penaltLoan->remaining_installments=$penaltLoan->remaining_installments-1;
            $penaltLoan->cleared_installments=$penaltLoan->cleared_installments+1;
            $penaltLoan->last_payment=Carbon::now();
            $penaltLoan->due_date=Carbon::createFromDate($penaltLoan->due_date)->addDays($installment->days($penaltLoan->frequency));
            $penaltLoan->penalty_fee=0;
            $penaltLoan->save();

        //Calculate loan amortization schedule
            $schedule= LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('status',false)->first();
            if($schedule){
                if($installment->amount==round($schedule->installment,2)){
                    $schedule->paid_amount=$installment->amount;
                    $schedule->status=true;
                    $schedule->save();
                    //update outstanding loan balance to come here
                    $loan=Loan::query()->where('loan_id',$installment->loan_id)->first();
                    $loan->paid_amount=$loan->paid_amount+$installment->amount;
                    $loan->outstanding=$loan->total_amount_payable-$loan->paid_amount;
                    $loan->status='105';
                    $loan->save();
                }
                elseif ($installment->amount>round($schedule->installment,2)){
                    $schedule->paid_amount=$installment->amount;
                    $schedule->status=true;
                    $schedule->capital_repayment=$schedule->paid_amount-$schedule->interest;
                    $schedule->closing_balance=round($schedule->opening_balance-$schedule->capital_repayment,4);
                    $schedule->save();

                    $loanDetails=Loan::query()->where('loan_id',$schedule->loan_id)->first();
                    $period=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('status',false)->first();
                    $remainingPeriods=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('status',false)->count();
                    $numberOfPeriods=LoanSchedule::query()->where('loan_id',$installment->loan_id)->count();
                    $newInstallment=($schedule->closing_balance*($loanDetails->applicable_interest/$loanDetails->repayment_frequency))/(1-(pow(1+($loanDetails->applicable_interest/$loanDetails->repayment_frequency),-$remainingPeriods)));

                    for($i=$period->period;$i<=$numberOfPeriods;$i++){
                        usleep(250000);
                        $begin=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('status',false)->where('period','=',$i)->orderby('created_at','ASC')->first();
                        if($i==$period->period){
                            $latest=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('status',true)->orderby('created_at','DESC')->first();
                            $begin->opening_balance=$latest->closing_balance;
                            $begin->interest =($loanDetails->applicable_interest / $loanDetails->repayment_frequency) * ($begin->opening_balance);
                            $begin->installment = $newInstallment;
                            $begin->capital_repayment = $begin->installment - $begin->interest;
                            $begin->closing_balance = round($begin->opening_balance - $begin->capital_repayment,4);
                            $begin->save();
                        }
                        else {
                            $begins=LoanSchedule::query()->where('loan_id',$installment->loan_id)->orderby('updated_at','DESC')->first();
                            $begin->opening_balance=$begins->closing_balance;
                            $begin->interest = ($loanDetails->applicable_interest / $loanDetails->repayment_frequency) * ($begin->opening_balance);
                            $begin->installment = $newInstallment;
                            $begin->capital_repayment = $begin->installment - $begin->interest;
                            $begin->closing_balance = round($begin->opening_balance - $begin->capital_repayment,4);
                            $begin->save();
                        }
                    }
                    //update outstanding loan balance and total payable to come here
                    $loan=Loan::query()->where('loan_id',$installment->loan_id)->first();
                    $sumTotal=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('interest','>',0)->sum('interest');
                    $sumPena=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('overdue','>',0)->sum('overdue');
                    $loan->paid_amount=$loan->paid_amount+$installment->amount;
                    $loan->outstanding=$schedule->closing_balance+($schedule->closing_balance*($loan->applicable_interest/$loan->repayment_frequency));
                    $loan->status='105';
                    $loan->total_amount_payable=$loan->loan_amount+$sumTotal+$sumPena;
                    $loan->save();
                }
                else{
                    $LD=Loan::query()->where('loan_id',$schedule->loan_id)->first();
                    $schedule->paid_amount=$installment->amount;
                    $schedule->status=true;
                    $schedule->overdue+=($schedule->installment-$schedule->paid_amount)+($schedule->installment-$schedule->paid_amount)*$LD->applicable_penalt;
                    $schedule->capital_repayment=$schedule->paid_amount-$schedule->interest;
                    $schedule->closing_balance=round($schedule->opening_balance+$schedule->overdue-$schedule->capital_repayment,4);
                    $schedule->save();

                    $loanDetails=Loan::query()->where('loan_id',$schedule->loan_id)->first();
                    $period=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('status',false)->first();
                    $remainingPeriods=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('status',false)->count();
                    $numberOfPeriods=LoanSchedule::query()->where('loan_id',$installment->loan_id)->count();
                    $newInstallment=($schedule->closing_balance*($loanDetails->applicable_interest/$loanDetails->repayment_frequency))/(1-(pow(1+($loanDetails->applicable_interest/$loanDetails->repayment_frequency),-$remainingPeriods)));

                    for($i=$period->period;$i<=$numberOfPeriods;$i++){
                        usleep(250000);
                        $begin=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('status',false)->where('period','=',$i)->orderby('created_at','ASC')->first();
                        if($i==$period->period){
                            $latest=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('status',true)->orderby('created_at','DESC')->first();
                            $begin->opening_balance=$latest->closing_balance;
                            $begin->interest = ($loanDetails->applicable_interest / $loanDetails->repayment_frequency) * ($begin->opening_balance);
                            $begin->installment = $newInstallment;
                            $begin->capital_repayment = $begin->installment - $begin->interest;
                            $begin->closing_balance = round($begin->opening_balance - $begin->capital_repayment,4);
                            $begin->save();
                        }
                        else {
                            $begins=LoanSchedule::query()->where('loan_id',$installment->loan_id)->orderby('updated_at','DESC')->first();
                            $begin->opening_balance=$begins->closing_balance;
                            $begin->interest = ($loanDetails->applicable_interest / $loanDetails->repayment_frequency) * ($begin->opening_balance);
                            $begin->installment = $newInstallment;
                            $begin->capital_repayment = $begin->installment - $begin->interest;
                            $begin->closing_balance = round($begin->opening_balance - $begin->capital_repayment,4);
                            $begin->save();
                        }
                    }
                    //update outstanding balance and total payable
                    $loan=Loan::query()->where('loan_id',$installment->loan_id)->first();
                    $sumTotal=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('interest','>',0)->sum('interest');
                    $sumPena=LoanSchedule::query()->where('loan_id',$installment->loan_id)->where('overdue','>',0)->sum('overdue');
                    $loan->paid_amount=$loan->paid_amount+$installment->amount;
                    $loan->outstanding=$schedule->closing_balance+($schedule->closing_balance*($loan->applicable_interest/$loan->repayment_frequency));
                    $loan->status='105';
                    $loan->total_amount_payable=$loan->loan_amount+($sumTotal+$sumPena);
                    $loan->save();
                    //dd($loan->total_amount_payable);
                }

            }
            return redirect()->route('installments')->withSuccessMessage("Installment Successfully Authorised");
        }
        catch(\Exception $ex){
            Alert::error("Error",$ex)->showConfirmButton('Close', '#b92b27');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Installment $installment)
    {
        Alert::error("Error","Installment Details cannot be deleted once captured, contact the administrator for assistance")->showConfirmButton('Close', '#b92b27');
        return back();
//        $installment->delete();
//        return redirect()->route('installments')->withSuccessMessage("Installment Successfully reversed");
    }
}
