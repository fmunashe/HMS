<?php

namespace App\Http\Controllers;
use Auth;
use App\Branch;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Auth::user()->hasRole('administrator')) {
            abort('401');
        }
        if(session('success_message')){
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        }
        $users=User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (!Auth::user()->hasRole('administrator')) {
            abort('401');
        }
        $roles=Role::all();
        $branches=Branch::all();
        return view('users.create',compact('roles','branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (!Auth::user()->hasRole('administrator')) {
            abort('401');
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('role'));
        return redirect()->route('users')->withSuccessMessage("User successfully registered");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Auth::user()->hasRole('administrator')) {
            abort('401');
        }
        $branches=Branch::all();
        $roles=Role::all();
        return view('users.edit',compact('user','roles','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!Auth::user()->hasRole('administrator')) {
            abort('401');
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|regex:/(.*)@agribank\.co\.zw/i',
            'branch' => 'required',
            'role' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = array_except($input,array('password'));
        }
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->input('role'));
        return redirect()->route('users')->withSuccessMessage('User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if (!Auth::user()->hasRole('administrator')) {
            abort('401');
        }
        $user->delete();
        return redirect()->route('users')->withSuccessMessage("User successfully removed from the system");
    }
}
