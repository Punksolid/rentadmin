<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function showLogin(){
        if (Auth::check()){
            return Redirect::to('/');
        }
        return Redirect::to('login',401);
    }

    public function postLogin(Request $request){
        $obtener = $request->all();
        $data = ['email' => $obtener['email'], 'password' => $obtener['password']];

        if (Auth::attempt($data)){
            return Redirect::intended('/');
        }
        return Redirect::back()->with('error_message', '*Correo y/o Contraseña Incorrectos')->withInput();
    }

    public function logOut(){
        Auth::logout();
        return Redirect::to('login')->with('error_message', 'Sesión cerrada correctamente');
    }
}
