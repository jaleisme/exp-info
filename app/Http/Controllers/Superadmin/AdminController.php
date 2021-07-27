<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role !== 1){
            return redirect('/home');
        }
        $data = User::where('role', 2)->get();
        return view('superadmin.administrator.home', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role !== 1){
            return redirect('/home');
        }
        return view('superadmin.administrator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(strlen($request->password) < 8){
            return redirect('/superadmin/system-access/administrator/create')->with('msg', 'Password must be 8 characters or more.');
        }
        if($request->password !== $request->confirm_password){
            return redirect('/superadmin/system-access/administrator/create')->with('msg', 'Password and Confirmation does not match.');
        }

        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role = 2;
        $data->save();
        return redirect('/superadmin/system-access/administrator')->with('success', 'Administrator has been created.');
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
    public function edit($id)
    {
        if(Auth::user()->role !== 1){
            return redirect('/home');
        }
        $data = User::findOrFail($id);
        return view('superadmin.administrator.edit', compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(strlen($request->password) < 8){
            return redirect('/superadmin/system-access/administrator/edit/'.$id)->with('msg', 'Password must be 8 characters or more.');
        }
        if($request->password !== $request->confirm_password){
            return redirect('/superadmin/system-access/administrator/edit/'.$id)->with('msg', 'Password and Confirmation does not match.');
        }

        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('/superadmin/system-access/administrator')->with('success', 'Administrator has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role !== 1){
            return redirect('/home');
        }
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/superadmin/system-access/administrator')->with('danger', 'Administrator has been deleted.');
    }
}
