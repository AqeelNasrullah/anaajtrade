<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Lifetimesms;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                      =>      'required|min:3',
            'phone_number'              =>      'required|min:12|max:12',
            'cnic'                      =>      'required|min:15|max:15',
            'address'                   =>      'required|min:3'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $phone = '+92 ' . substr(addslashes(htmlentities($request->get('phone_number'))), 1);
            $cnic = addslashes(htmlentities($request->get('cnic')));
            $user = User::where('phone_number', $phone)->first();
            if ($user) {
                return back()->with('error', 'Phone number already registered.')->withInput();
            } else {
                $profile = Profile::where('phone_number', $phone)->where('cnic', $cnic)->where('status', 'inactive')->first();
                if ($profile) {
                    $updated = $profile->update([
                        'role_id'                   =>      3,
                        'status'                    =>      'pending'
                    ]);
                    if ($updated) {
                        $phn = explode(' ' ,$request->get('phone_number'));
                        $phn = implode('', $phn);
                        $param = [
                            'to'        =>      $phn,
                            'from'      =>      'Lifetimesms',
                            'message'   =>      "آپ کی درخواست موصول ہو چکی ہے۔ ہم آپ سے جلد رابطہ کریں گے۔ \n Credits: Anaaj Trade Management",
                            'unicode'   =>      true,
                            'date'      =>      null,
                            'time'      =>      null,
                        ];
                        $response = LifeTimesms::singleSMS($param);
                        return back()->with('success', 'Your request has been recieved. We will contact you back.');
                    } else {
                        return back()->with('error', 'Something went wrong try after sometime.');
                    }
                } else {
                    $profile_sec = Profile::where('phone_number', $phone)->where('cnic', $cnic)->where('status', 'pending')->first();
                    if ($profile_sec) {
                        return back()->with('error', 'We have already recieved your request.');
                    } else {
                        $created = Profile::create([
                            'name'                      =>      addslashes(htmlentities($request->get('name'))),
                            'phone_number'              =>      '+92 ' . substr(addslashes(htmlentities($request->get('phone_number'))), 1),
                            'cnic'                      =>      addslashes(htmlentities($request->get('cnic'))),
                            'address'                   =>      addslashes(htmlentities($request->get('address'))),
                            'role_id'                   =>      3,
                            'status'                    =>      'pending'
                        ]);
                        if ($created) {
                            $phn = explode(' ' ,$request->get('phone_number'));
                            $phn = implode('', $phn);
                            $param = [
                                'to'        =>      $phn,
                                'from'      =>      'Lifetimesms',
                                'message'   =>      "آپ کی درخواست موصول ہو چکی ہے۔ ہم آپ سے جلد رابطہ کریں گے۔ \n Credits: Anaaj Trade Management",
                                'unicode'   =>      true,
                                'date'      =>      null,
                                'time'      =>      null,
                            ];
                            $response = LifeTimesms::singleSMS($param);
                            return back()->with('success', 'Your request has been recieved. We will contact you back.');
                        } else {
                            return back()->with('error', 'Something went wrong try after sometime.');
                        }
                    }
                }
            }
        }
    }

    public function mark()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->profile()->update([
                'status'         =>     'active',
            ]);
        }
        echo 'Done';
    }
}
