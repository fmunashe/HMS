<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Http\Requests\AssetRequest;
use App\Imports\AssetImport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class AssetController extends Controller
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
        $assets=Asset::all();
        $allocated=Asset::where('status','100')->count();
        $reserved=Asset::where('status','101')->count();
        return view('assets.index',compact('assets','allocated','reserved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('assets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetRequest $request)
    {
        //
        $asset=new Asset();
        $asset->asset_number=$request->input('asset_number');
        $asset->asset_name=$request->input('asset_name');
        $asset->serial_number=$request->input('serial_number');
        $asset->asset_value=$request->input('asset_value');
        $asset->asset_description=$request->input('asset_description');
        $asset->save();
        return redirect()->route('assets')->withSuccessMessage("Asset Successfully Recorded");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function importFile(){
    return view('assets.importFile');
    }
    public function import( Request $request){
        $validator = Validator::make($request->all(), [
            'assetFile' => 'required|mimes:xls,xlsx,csv,txt'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
            $upload = $request->file('assetFile');
            $import = new AssetImport();
            $import->import($upload);
            return redirect()->route('assets')->withSuccessMessage('Assets successfully imported');
    }
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        //
        return view('assets.edit',compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //
        try {
            $asset->update([
                'asset_number' => $request->input('asset_number'),
                'asset_name' => $request->input('asset_name'),
                'serial_number'=>$request->input('serial_number'),
                'asset_value'=>$request->input('asset_value'),
                'asset_description' => $request->input('asset_description')
            ]);
            return redirect()->route('assets')->withSuccessMessage("Asset details successfully updated");
        }
        catch(\Exception $ex){
            Alert::error('Error', "Duplicate Asset Number")->showConfirmButton('Close', '#b92b27');
            return back();
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //
        if($asset->status!='102'){
            Alert::error("Error","Allocated and Reserved assets cannot be deleted")->showConfirmButton('Close','#b92b27');
            return back();
        }
        $asset->delete();
        return redirect()->route('assets')->withSuccessMessage("Asset record removed from system");
    }
}
