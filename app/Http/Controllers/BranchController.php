<?php

namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;
use RealRashid\SweetAlert\Facades\Alert;

class BranchController extends Controller
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
        $branches=Branch::all();
        return view('branches.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        //
        $branch=new Branch();
        $branch->branch_code=$request->input('branch_code');
        $branch->branch_name=$request->input('branch_name');
        $branch->save();
        return redirect()->route('branches')->withSuccessMessage("New Branch Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        try {
            $branch->update([
                'branch_code' => $request['branch_code'],
                'branch_name' => $request['branch_name'],
            ]);
            return redirect()->route('branches')->withSuccessMessage('branch code ' . $branch->branch_code . ' successfully updated');
        }
        catch(\Exception $ex){
            Alert::error('Error', "Duplicate Branch Code")->showConfirmButton('Close', '#b92b27');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
        $users=User::where('branch','=',$branch->branch_code)->exists();
        if($users){
            Alert::error("Error","There are users using this branch hence cannot be deleted")->showConfirmButton('Close','#b92b27');
            return back();
        }
        $branch->delete();
        return redirect()->route('branches')->withSuccessMessage("Branch Successfully removed ");
    }
}
