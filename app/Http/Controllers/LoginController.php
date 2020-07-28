<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Lifetimesms;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['only' => ['changePassword', 'updatePassword']]);
    }

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
                return back()->with('error', 'Phone number or password is incorrect.')->withInput();
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

    public function changePassword($cnic)
    {
        if ($cnic) {
            $profile = Profile::where('cnic', $cnic)->first();
            return view('auth.change-password', ['profile' => $profile]);
        } else {
            echo 'Error 404';
        }
    }

    public function updatePassword(Request $request, $cnic)
    {
        if ($cnic) {
            $profile = Profile::where('cnic', $cnic)->first();
            $validator = Validator::make($request->all(), [
                'old_password'              =>      'required|min:8|max:16',
                'new_password'              =>      'required|min:8|max:16',
                'retype_new_password'       =>      'required|min:8|max:16'
            ]);

            if ($validator->fails()) {
                return redirect()->route('login.changePassword', $profile->cnic)->withErrors($validator);
            } else {
                if($request->get('new_password') !== $request->get('retype_new_password')) {
                    return redirect()->route('login.changePassword', $profile->cnic)->with('error', "New password and retype password doesn't match.");
                } else {
                    $hashPass = User::where('id', Auth::user()->id)->first();
                    $checked = Hash::check($request->get('old_password'), $hashPass->password);
                    if ($checked) {
                        $updated = Auth::user()->update([
                            'password'          =>  Hash::make($request->get('new_password'))
                        ]);
                        if ($updated) {
                            Auth::logout();
                            return redirect()->route('login.index')->with('error', 'Your password has been changed. You need to login again.');
                        } else {
                            return redirect()->route('login.changePassword', $profile->cnic)->with('error', "An error occured while changing your password.");
                        }
                    } else {
                        return redirect()->route('login.changePassword', $profile->cnic)->with('error', "Your old password is not correct.");
                    }
                }
            }
        }
    }
}
