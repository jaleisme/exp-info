<?php

namespace App\Http\Controllers\Superadmin;

use App\BaseClass;
use App\Http\Controllers\Controller;
use App\StudentClass;
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
        $users = StudentClass::select('class_students.id', 'class_students.id_student', 'class_students.id_class', 'users.id as id_user', 'users.name', 'users.email')
            ->leftJoin('users', 'class_students.id_student', 'users.id')
            ->where('id_class', $id)
            ->groupBy('class_students.id', 'class_students.id_student', 'class_students.id_class', 'users.id', 'users.name', 'users.email')
            ->get();
        $all_student = User::where('role', 3)->get();
        return view('superadmin.base-class.edit', compact(['data', 'users', 'all_student']));
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
        $data->class_name = $request->class_name;
        $data->save();
        return redirect('/superadmin/academic/base-class')->with('success', 'Class has been updated.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addStudent(Request $request)
    {
        $data = new StudentClass;
        $data->id_class = $request->class_id;
        $data->id_student = $request->student;
        $data->save();
        return redirect('/superadmin/academic/base-class')->with('success', 'Class has been updated.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeStudent(Request $request)
    {
        $data = StudentClass::where('id_class', $request->class_id)->where('id_student', $request->student_id)->first();
        $data->delete();
        // dd($request);
        return redirect('/superadmin/academic/base-class')->with('danger', 'Student has been removed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sc = StudentClass::where('id_class', $id)->get();
        foreach ($sc as $value) {
            $value->delete();
        }
        $data = BaseClass::findOrFail($id);
        $data->delete();
        return redirect('/superadmin/academic/base-class')->with('danger', 'Class has been deleted.');
    }
}
