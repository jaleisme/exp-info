<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 1) {
            return redirect()->route('superadmin');
        }
        if (Auth::user()->role == 2) {
            return redirect()->route('admin');
        }
        if (Auth::user()->role == 3) {
            return redirect()->route('user');
        }
    }

    public function profile($id)
    {
        if(Auth::user()->id == $id){
            $data = User::findOrFail($id);
            $student = Student::where('id_user', $id)->first();
            return view('profile', compact(['data', 'student']));
        }
        else {
            return redirect('/home');
        }
    }

    public function saveProfile(Request $request, $id){
        $data = User::findOrFail($id);
        $student = Student::where('id_user', $id)->first();

        if(strlen($request->password) < 8){
            return redirect()->route('profile', Auth::user()->id)->with('msg', 'Password must be 8 characters or more.');
        }
        if($request->password !== $request->confirm_password){
            return redirect()->route('profile', Auth::user()->id)->with('msg', 'Password and Confirmation does not match.');
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        if($student){
            $file = $request->file('photo');
            if($file){
                $filename = $request->name.'_'.time().$file->getClientOriginalExtension();
                $destination = 'img/user-img';
                $file->move($destination, $filename);
                $student->photo = $request->photo;
            }

            $student->student_uid = $request->student_uid;
            $student->about = $request->about;
            $student->address = $request->address;
            $student->tel_num = $request->tel_num;
            $student->pob = $request->pob;
            $student->dob = $request->dob;
            $student->save();
        }
        return redirect()->route('profile', Auth::user()->id)->with('success', 'Profile changed successfully.');
    }
}
