<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Http\Requests\FacilityRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FacilityController extends Controller
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
        $facilities=Facility::all();
        return view('facilities.index',compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacilityRequest $request)
    {
        //
        $facility=new Facility();
        $facility->facility_name=$request->input('facility_name');
        $facility->facility_description=$request->input('facility_description');
        $facility->save();
        return redirect()->route('facilities')->withSuccessMessage("New Product Line Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        //
        return view('facilities.edit',compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {
        //
        try{
        $facility->update([
        'facility_name'=>$request['facility_name'],
         'facility_description'=>$request['facility_description']
        ]);
        return redirect()->route('facilities')->withSuccessMessage("product line updated successfully");
        }
        catch(\Exception $ex){
            Alert::error("Error",$ex);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        //
        $facility->delete();
        return redirect()->route('facilities')->withSuccessMessage("Product Line Removed from system");
    }
}
