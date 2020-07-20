<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FertilizerStockSearchController extends Controller
{
    public function searchFertilizerTrader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              =>      'required_without_all:phone_number',
            'phone_number'      =>      'required_without_all:name'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->get('name') != "") {
                $name = addslashes(htmlentities($request->get('name')));
                $traders = Auth::user()->manyFertilizerTraders()->where('name', 'like', '%' . $name . '%')->get();
                if ($traders->count() > 0) {
                    return back()->with('traders', $traders);
                } else {
                    return back()->with('error', 'Fertilizer trader not found. <a href="' . route('fertilizerTraders.create') . '" class="alert-link">Add Fertilizer Trader</a>')->withInput();
                }
            } else if ($request->get('phone_number') != "") {
                $stock = Auth::user()->manyFertilizerTraders()->where('phone_number', '+92 ' . substr($request->get('phone_number'), 1))->first();
                if ($stock) {
                    return redirect()->route('fertilizerTraders.show', base64_encode(($stock->id * 123456789) / 12098));
                } else {
                    return back()->with('error', 'Fertilizer trader not found. <a href="' . route('fertilizerTraders.create') . '" class="alert-link">Add Fertilizer Trader</a>')->withInput();
                }
            }
        }
    }

    public function tradersList(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->get('name');
            $output = '';

            if ($name) {
                $profiles = Auth::user()->manyFertilizerTraders()->where('name', 'like', '%' . $name . '%')->get();
                if ($profiles->count() > 0) {
                    foreach ($profiles as $profile) {
                        $output .= '<a href="' . route('fertilizerTraders.show', base64_encode(($profile->id * 123456789) / 12098)) . '" class="dropdown-item px-2">
                        <span style="width:50px;float:left;margin-right:10px;"><img src="' . asset('images/logos/'. $profile->avatar) . '" width="100%" alt="Image not found"></span>
                        <span style="width:calc(100% - 60px);float:left;">
                            <h5 class="fw-700">' . $profile->name . '</h5>
                            <p class="mb-0" style="font-size:13px;white-space:normal;">' . $profile->address . '</p>
                        </span>
                        <br class="clear">
                    </a>';
                    }
                } else {
                    $output .= '<li class="dropdown-item">No customer found.</li>';
                }

            } else {
                $output .= '<li class="dropdown-item">Searching Customer ...</li>';
            }

            $data = ['list' =>  $output];
            return json_encode($data);
        }
    }
}
