<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showFormLogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        $user = $request->only('email', 'password');
        // dd($user);
        if(Auth::attempt($user)){
            return view('home');
        }
        return redirect()->back()->withErrors([ 
            'email' => 'Thong tin nguoi dung khong dung',
        ]);
    }
    public function showFormRegister(){
        return view('auth.register');
    }
    public function register(Request $request){
        // $data = $request->all();
        // dd($data);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $user = User::query()->create($data);
        // dd($data);
        Auth::login($user);
        return view('home');
    }   
    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }
}
