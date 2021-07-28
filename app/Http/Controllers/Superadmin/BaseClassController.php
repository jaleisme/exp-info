<?php

namespace App\Http\Controllers\Superadmin;

use App\BaseClass;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class BaseClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BaseClass::select('base_classes.id', 'base_classes.leader',  'base_classes.class_name', 'users.name')->leftJoin('users', 'base_classes.leader', 'users.id')->groupBy('base_classes.id', 'base_classes.leader',  'base_classes.class_name', 'users.name')->get();
        return view('superadmin.base-class.home', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('role', 2)->get();
        return view('superadmin.base-class.create', compact(['user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new BaseClass;
        $data->leader = $request->leader;
        $data->class_name = $request->class_name;
        $data->save();
        return redirect('/superadmin/academic/base-class')->with('success', 'Class has been created.');
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
        $data = BaseClass::findOrFail($id);
        $user = User::where('role', 2)->get();
        return view('superadmin.base-class.edit', compact(['data', 'user']));
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
        $data = BaseClass::findOrFail($id);
        $data->leader = $request->leader;
        $data->class_name = $request->class_name;
        $data->save();
        return redirect('/superadmin/academic/base-class')->with('success', 'Class has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = BaseClass::findOrFail($id);
        $data->delete();
        return redirect('/superadmin/academic/base-class')->with('danger', 'Class has been deleted.');
    }
}
