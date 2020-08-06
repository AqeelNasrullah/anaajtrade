<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class PrivilegesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function index()
    {
        $users = User::orderBy('updated_at', 'DESC')->get();
        return view('admin.users', ['users' => $users]);
    }

    public function addMod($id)
    {
        if ($id) {
            $profile = Profile::find($id);
            $updated = $profile->update([
                'role_id'                   =>      2
            ]);
            if ($updated) {
                return redirect()->route('privileges.index')->with('success', 'User added to moderators.');
            } else {
                return redirect()->route('privileges.index')->with('error', 'An error occured while adding moderator.');
            }
        }
    }

    public function removeMod($id)
    {
        if ($id) {
            $profile = Profile::find($id);
            $updated = $profile->update([
                'role_id'                   =>      3
            ]);
            if ($updated) {
                return redirect()->route('privileges.index')->with('success', 'User removed from moderators.');
            } else {
                return redirect()->route('privileges.index')->with('error', 'An error occured while removing moderator.');
            }
        }
    }
}
