<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepaymentRequest;
use App\Repayment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RepaymentController extends Controller
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
        $frequencies=Repayment::all();
        return view('frequencies.index',compact('frequencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('frequencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepaymentRequest $request)
    {
        //
        $repayment=new Repayment();
        $repayment->frequency_number=$request->input('frequency_number');
        $repayment->frequency_name=$request->input('frequency_name');
        $repayment->save();
        return redirect()->route('frequencies')->withSuccessMessage("New Repayment Frequency Successfully Registered");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function show(Repayment $repayment)
    {
        //
        Alert::info('Info', "This is everything, there is nothing more to show")->showConfirmButton('Close', '#b92b27');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function edit(Repayment $repayment)
    {
        //
        Alert::info('Info', "Nothing to Edit")->showConfirmButton('Close', '#b92b27');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repayment $repayment)
    {
        //
        Alert::info('Info', "Nothing to Update")->showConfirmButton('Close', '#b92b27');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repayment $repayment)
    {
        //
        $repayment->delete();
        return redirect()->route('frequencies')->withSuccessMessage("Repayment Frequency successfully removed from system");
    }
}
