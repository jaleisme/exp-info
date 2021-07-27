<?php

namespace App\Http\Controllers;

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
            return view('profile', compact(['data']));
        }
        else {
            return redirect('/home');
        }
    }

    public function saveProfile(Request $request, $id){
        if(strlen($request->password) < 8){
            return redirect()->route('profile', Auth::user()->id)->with('msg', 'Password must be 8 characters or more.');
        }
        if($request->password !== $request->confirm_password){
            return redirect()->route('profile', Auth::user()->id)->with('msg', 'Password and Confirmation does not match.');
        }

        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->route('profile', Auth::user()->id)->with('success', 'Profile changed successfully.');
    }
}
