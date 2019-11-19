<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\CurrencyRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CurrencyController extends Controller
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
        $currencies=Currency::all();
        return view('currencies.index',compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        //
        $currency=new Currency();
        $currency->currency_code=$request->input('currency_code');
        $currency->currency_name=$request->input('currency_name');
        $currency->save();
        return redirect()->route('currencies')->withSuccessMessage("New Currency ".$currency->currency_name." Registered");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
        return view('currencies.edit',compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        //
        try {
            $currency->update([
                'currency_code' => $request['currency_code'],
                'currency_name' => $request['currency_name']
            ]);
            return redirect()->route('currencies')->withSuccessMessage("Currency details updated");
        }
        catch(\Exception $ex){
            Alert::error('Error', "Duplicate Currency Code !!!")->showConfirmButton('Close', '#b92b27');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
        $currency->delete();
        return redirect()->route('currencies')->withSuccessMessage("Currency removed from system");
    }
}
