<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetLoan;
use App\Customer;
use App\Facility;
use App\Installment;
use App\Interest;
use App\Loan;
use App\LoanSchedule;
use App\Penalty;
use App\Reject;
use App\Repayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\LoanRequest;
use RealRashid\SweetAlert\Facades\Alert;

class LoanController extends Controller
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
        $loans=Loan::where('status','!=','106')->get();
        return view('loans.index',compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rates=Interest::all();
        $facilities=Facility::all();
        $frequencies=Repayment::all();
        $assets=Asset::where('status','102')->get();
        return view('loans.create',compact('rates','facilities','frequencies','assets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request)
    {
        $loan=new Loan();
        $latestLoan = Loan::orderby('created_at','DESC')->first();
        $checkClient=Customer::where('national_id',$request->input('client_id'))->exists();
        if($latestLoan==null){
            $loan->loan_id = 'LD' . str_pad(1, 7, "0", STR_PAD_LEFT);
        }
        else {
            $loan->loan_id = 'LD' . str_pad($latestLoan->id + 1, 7, "0", STR_PAD_LEFT);
        }
        if(!$checkClient){
            Alert::error("Error","We have no reference for a client with ID ".$request->input('client_id'))->showConfirmButton('Close', '#b92b27');
                return redirect()->route('myLoans');
        }
        $account=Customer::where('national_id',$request->input('client_id'))->first();
        $loan->account_number=$account->account;
        $loan->client_id=$request->input('client_id');
        $loan->loan_amount=$request->input('loan_amount');
        $loan->establishment_date=$request->input('establishment_date');
        $loan->end_date=$request->input('end_date');
        $loan->period=$request->input('period');
        $loan->repayment_frequency=$request->input('repayment_frequency');
        $loan->applicable_interest=$request->input('applicable_interest');
        $loan->applicable_penalt=$request->input('applicable_penalt');
        $loan->collateral=$request->input('collateral');
        $loan->total_amount_payable=$request->input('total_amount_payable');
        $loan->outstanding=$request->input('total_amount_payable');
        $loan->total_installments=$request->input('total_installments');
        $loan->facility_category=$request->input('facility_category');
        $loan->captured_by=auth()->user()->name;
        $loan->branch=auth()->user()->branch;
        $loan->installment_amount=$request->input('installment_amount');
        $loan->save();

        foreach ($request->asset_number as $nums){
            $assetLoan=new AssetLoan();
            $assetLoan->loan_id=$loan->loan_id;
            $assetLoan->asset_number=$nums;
            $ass = Asset::where('asset_number',$nums)->first();
            $ass->status = '101';
            $ass->save();
            $assetLoan->save();
        }

        if($loan->repayment_frequency=='12'){
          $due=30;
        }
        elseif($loan->repayment_frequency=='2'){
            $due=180;
        }
        elseif($loan->repayment_frequency=='4'){
            $due=90;
        }
        else{
            $due=365;
        }
        $penalt=new Penalty();
        $penalt->loan_id=$loan->loan_id;
        $penalt->remaining_installments=$loan->total_installments;
        $penalt->installment_fee=$loan->installment_amount;
        $penalt->frequency=$loan->repayment_frequency;
        $penalt->cleared_installments=0;
        $penalt->penalty_fee=0;
        $penalt->due_date=Carbon::createFromDate($loan->establishment_date)->addDays($due);
        $penalt->save();
        for($i=1;$i<=$loan->total_installments;$i++) {
            $schedule = new LoanSchedule();
            $check=LoanSchedule::where('loan_id',$loan->loan_id)->exists();
            if($check){
                usleep(250000);
                $latestId= LoanSchedule::where('loan_id',$loan->loan_id)->orderby('created_at','DESC')->first();
                $schedule->loan_id = $loan->loan_id;
                $schedule->period=$i;
                $schedule->opening_balance=$latestId->closing_balance;
                $schedule->interest=round(($loan->applicable_interest/$loan->repayment_frequency)*($schedule->opening_balance),2);
                $schedule->installment=$loan->installment_amount;
                $schedule->capital_repayment=round($schedule->installment-$schedule->interest,2);
                $schedule->closing_balance=round($schedule->opening_balance-$schedule->capital_repayment,2);
                $schedule->start_date=Carbon::now();
                $schedule->end_date=Carbon::now();
                $schedule->save();
            }
            else {
                $schedule->loan_id = $loan->loan_id;
                $schedule->period = $i;
                $schedule->opening_balance = $loan->loan_amount;
                $schedule->interest =round( ($loan->applicable_interest/$loan->repayment_frequency) * ($schedule->opening_balance),2);
                $schedule->installment = $loan->installment_amount;
                $schedule->capital_repayment = round($schedule->installment - $schedule->interest,2);
                $schedule->closing_balance = round($schedule->opening_balance - $schedule->capital_repayment,2);
                $schedule->start_date = Carbon::now();
                $schedule->end_date = Carbon::now();
                $schedule->save();
            }
        }

        return redirect()->route('myLoans')->withSuccessMessage("Loan application sent for Authorisation");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
       $client=Customer::where('national_id',$loan->client_id)->first();
       $assets=AssetLoan::where('loan_id',$loan->loan_id)->get();
       $installments=Installment::where('loan_id',$loan->loan_id)->get();
       $schedules=LoanSchedule::where('loan_id',$loan->loan_id)->get();
       return view('loans.show',compact('loan','client','assets','installments','schedules'));
    }

    public function authorizeLoan(Loan $loan){
        if(auth()->user()->name==$loan->captured_by){
            Alert::error('Error', "You cannot authorize a loan that you have captured yourself, ask your supervisor to authorize for you")->showConfirmButton('Close', '#b92b27');
            return back();
        }
        if($loan->status!='103'){
            Alert::error('Error', "You can only authorize a loan which is awaiting authorisation and not otherwise")->showConfirmButton('Close', '#b92b27');
            return back();
        }
        if(auth()->user()->branch!=$loan->branch){
            Alert::error('Error', "This loan was opened under a different branch than you are. Ask someone from ".$loan->branch." to authorize the loan")->showConfirmButton('Close', '#b92b27');
            return back();
        }
        $loan->status="104";
        $loan->authorised_by=auth()->user()->name;
        $loan->save();
        $assetLoan=AssetLoan::where('loan_id',$loan->loan_id)->get();
        foreach ($assetLoan as $nums){
            $ass = Asset::where('asset_number',$nums->asset_number)->first();
            if($ass) {
                $ass->status = "100";
                $ass->save();
            }
        }
       return redirect()->route('loans')->withSuccessMessage("Loan ".$loan->loan_id." Successfully authorized");
    }

    public function rejectLoan(Loan $loan){
    if($loan->status!='103' or $loan->status=='106' ){
        Alert::error('Error', "You can only rollback a loan if it is waiting for authorisation")->showConfirmButton('Close', '#b92b27');
        return back();
    }

    if(auth()->user()->branch!=$loan->branch){
        Alert::error('Error', "This loan was opened under a different branch than you are. Ask supervisor from ".$loan->branch." to reject the loan")->showConfirmButton('Close', '#b92b27');
        return back();
    }
        if(auth()->user()->name!=$loan->captured_by){
            Alert::error('Error', "You can only roll back a loan that you have captured")->showConfirmButton('Close', '#b92b27');
            return back();
        }
    $loan->status="106";
    $loan->authorised_by=auth()->user()->name;
    $loan->save();

        $reject=new Reject();
        $reject->account_number=$loan->account_number;
        $reject->loan_id=$loan->loan_id.str_random(4);
        $reject->client_id=$loan->client_id;
        $reject->loan_amount=$loan->loan_amount;
        $reject->establishment_date=$loan->establishment_date;
        $reject->end_date=$loan->end_date;
        $reject->period=$loan->period;
        $reject->repayment_frequency=$loan->repayment_frequency;
        $reject->applicable_interest=$loan->applicable_interest;
        $reject->applicable_penalt=$loan->applicable_penalt;
        $reject->collateral=$loan->collateral;
        $reject->total_amount_payable=$loan->total_amount_payable;
        $reject->status=$loan->status;
        $reject->authorised_by=$loan->authorised_by;
        $reject->paid_amount=$loan->paid_amount;
        $reject->outstanding=$loan->outstanding;
        $reject->total_installments=$loan->total_installments;
        $reject->facility_category=$loan->facility_category;
        $reject->captured_by=$loan->captured_by;
        $reject->branch=$loan->branch;
        $reject->installment_amount=$loan->installment_amount;
        $reject->save();
        $loan->delete();
        $pena=Penalty::where('loan_id',$loan->loan_id)->first();
        $pena->delete();
        $assetLoan=AssetLoan::where('loan_id',$loan->loan_id)->get();
        foreach ($assetLoan as $nums){
            $ass = Asset::where('asset_number',$nums->asset_number)->first();
            if($ass) {
                $ass->status = "102";
                $ass->save();
            }
            $nums->delete();
        }

       $sheds=LoanSchedule::where('loan_id',$loan->loan_id)->get();
        foreach ($sheds as $shed){
            $shed->delete();
        }
    return redirect()->route('loans')->withSuccessMessage("Loan ".$loan->loan_id." Successfully rolled back");

}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
        Alert::error('Info', "Loan Information cannot be modified, contact the administrator")->showConfirmButton('Close', '#b92b27');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
        Alert::error('Info', "Nothing to update")->showConfirmButton('Close', '#b92b27');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
        Alert::error('Error', "Loan cannot be deleted")->showConfirmButton('Close', '#b92b27');
        return back();
    }
}
