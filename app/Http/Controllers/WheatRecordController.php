<?php

namespace App\Http\Controllers;

use App\Profile;
use App\WheatRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WheatRecordController extends Controller
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
        $dates = Auth::user()->wheatRecords()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $records = Auth::user()->wheatRecords()->latest()->get();
        return view('dashboard.roznamcha.wheat.index', ['dates' => $dates, 'records' => $records]);
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
            $total_stock = Auth::user()->wheatStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as sum')->first();
            $total_sale = Auth::user()->wheatRecords()->sum('quantity');
            $remaining_stock = $total_stock->sum - $total_sale;
            return view('dashboard.roznamcha.wheat.create', ['profile' => $profile, 'rem_stock' => $remaining_stock]);
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
                'quantity'                  =>      'required|numeric|min:0',
                'price_per_mann'            =>      'required|numeric|min:0',
                'paid_per_mann'             =>      'required|numeric|min:0',
                'category'                  =>      'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $created = Auth::user()->wheatRecords()->create([
                    'quantity'              =>      trim($request->get('quantity')),
                    'price_per_mann'        =>      trim($request->get('price_per_mann')),
                    'paid_per_mann'         =>      trim($request->get('paid_per_mann')),
                    'category'              =>      $request->get('category'),
                    'profile_id'            =>      $s_id
                ]);

                if ($created) {
                    return redirect()->route('wheatRecord.show', base64_encode(($created->id * 123456789) / 12098))->with('success', 'Wheat record added successfully.');
                } else {
                    return back()->with('error', 'An error occur while adding wheat record.')->withInput();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WheatRecord  $wheatRecord
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $wheat_record = WheatRecord::find($s_id);
            return view('dashboard.roznamcha.wheat.show', ['wheat_record' => $wheat_record]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WheatRecord  $wheatRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $wheat_record = WheatRecord::find($s_id);
            return view('dashboard.roznamcha.wheat.edit', ['wheat_record' => $wheat_record]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WheatRecord  $wheatRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'quantity'                  =>      'required|numeric|min:0',
                'price_per_mann'            =>      'required|numeric|min:0',
                'paid_per_mann'             =>      'required|numeric|min:0',
                'category'                  =>      'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $updated = WheatRecord::find($s_id)->update([
                    'quantity'              =>      trim($request->get('quantity')),
                    'price_per_mann'        =>      trim($request->get('price_per_mann')),
                    'paid_per_mann'         =>      trim($request->get('paid_per_mann')),
                    'category'              =>      $request->get('category')
                ]);

                if ($updated) {
                    return redirect()->route('wheatRecord.show', $id)->with('success', 'Wheat record updated successfully.');
                } else {
                    return back()->with('error', 'An error occur while updating wheat record.')->withInput();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WheatRecord  $wheatRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $destroyed = WheatRecord::destroy($s_id);
            if ($destroyed) {
                return redirect()->route('wheatRecord.index')->with('success', 'Wheat record deleted successfully.');
            } else {
                return redirect()->route('WheatRecord.index')->with('error', 'An error occur while deleting wheat record.');
            }
        }
    }
}
