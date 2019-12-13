<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Guarantee;
use App\GuaranteeType;
use App\Http\Requests\GuaranteeRequest;
use App\Notifications\AuthorizeGuarantee;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GuaranteeController extends Controller
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
        $guarantees=Guarantee::where('branch',auth()->user()->branch)->get();
        return view('Guarantees.index',compact('guarantees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guaranteeTypes=GuaranteeType::all();
        return view('Guarantees.create',compact('guaranteeTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuaranteeRequest $request)
    {
        $customer=Customer::query()->where('national_id',$request->input('customer_id'))->exists();
        if($customer){
            $guarantee=new Guarantee();
            $guarantee->guarantee_type=$request->input('guarantee_type');
            $guarantee->amount_guaranteed=$request->input('amount_guaranteed');
            $guarantee->beneficiary=$request->input('beneficiary');
            $guarantee->start_date=$request->input('start_date');
            $guarantee->end_date=$request->input('end_date');
            $guarantee->period=$request->input('period');
            $guarantee->security=$request->input('security');
            $guarantee->customer_id=$request->input('customer_id');
            $guarantee->captured_by=auth()->user()->name;
            $guarantee->branch=auth()->user()->branch;
            $guarantee->save();
            //Code to send authorisation notification
           $users=User::query()->where('branch',auth()->user()->branch)->role('authorizer')->get();
                if($users) {
                    foreach ($users as $user) {
                        $us = new User();
                        $us->email = $user->email;
                        $us->notify(new AuthorizeGuarantee($user, $guarantee));
                    }
                }
            return redirect()->route('guarantees')->withSuccessMessage("New Guarantee Successfully Recorded in the system");
        }
        else{
            Alert::error('Error', "The entered customer id number does not exist in our records")->showConfirmButton('Close', '#b92b27');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guarantee  $guarantee
     * @return \Illuminate\Http\Response
     */
    public function show(Guarantee $guarantee)
    {
        return view('Guarantees.show',compact('guarantee'));
    }

    public function authorizeGuarantee(Guarantee $guarantee){
    if($guarantee->status!=false){
        Alert::error('Error', "This guarantee was previously authorised by ".$guarantee->authorised_by)->showConfirmButton('Close', '#b92b27');
        return back();
    }
    elseif ($guarantee->captured_by==auth()->user()->name){
        Alert::error('Error', "Hey ".auth()->user()->name." you cannot authorize your own work")->showConfirmButton('Close', '#b92b27');
        return back();
    }
    else{
        $guarantee->status=true;
        $guarantee->authorised_by=auth()->user()->name;
        $guarantee->save();
        return redirect()->route('guarantees')->withSuccessMessage("Guarantee ".$guarantee->id." successfully authorised");
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guarantee  $guarantee
     * @return \Illuminate\Http\Response
     */
    public function edit(Guarantee $guarantee)
    {
       if($guarantee->status==true or $guarantee->active==false){
           Alert::error('Error', "You cannot modify a guarantee whose status is authorised")->showConfirmButton('Close', '#b92b27');
           return back();
       }
       else{
           $guaranteeTypes=GuaranteeType::all();
           return view('Guarantees.edit',compact('guarantee','guaranteeTypes'));
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guarantee  $guarantee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guarantee $guarantee)
    {
        $customer=Customer::query()->where('national_id',$request->input('customer_id'))->exists();
        if($customer) {
            $guarantee->update([
                'guarantee_type' => $request['guarantee_type'],
                'amount_guaranteed' => $request['amount_guaranteed'],
                'beneficiary' => $request['beneficiary'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'period' => $request['period'],
                'security' => $request['security'],
                'customer_id' => $request['customer_id'],
                'captured_by' => auth()->user()->name,
                'status' => false,
                'active' => true,
                'branch' => auth()->user()->branch
            ]);
            return redirect()->route('guarantees')->withSuccessMessage("Guarantee Details successfully updated");
        }
        else{
            Alert::error('Error', "The new customer id number does not exist in our records")->showConfirmButton('Close', '#b92b27');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guarantee  $guarantee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guarantee $guarantee)
    {
        //
        if($guarantee->status==true){
            Alert::error('Error', "You cannot roll back a guarantee whose status is authorised")->showConfirmButton('Close', '#b92b27');
            return back();
        }
        else {
            $guarantee->delete();
            return redirect()->route('guarantees')->withSuccessMessage("Guarantee successfully removed from the system");
        }
    }
}
