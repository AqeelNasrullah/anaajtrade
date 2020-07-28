<?php

namespace App\Http\Controllers;

use App\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Keygen\Keygen;
use Lifetimesms;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function sendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number'              =>      'required|min:12|max:12'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $phone = '+92 ' . substr($request->get('phone_number'), 1);
            $match = User::where('phone_number', $phone)->first();
            if ($match) {
                $phone = $match->phone_number;
                $code = rand(100000, 999999);
                $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes', time()));
                $created = ResetPassword::create([
                    'phone_number'          =>      $phone,
                    'code'                  =>      $code,
                    'code_expiry'           =>      $expiry
                ]);
                if ($created) {
                    $nmbr = explode(' ', $phone);
                    $nmbr = implode('', $nmbr);
                    $nmbr = substr($nmbr, 1);
                    $parameters = [
                        'to'            =>      $nmbr,
                        'from'          =>      'Lifetimesms',
                        'message'       =>      "Your password recorvery code is " . $code . ". Code is valid for 15 minutes.\nCredits: Anaaj Trade Management",
                        'unicode'       =>      false,
                        'date'          =>      null,
                        'time'          =>      null
                    ];
                    $response = Lifetimesms::singleSMS($parameters);
                    if ($response['response'] == 'SMS sent') {
                        return redirect()->route('resetpassword.verifyCode', $phone)->with('success', 'A message with verification code has been sent to ' . $nmbr . '. Code is valid for 15 minutes.');
                    } else {

                    }
                } else {
                    return back()->with('error', 'Something wrong happened. Try again after some time.');
                }
            } else {
                return back()->with('error', 'Your phone number is not registered with us.');
            }
        }
    }

    public function verifyCode($phone)
    {
        if ($phone) {
            return view('auth.verify-code', ['phone' => $phone]);
        }
    }

    public function validateCode(Request $request, $phone)
    {
        if ($phone) {
            $validator = Validator::make($request->all(), [
                'code'          =>      'required|min:6|max:6'
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $record = ResetPassword::where('phone_number', $phone)->where('code', $request->get('code'))->where('code_expiry', '>', date('Y-m-d H:i:s', time()))->latest()->first();
                if ($record) {
                    $key = Keygen::alphanum(15)->generate();
                    $expiry = date('Y-m-d H:i:s', strtotime('+30 minutes', time()));
                    $updated = $record->update([
                        'code_expiry'            =>      date('Y-m-d H:i:s', time()),
                        'param'                  =>      $key,
                        'param_expiry'           =>      $expiry
                    ]);
                    if ($updated) {
                        $id = $record->id;
                        return redirect()->route('resetpassword.resetPassword', [$id, $key])->with('success', 'This link is valid for 30 minutes.');
                    } else {
                        return back()->with('error', 'Something went wrong. Try after sometime.');
                    }
                } else {
                    return back()->with('error', 'Code is expired. <a href="' . route('resetpassword.sendCode') . '" class="alert-link">Click here</a> to send code again');
                }
            }
        }
    }

    public function resetPassword($id, $key)
    {
        if ($id && $key) {
            $record = ResetPassword::where('id', $id)->where('param', $key)->where('param_expiry', '>', date('Y-m-d H:i:s', time()))->first();
            if ($record) {
                return view('auth.reset-password', [$id, $record->phone_number]);
            } else {
                return back()->with('error', 'Link expired. <a href="' . route('resetpassword.sendCode') . '" class="alert-link">Click here</a> to re-generate link.');
            }
        }
    }

    public function updatePassword(Request $request, $id, $key)
    {
        if ($id && $key) {
            $validator = Validator::make($request->all(), [
                'new_password'              =>      'required|min:8|max:16',
                'retype_new_password'       =>      'required|min:8|max:16'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                if ($request->get('new_password') !== $request->get('retype_new_password')) {
                    return back()->with('error', "New password and retype new password doesn't match");
                } else {
                    $record = ResetPassword::where('id', $id)->where('param', $key)->first();
                    $user = User::where('phone_number', $record->phone_number)->first();
                    $updated = $user->update([
                        'password'          =>      Hash::make($request->get('new_password'))
                    ]);
                    if ($updated) {
                        return redirect()->route('login.index')->with('error', 'Your password has been changed. You can login with your new password.');
                    } else {
                        return back()->with('error', 'Something went wrong. Try again after sometime.');
                    }
                }
            }
        }
    }
}
