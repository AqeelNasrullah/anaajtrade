<?php

namespace App\Http\Controllers;

use App\Other;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OtherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = Auth::user()->others()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $others = Auth::user()->others()->latest()->get();
        return view('dashboard.roznamcha.others.index', ['dates' => $dates, 'others' => $others]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $profile = Profile::find($s_id);
            return view('dashboard.roznamcha.others.create', ['profile' => $profile]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'description'           =>      'required',
                'amount'                =>      'required|numeric|min:0'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $created = Auth::user()->others()->create([
                    'description'               =>      htmlentities(addslashes($request->get('description'))),
                    'amount'                    =>      $request->get('amount'),
                    'profile_id'                =>      $s_id
                ]);
                if ($created) {
                    return redirect()->route('other.show', base64_encode(($created->id * 123456789) / 12098))->with('success', 'Record added successfully.');
                } else {
                    return back()->with('error', 'An error occured while adding record.');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Other  $other
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $other = Other::find($s_id);
            return view('dashboard.roznamcha.others.show', ['other' => $other]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Other  $other
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $other = Other::find($s_id);
            return view('dashboard.roznamcha.others.edit', ['other' => $other]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Other  $other
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'desc'                      =>      'required',
                'amount'                    =>      'required|numeric|min:0'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $updated = Other::find($s_id)->update([
                    'description'           =>      htmlentities(addslashes($request->get('desc'))),
                    'amount'                =>      $request->get('amount')
                ]);
                if ($updated) {
                    return redirect()->route('other.show', $id)->with('success', 'Record updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating record.');
                }

            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Other  $other
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $deleted = Other::destroy($s_id);
            if ($deleted) {
                return redirect()->route('other.index')->with('success', 'Record deleted successfully.');
            } else {
                return back()->with('error', 'An error occured while updating record.');
            }

        }
    }
}
