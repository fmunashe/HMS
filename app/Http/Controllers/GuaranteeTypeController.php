<?php

namespace App\Http\Controllers;

use App\GuaranteeType;
use App\Http\Requests\GuaranteeTypeRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GuaranteeTypeController extends Controller
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
        $guaranteeTypes=GuaranteeType::all();
        return view('GuaranteeTypes.index',compact('guaranteeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('GuaranteeTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuaranteeTypeRequest $request)
    {
        $guaranteeType=new GuaranteeType();
        $guaranteeType->guarantee_type=$request->input('guarantee_type');
        $guaranteeType->save();
        return redirect()->route('guaranteeTypes')->withSuccessMessage("New Guarantee Type successfully configured");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GuaranteeType  $guaranteeType
     * @return \Illuminate\Http\Response
     */
    public function show(GuaranteeType $guaranteeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GuaranteeType  $guaranteeType
     * @return \Illuminate\Http\Response
     */
    public function edit(GuaranteeType $guaranteeType)
    {
        //
        return view('GuaranteeTypes.edit',compact('guaranteeType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GuaranteeType  $guaranteeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuaranteeType $guaranteeType)
    {
        $guaranteeType->update([
            'guarantee_type'=>$request['guarantee_type']
        ]);
        return redirect()->route('guaranteeTypes')->withSuccessMessage("Guarantee Type Successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GuaranteeType  $guaranteeType
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuaranteeType $guaranteeType)
    {

        $guaranteeType->delete();
        return redirect()->route('guaranteeTypes')->withSuccessMessage("Configured guarantee Type removed from the system");
    }
}
