<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister(){ return view('auth.register'); }
    
    public function register(Request $request){
        $request->validate([
            'username'=>'required|unique:users,username',
            'password'=>'required|min:4'
        ]);

        User::create([
            'username'=>$request->username,
            'password'=>Hash::make($request->password)
        ]);

        return redirect('/login')->with('success','Akun berhasil dibuat! Silakan login.');
    }

    public function showLogin(){ return view('auth.login'); }

    public function login(Request $request){
        $request->validate(['username'=>'required','password'=>'required']);
        $user = User::where('username',$request->username)->first();
        if($user && Hash::check($request->password,$user->password)){
            session(['user_id'=>$user->id,'username'=>$user->username]);
            return redirect('/dashboard')->with('success','Login berhasil!');
        }
        return back()->with('error','Username atau password salah!');
    }

    public function logout(){
        session()->flush();
        return redirect('/login')->with('success','Berhasil logout.');
    }
}
