<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            return redirect()->route('dashboard.index');
        }
        else
        {
            return view('auth.login');
        }
    }

    public function loginAttempt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number'                  =>  'required',
            'password'                      =>  'required|min:8|max:16'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $phone_number = "+92 " . substr(trim(addslashes(htmlentities($request->get('phone_number')))), 1);
            $password = trim(addslashes(htmlentities($request->get('password'))));
            $data = [
                'phone_number'              =>      $phone_number,
                'password'                  =>      $password
            ];

            if (Auth::attempt($data)) {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->back()->with('error', 'Phone number or password is incorrect.')->withInput();
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
