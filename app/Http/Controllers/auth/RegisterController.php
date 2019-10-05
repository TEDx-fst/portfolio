<?php

namespace App\Http\Controllers\auth;

use Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller {

    function getRegister() {

        return view('auth.register');
    }

    function postRegister() {

        $data = request()->validate([
            'email' => 'required|unique:users,email|email',
            'first_name' => 'required|min:3|max:18|alpha',
            'last_name' => 'required|min:3|max:18|alpha',
            'password' => 'required|string|min:8|max:32|confirmed',
        ]);

        $user = Sentinel::registerAndActivate($data);
//        $role = Sentinel:: findRoleBySlug('user');
//
//        $role->users()->attach($user);


        return redirect()->route('login')->with('success', 'You are registered successfully');
    }

}
