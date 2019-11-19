<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Status;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use vendor\project\StatusTest;

class StatusController extends Controller
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
        $statuses=Status::all();
        return view('statuses.index',compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $request)
    {
        //
        $status=new Status();
        $status->status_code=$request->input('status_code');
        $status->status_name=$request->input('status_name');
        $status->save();
        redirect()->route('statuses')->withSuccessMessage("New Status Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
        return view('statuses.edit',compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, Status $status)
    {
        //
             $status->update([
            'status_code'=>$request['status_code'],
            'status_name'=>$request['status_name']
        ]);
        return redirect()->route('statuses')->withSuccessMessage("Status Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        if($status->status_code>=100 or $status->status_code<=108){
            Alert::error("Error","These are system configured status codes and names which cannot be modified")->showConfirmButton('Close', '#b92b27');
            return back();
        }
        $status->delete();
        return redirect()->route('statuses')->withSuccessMessage("Status Removed");
    }
}
