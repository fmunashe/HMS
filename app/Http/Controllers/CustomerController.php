<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Branch;
use App\Customer;
use App\Facility;
use App\Guarantee;
use App\GuaranteeType;
use App\Http\Requests\CustomerRequest;
use App\Interest;
use App\Loan;
use App\Repayment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
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
        $customers=Customer::all();
        return view('customers.index',compact('customers'));
    }

    public function branchCustomers(){
        if(session('success_message')){
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        }
        $customers=Customer::where('branch_code',auth()->user()->branch)->get();
        return view('customers.branchCustomers',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codes=Branch::all();
        return view('customers.create',compact('codes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        //
        $customer=new Customer();
        $customer->branch_code=$request->input('branch_code');
        $customer->full_name=$request->input('full_name');
        $customer->account=$request->input('account');
        $customer->national_id=$request->input('national_id');
        $customer->email=$request->input('email');
        $customer->phone=$request->input('phone');
        $customer->address=$request->input('address');
        $customer->save();
        if($request->customer_type=="loan_customer") {
            $id=$customer->national_id;
            $rates=Interest::all();
            $facilities=Facility::all();
            $frequencies=Repayment::all();
            $assets=Asset::where('status','102')->get();
            Alert::success('Success',"Client Successfully registered, Capture their loan details")->showConfirmButton('Close', '#0f9b0f');
            return view('loans.create',compact('rates','facilities','frequencies','assets','id'));
        }
        else{
            $id=$customer->national_id;
            $guaranteeTypes=GuaranteeType::all();
            Alert::success('Success',"Client Successfully registered, Capture their guarantee details")->showConfirmButton('Close', '#0f9b0f');
            return view('Guarantees.create',compact('guaranteeTypes','id'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        $loans =Loan::where('client_id',$customer->national_id)->get();
        return view('customers.customerLoans',compact('loans','customer'));
    }

    public function showCustomer(Customer $customer){
        $loans =Loan::where('client_id',$customer->national_id)->get();
        return view('customers.showCustomerLoans',compact('loans','customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
        $codes=Branch::all();
        return view('customers.edit',compact('customer','codes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        try {
            $customer->update([
                'branch_code' => $request['branch_code'],
                'full_name' => $request['full_name'],
                'account' => $request['account'],
                'national_id' => $request['national_id'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
            ]);
            return redirect()->route('customers')->withSuccessMessage('Client ' . $customer->full_name . ' successfully updated');
        }
        catch(\Exception $ex){
            Alert::error('Error', "Duplicate Email or National Id, please verify")->showConfirmButton('Close', '#b92b27');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $check=Loan::where('client_id',$customer->national_id)->exists();
        $guara=Guarantee::where('customer_id',$customer->national_id)->exists();
        if($check){
            Alert::error('Error', "Customer has open loans and cannot be removed from the system")->showConfirmButton('Close', '#b92b27');
            return back();
        }
        if($guara){
            Alert::error('Error', "Customer has open guarantees and cannot be removed from the system")->showConfirmButton('Close', '#b92b27');
            return back();
        }
        $customer->delete();
        return redirect()->route('branchCustomers')->withSuccessMessage("Client Successfully removed from the system");
    }
}
