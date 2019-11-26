<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Reject;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RejectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rejections=Reject::where('branch',auth()->user()->branch)->get();
        return view('rejections.index',compact('rejections'));
    }

    public function unauthorised()
    {
        $unauthorised=Loan::where('branch',auth()->user()->branch)->where('status','103')->get();
        return view('rejections.unauthorised',compact('unauthorised'));
    }

    public function myLoans()
    {
        if(session('success_message')){
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        }
        $myLoans=Loan::where('branch',auth()->user()->branch)->get();
        return view('rejections.myLoans',compact('myLoans'));
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
     * @param  \App\Reject  $reject
     * @return \Illuminate\Http\Response
     */
    public function show(Reject $reject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reject  $reject
     * @return \Illuminate\Http\Response
     */
    public function edit(Reject $reject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reject  $reject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reject $reject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reject  $reject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reject $reject)
    {
        //
    }
}
