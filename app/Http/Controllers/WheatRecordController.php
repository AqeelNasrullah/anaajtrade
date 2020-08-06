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
        $this->middleware('userStatus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d', time());
        $wheat = Auth::user()->wheatRecords()->selectRaw('sum(quantity) as quantity')->where('created_at', '>', $date)->first();
        $wheat_mann = Auth::user()->wheatRecords()->select('paid_per_mann as paid')->where('created_at', '>' , $date)->latest()->first();
        $wheat_price = Auth::user()->wheatRecords()->selectRaw('sum((quantity / 40) * price_per_mann) as amount')->where('created_at', '>', $date)->first();
        $wheat_paid = Auth::user()->wheatRecords()->selectRaw('sum((quantity / 40) * paid_per_mann) as amount')->where('created_at', '>', $date)->first();
        $wheat_profit = $wheat_paid->amount - $wheat_price->amount;

        $dates = Auth::user()->wheatRecords()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $records = Auth::user()->wheatRecords()->latest()->get();
        return view('dashboard.roznamcha.wheat.index', [
            'dates' => $dates, 'records' => $records, 'wheat' => $wheat, 'wheat_mann' => $wheat_mann,
            'wheat_paid' => $wheat_paid, 'wheat_profit' => $wheat_profit
        ]);
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
            $stock = $this->getStockInfo();
            return view('dashboard.roznamcha.wheat.create', ['profile' => $profile, 'stock' => $stock]);
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

    // Get Stock Info
    public function getStockInfo()
    {
        $wheat = [];
        $wheat_a = Auth::user()->wheatStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('category', 'A')->first();
        $sale_a = Auth::user()->wheatRecords()->selectRaw('sum(quantity) as quantity')->where('category', 'A')->first();
        $wheat_b = Auth::user()->wheatStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('category', 'B')->first();
        $sale_b = Auth::user()->wheatRecords()->selectRaw('sum(quantity) as quantity')->where('category', 'B')->first();
        $wheat_c = Auth::user()->wheatStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('category', 'C')->first();
        $sale_c = Auth::user()->wheatRecords()->selectRaw('sum(quantity) as quantity')->where('category', 'C')->first();
        $wheat_d = Auth::user()->wheatStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('category', 'D')->first();
        $sale_d = Auth::user()->wheatRecords()->selectRaw('sum(quantity) as quantity')->where('category', 'D')->first();
        $wheat['A'] = $wheat_a->quantity - $sale_a->quantity; $wheat['B'] = $wheat_b->quantity - $sale_b->quantity;
        $wheat['C'] = $wheat_c->quantity - $sale_c->quantity; $wheat['D'] = $wheat_d->quantity - $sale_d->quantity;
        return $wheat;
    }
}
