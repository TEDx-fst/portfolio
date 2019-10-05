<?php

namespace App\Http\Controllers\auth;

use Sentinel;
use App\Http\Controllers\Controller;

class LoginController extends Controller {

    function getLogin() {
        return view('auth.login');
    }

    function postLogin() {

        $data = request()->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = Sentinel::Authenticate($data);
        if($user){
        return redirect()->home();
            
        }else{
            return redirect()->back();
        }
    }

    function logout() {
        Sentinel::logout();

        return redirect()->route('login');
    }

}
