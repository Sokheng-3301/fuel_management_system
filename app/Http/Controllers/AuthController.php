<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }


    public function login(Request $request){
        // dd("Hello login");
        $request->validate([
            'username' => 'required|max:200',
            'password' => 'required|min:4',
        ]);
        if (auth()->attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ])) {
            // Update last login time
            $user = auth()->user();
            $user->login_at = now();
            $user->save();
            return redirect()->route('home')->with('logedin', true);
        } else {
            return redirect()->back()
                ->with('error', __("Invalid Username or Password"))
                ->withInput();
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
