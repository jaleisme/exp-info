<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('role', 3)->get();
        return view('superadmin.user.home', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new User;
        $student = new Student;

        if($request->id_user){
            $student->id_user = $request->id_user;
        }
        else {
            if(strlen($request->password) < 8){
                return redirect('/superadmin/system-access/user')->with('msg', 'Password must be 8 characters or more.');
            }
            if($request->password !== $request->confirm_password){
                return redirect('/superadmin/system-access/user')->with('msg', 'Password and Confirmation does not match.');
            }

            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->role = 3;
            $data->save();

            $student->id_user = $data->id;
        }


        $file = $request->file('photo');
        $filename = $request->name.'_'.time().$file->getClientOriginalExtension();
        $destination = 'img/user-img';
        $file->move($destination, $filename);

        $student->student_uid = $request->student_uid;
        $student->about = $request->about;
        $student->address = $request->address;
        $student->tel_num = $request->tel_num;
        $student->pob = $request->pob;
        $student->dob = $request->dob;
        $student->photo = $request->photo;
        $student->save();
        return redirect('/superadmin/system-access/user')->with('success', 'User has been created.');
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
        $data = User::findOrFail($id);
        $student = Student::where('id_user', $id)->first();
        // dd($student);
        return view('superadmin.user.edit', compact(['data', 'student']));
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
        $data = User::findOrFail($id);
        $student = Student::where('id_user', $id)->first();

        if(strlen($request->password) < 8){
            return redirect('/superadmin/system-access/user')->with('msg', 'Password must be 8 characters or more.');
        }
        if($request->password !== $request->confirm_password){
            return redirect('/superadmin/system-access/user')->with('msg', 'Password and Confirmation does not match.');
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $file = $request->file('photo');
        if($file){
            $filename = $request->name.'_'.time().$file->getClientOriginalExtension();
            $destination = 'img/user-img';
            $file->move($destination, $filename);
            $student->photo = $request->photo;
        }

        $student->id_user = $data->id;
        $student->student_uid = $request->student_uid;
        $student->about = $request->about;
        $student->address = $request->address;
        $student->tel_num = $request->tel_num;
        $student->pob = $request->pob;
        $student->dob = $request->dob;
        $student->save();
        return redirect('/superadmin/system-access/user')->with('success', 'User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::where('id_user', $id)->first();
        if($student){
            $student->delete();
        }
        return redirect('/superadmin/system-access/user')->with('danger', 'User has been deleted.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateAdmin()
    {
        // return 'OI';
        $user = User::where('role', '!=', 3)->get();
        return view('superadmin.user.generate', compact(['user']));
    }
}
