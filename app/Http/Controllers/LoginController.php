<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show(){
        return view('login.show');
    }

    public function login(Request $request){
        // $values = $request->post();
        $email = $request->email;
        $password = $request->password;
        $credentials  = ['email'=>$email,'password'=>$password];
       if( Auth::attempt($credentials)){
        $request->session()->regenerate(true);
        return to_route('seances.index')->with('success','Bien Connecter');
       }else{
            return back()->withErrors([
                'email'=> 'Email ou mot de passe incorrect'
            ])->onlyInput('email');
       }
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return to_route('login.show')->with('success','Bien DeConnecter');
    }
}
