<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Lifetimesms;

class RequestController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function index()
    {
        $profiles = Profile::where('status', 'pending')->latest()->paginate(10);
        return view('admin.requests', ['profiles' => $profiles]);
    }

    public function confirm($id)
    {
        if ($id) {
            $profile = Profile::find($id);
            if ($profile) {
                $created = User::create([
                    'phone_number'              =>      $profile->phone_number,
                    'password'                  =>      Hash::make('password'),
                    'profile_id'                =>      $profile->id
                ]);
                if ($created) {
                    $updated = $profile->update([
                        'status'                =>      'active'
                    ]);
                    if ($updated) {
                        $phone = explode(' ', $profile->phone_number);
                        $phn = '0' . implode('', [$phone[1], $phone[2]]);
                        $param = [
                            'to'                        =>      $phn,
                            'from'                      =>      'Lifetimesms',
                            'message'                   =>      "Your password is ready. You can login using phone number: " . $phn . " and password: password.\nCredits: Anaaj Trade Management",
                            'unicode'                   =>      false,
                            'date'                      =>      null,
                            'time'                      =>      null
                        ];
                        $response = Lifetimesms::singleSMS($param);
                        return back()->with('success', 'User created successfully.');
                    } else {
                        return back()->with('error', 'Something went wrong.');
                    }
                } else {
                    return back()->with('error', 'Something went wrong.');
                }
            } else {
                return back()->with('error', 'No request found.');
            }
        }
    }

    public function remove($id)
    {
        if ($id) {
            $profile = Profile::find($id);
            $updated = $profile->update([
                'status'                =>          'inactive'
            ]);
            if ($updated) {
                return back()->with('success', 'Request removed successfully.');
            } else {
                return back()->with('error', 'Something went wrong. Try again after sometime.');
            }
        }
    }
}
