<?php

namespace App\Http\Controllers;

use App\Profile;
use App\RiceRecord;
use App\RiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RiceRecordController extends Controller
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
        $date = date('Y-m-d', time());
        $rice = Auth::user()->riceRecords()->selectRaw('sum(quantity) as quantity')->where('created_at', '>', $date)->first();
        $rice_mann = Auth::user()->riceRecords()->select('paid_per_mann as paid')->where('created_at', '>', $date)->latest()->first();
        $rice_price = Auth::user()->riceRecords()->selectRaw('sum((quantity / 40) * price_per_mann) as amount')->where('created_at', '>', $date)->first();
        $rice_paid = Auth::user()->riceRecords()->selectRaw('sum((quantity / 40) * paid_per_mann) as amount')->where('created_at', '>', $date)->first();
        $rice_profit = $rice_paid->amount - $rice_price->amount;

        $dates = Auth::user()->riceRecords()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $records = Auth::user()->riceRecords()->latest()->get();
        return view('dashboard.roznamcha.rice.index', [
            'dates' => $dates, 'records' => $records, 'rice' => $rice, 'rice_mann' => $rice_mann,
            'rice_paid' => $rice_paid, 'rice_profit' => $rice_profit
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
            $types = RiceType::all();
            $stock = $this->getStockInfo();
            return view('dashboard.roznamcha.rice.create', ['profile' => $profile, 'types' => $types, 'stock' => $stock]);
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
                'type'                      =>      'required',
                'category'                  =>      'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $created = Auth::user()->riceRecords()->create([
                    'quantity'              =>      trim($request->get('quantity')),
                    'price_per_mann'        =>      trim($request->get('price_per_mann')),
                    'paid_per_mann'         =>      trim($request->get('paid_per_mann')),
                    'rice_type_id'          =>      $request->get('type'),
                    'category'              =>      $request->get('category'),
                    'profile_id'            =>      $s_id
                ]);

                if ($created) {
                    return redirect()->route('riceRecord.show', base64_encode(($created->id * 123456789) / 12098))->with('success', 'Rice record added successfully.');
                } else {
                    return back()->with('error', 'An error occured while adding rice record.')->withInput();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RiceRecord  $riceRecord
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $rice_record = RiceRecord::find($s_id);
            return view('dashboard.roznamcha.rice.show', ['record' => $rice_record]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RiceRecord  $riceRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $types = RiceType::all();
            $wheat_record = RiceRecord::find($s_id);
            return view('dashboard.roznamcha.rice.edit', ['record' => $wheat_record, 'types' => $types]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RiceRecord  $riceRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'quantity'                  =>      'required|numeric|min:0',
                'price_per_mann'            =>      'required|numeric|min:0',
                'paid_per_mann'             =>      'required|numeric|min:0',
                'type'                      =>      'required',
                'category'                  =>      'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $updated = RiceRecord::find($s_id)->update([
                    'quantity'              =>      trim($request->get('quantity')),
                    'price_per_mann'        =>      trim($request->get('price_per_mann')),
                    'paid_per_mann'         =>      trim($request->get('paid_per_mann')),
                    'rice_type_id'          =>      $request->get('category'),
                    'category'              =>      $request->get('category')
                ]);

                if ($updated) {
                    return redirect()->route('riceRecord.show', $id)->with('success', 'Rice record updated successfully.');
                } else {
                    return back()->with('error', 'An error occur while updating rice record.')->withInput();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RiceRecord  $riceRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $destroyed = RiceRecord::destroy($s_id);
            if ($destroyed) {
                return redirect()->route('riceRecord.index')->with('success', 'Rice record deleted successfully.');
            } else {
                return redirect()->route('riceRecord.index')->with('error', 'An error occur while deleting rice record.');
            }
        }
    }

    // Get Stock info
    public function getStockInfo()
    {
        $rice = []; $qual = [];
        $types = RiceType::all();
        foreach ($types as $type) {
            $stock_a = Auth::user()->riceStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('rice_type_id', $type->id)->where('category', 'A')->first();
            $record_a = Auth::user()->riceRecords()->selectRaw('sum(quantity) as quantity')->where('rice_type_id', $type->id)->where('category', 'A')->first();
            $stock_b = Auth::user()->riceStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('rice_type_id', $type->id)->where('category', 'B')->first();
            $record_b = Auth::user()->riceRecords()->selectRaw('sum(quantity) as quantity')->where('rice_type_id', $type->id)->where('category', 'B')->first();
            $stock_c = Auth::user()->riceStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('rice_type_id', $type->id)->where('category', 'C')->first();
            $record_c = Auth::user()->riceRecords()->selectRaw('sum(quantity) as quantity')->where('rice_type_id', $type->id)->where('category', 'C')->first();
            $stock_d = Auth::user()->riceStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('rice_type_id', $type->id)->where('category', 'D')->first();
            $record_d = Auth::user()->riceRecords()->selectRaw('sum(quantity) as quantity')->where('rice_type_id', $type->id)->where('category', 'D')->first();
            $qual['A'] = $stock_a->quantity - $record_a->quantity; $qual['B'] = $stock_b->quantity - $record_b->quantity;
            $qual['C'] = $stock_c->quantity - $record_c->quantity; $qual['D'] = $stock_d->quantity - $record_d->quantity;
            $rice[$type->name] = $qual;
        }
        return $rice;
    }
}
