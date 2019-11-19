<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Customer;
use App\Http\Requests\InstallmentRequest;
use App\Installment;
use App\Loan;
use App\Penalty;
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
        $checkClient=Customer::where('national_id',$request->input('client_id'))->exists();
        if($checkClient) {
            $checkLoan=Loan::where('loan_id',$request->input('loan_id'))->exists();
            if($checkLoan) {
                $installment = new Installment();
                $installment->client_id = $request->input('client_id');
                $installment->loan_id = $request->input('loan_id');
                $installment->account_number = $request->input('account_number');
                $installment->amount = $request->input('amount');
                $installment->currency = $request->input('currency');
                $installment->installment_number = $request->input('installment_number');
                $installment->ft_reference=$request->input('ft_reference');
                $installment->captured_by = auth()->user()->name;
                $loan=Loan::where('loan_id',$installment->loan_id)->first();
                if($loan){
                    if($loan->status=='106' or $loan->status=='107' or $loan->status=='103'){
                        Alert::error('Error', "You cannot pay installments for this loan.Either the loan was fully paid, rejected or awaiting authorisation. Please verify ".$installment->loan_id)->showConfirmButton('Close', '#b92b27');
                        return back()->withInput();
                    }
                    $loan->paid_amount=$loan->paid_amount+$installment->amount;
                    $loan->outstanding=$loan->outstanding-$installment->amount;
                    $loan->status='105';
                    $loan->save();
                }
                $installment->save();
                //put the code that modifies penalty table
                if($request->input('over_payment')!=null) {
                    $penaltLoan = Penalty::where('loan_id', $installment->loan_id)->first();
                    $installments=$request->input('installments');
                    $penaltLoan->remaining_installments=$penaltLoan->remaining_installments-$installments;
                    $penaltLoan->cleared_installments=$penaltLoan->cleared_installments+$installments;
                    $penaltLoan->last_payment=Carbon::now();
                    $penaltLoan->due_date=Carbon::createFromDate($penaltLoan->due_date)->addDays($installment->days($penaltLoan->frequency)*($installments-1));
                   $penaltLoan->penalty_fee=0;
                    $penaltLoan->save();
                }
                else{
                    $penaltLoan = Penalty::where('loan_id', $installment->loan_id)->first();
                    $penaltLoan->remaining_installments=$penaltLoan->remaining_installments-1;
                    $penaltLoan->cleared_installments=$penaltLoan->cleared_installments+1;
                    $penaltLoan->last_payment=Carbon::now();
                    $penaltLoan->due_date=Carbon::createFromDate($penaltLoan->due_date)->addDays($installment->days($penaltLoan->frequency));
                    $penaltLoan->penalty_fee=0;
                    $penaltLoan->save();
                }

                return redirect()->route('installments')->withSuccessMessage("Installment Recorded");
            }
            else{
                Alert::error("Error","Please verify Loan ID and try again")->showConfirmButton('Close', '#b92b27');
                return back()->withInput();
            }
        }
        else{
            Alert::error("Error","The client ID Number Does not exist. Please verify and try again")->showConfirmButton('Close', '#b92b27');
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
        Alert::info("Info","Nothing to show for client id ".$installment->client_id)->showConfirmButton('Close', '#6dd5ed');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function edit(Installment $installment)
    {

        return view('installments.edit',compact('installment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Installment $installment)
    {
        //
        try {
            $checkClient=Customer::where('national_id',$request->input('client_id'))->exists();
            if($checkClient) {
                $installment->update([
                    'client_id' => $request['client_id'],
                    'loan_id' => $request['loan_id'],
                    'account_number' => $request['account_number'],
                    'amount' => $request['amount'],
                    'currency' => $request['currency'],
                    'installment_number' => $request['installment_number'],
                    'ft_reference'=>$request['ft_reference'],
                    'captured_by' => $request['captured_by']
                ]);
                return redirect()->route('installments')->withSuccessMessage("Installment Details Successfully Updated");
            }
            else{
                Alert::error("Error","Client Id Number doest exist in our records")->showConfirmButton('Close', '#b92b27');
                return back()->withInput();
            }
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
        $installment->delete();
        return redirect()->route('installments')->withSuccessMessage("Installment Successfully reversed");
    }
}
