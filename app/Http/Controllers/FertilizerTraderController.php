<?php

namespace App\Http\Controllers;

use App\FertilizerTrader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FertilizerTraderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traders = Auth::user()->manyFertilizerTraders()->latest()->paginate(10);
        return view('dashboard.fertilizer-traders.index', ['traders' => $traders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.fertilizer-traders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                      =>      'required|min:3',
            'phone_number'              =>      'required|min:12|max:12',
            'address'                   =>      'required'
        ];
        if ($request->hasFile('avatar')) {
            $rules['avatar'] = 'mimes:png,jpg,jpeg,gif|max:2048';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $phone_number = '+92 ' . substr($request->get('phone_number'), 1);
            $trader = FertilizerTrader::where('phone_number', $phone_number)->first();
            if ($trader) {
                $rel_trader = Auth::user()->manyFertilizerTraders()->where('fertilizer_trader_id', $trader->id)->first();
                if ($rel_trader) {
                    return redirect()->route('fertilizerTraders.index')->with('success', 'Fertilizer trader already exists.');
                } else {
                    Auth::user()->manyFertilizerTraders()->attach($trader);
                    return redirect()->route('fertilizerTraders.index')->with('success', 'Fertilizer trader added successfully');
                }
            } else {
                $filename = 'logo.png';
                if ($request->hasFile('avatar')) {
                    $avatar = $request->file('avatar');
                    $filename = 'ATM_FT_' . time() . '.' . $avatar->getClientOriginalExtension();
                    $uploaded = $avatar->move(public_path('/images/logos/'), $filename);
                    if (!$uploaded) {
                        return back()->with('error', 'An error occured while uploading avatar.');
                    }
                }
                $added = Auth::user()->manyFertilizerTraders()->create([
                    'avatar'                =>      $filename,
                    'name'                  =>      addslashes(htmlentities($request->get('name'))),
                    'phone_number'          =>      $phone_number,
                    'address'               =>      addslashes(htmlentities($request->get('address')))
                ]);
                if ($added) {
                    return redirect()->route('fertilizerTraders.index')->with('success', 'Fertilizer trader added successfully');
                } else {
                    return back()->with('error', 'An error occured while adding fertilizer trader.');
                }

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FertilizerTraders  $fertilizerTraders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $trader = FertilizerTrader::find($s_id);
            return view('dashboard.fertilizer-traders.show', ['trader' => $trader]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FertilizerTraders  $fertilizerTraders
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $trader = FertilizerTrader::find($s_id);
            return view('dashboard.fertilizer-traders.edit', ['trader' => $trader]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FertilizerTraders  $fertilizerTraders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $rules = [
                'name'                      =>      'required|min:3',
                'phone_number'              =>      'required|min:12|max:12',
                'address'                   =>      'required'
            ];
            if ($request->hasFile('avatar')) {
                $rules['avatar'] = 'mimes:png,jpg,jpeg,gif|max:2048';
            }
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $trader = FertilizerTrader::find($s_id);
                $filename = $trader->avatar;
                if ($request->hasFile('avatar')) {
                    $avatar = $request->file('avatar');
                    $filename = 'ATM_FT_' . time() . '.' . $avatar->getClientOriginalExtension();
                    $uploaded = $avatar->move(public_path('/images/logos/'), $filename);
                    if (!$uploaded) {
                        return back()->with('error', 'An error occured while uploading avatar.');
                    }
                }
                $updated = $trader->update([
                    'avatar'                =>      $filename,
                    'name'                  =>      addslashes(htmlentities($request->get('name'))),
                    'phone_number'          =>      '+92 ' . substr($request->get('phone_number'), 1),
                    'address'               =>      addslashes(htmlentities($request->get('address')))
                ]);
                if ($updated) {
                    return redirect()->route('fertilizerTraders.index')->with('success', 'Fertilizer trader updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating fertilizer trader.');
                }

            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FertilizerTraders  $fertilizerTraders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $deleted = Auth::user()->manyFertilizerTraders()->detach($s_id);
            if ($deleted) {
                return back()->with('success', 'Fertilizer trader deleted successfully.');
            } else {
                return back()->with('error', 'An error occured while deleting fertilizer trader.');
            }
        }
    }
}
