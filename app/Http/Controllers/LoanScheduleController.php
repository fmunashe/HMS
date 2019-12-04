<?php

namespace App\Http\Controllers;

use App\AssetLoan;
use App\Customer;
use App\Installment;
use App\Loan;
use App\LoanSchedule;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoanScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $schedules=LoanSchedule::where('loan_id','=',null)->get();
        $loan=Loan::where('loan_id',null)->first();
        return view('schedules.index',compact('schedules','loan'));
    }

    public function searchLoan(Request $request)
    {
        $check = $request->input('searchLoan');
        if (trim($check) == null) {
            Alert::error("Search String cannot be empty");
            return back();
        }
        $schedules = LoanSchedule::where('loan_id', '=', $request->input('searchLoan'))->get();
        if ($schedules) {
            $loan=Loan::where('loan_id',$request->input('searchLoan'))->first();
            return view('schedules.index', compact('schedules','loan'));
        } else {
            Alert::error("Loan Id could not be found");
            return back();
        }
    }

    public function maturity(){
        $loans=Loan::all();
        return view('schedules.maturity',compact('loans'));
    }

    public function searchMaturity(Request $request){
        $check=$request->input('searchLoan');
        if(trim($check)==null){
            alert::error("Query String cannot be empty");
            return redirect()->route('maturityReport');
        }

        $loans=Loan::where('loan_id','=',$request->input('searchLoan'))->orWhere('client_id',$request->input('searchLoan'))->orWhere('branch',$request->input('searchLoan'))->orWhere('facility_category',$request->input('searchLoan'))->orderby('created_at')->paginate(500);
        return view('schedules.maturity',compact('loans'));
    }


    public function showMaturity(loan $loan){
        $client=Customer::where('national_id',$loan->client_id)->first();
        $assets=AssetLoan::where('loan_id',$loan->loan_id)->get();
        $installments=Installment::where('loan_id',$loan->loan_id)->get();
        $schedules=LoanSchedule::where('loan_id',$loan->loan_id)->get();
        return view('schedules.show',compact('loan','client','assets','installments','schedules'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoanSchedule  $loanSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(LoanSchedule $loanSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoanSchedule  $loanSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanSchedule $loanSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanSchedule  $loanSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanSchedule $loanSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoanSchedule  $loanSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanSchedule $loanSchedule)
    {
        //
    }
}
