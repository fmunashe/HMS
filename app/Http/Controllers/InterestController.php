<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterestRequest;
use App\Interest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(session('success_message')){
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        }
        $interests=Interest::all();
        return view('interests.index',compact('interests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('interests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterestRequest $request)
    {
        //
        $interest=new Interest();
        $interest->interest_percentage=(($request->input('interest_percentage'))/100);
        $interest->save();
        return redirect()->route('interests')->withSuccessMessage("New Interest Configuration recorded");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function show(Interest $interest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function edit(Interest $interest)
    {
        //
        return view('interests.edit',compact('interest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interest $interest)
    {
        //
        try{
            $interest->update([
                'interest_percentage'=>(($request['interest_percentage'])/100)
            ]);
            return redirect()->route('interests')->withSuccessMessage("Interest rate updated successfully");
        }
        catch(\Exception $ex){
            Alert::error("Error","Duplicate percentage rate");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interest $interest)
    {
        $interest->delete();
        return redirect()->route('interests')->withSuccessMessage("Configured interest has been removed from the system");
    }
}
