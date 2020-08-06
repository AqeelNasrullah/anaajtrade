<?php

namespace App\Http\Controllers;

use App\FertilizerRecord;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FertilizerRecordController extends Controller
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
        $urea = Auth::user()->fertilizerRecords()->selectRaw('sum(quantity) as quantity')->where('created_at', '>', $date)->first();
        $urea_sack = Auth::user()->fertilizerRecords()->select('paid')->where('created_at', '>', $date)->latest()->first();
        $urea_price = Auth::user()->fertilizerRecords()->selectRaw('sum(quantity * price) as amount')->where('created_at', '>', $date)->first();
        $urea_paid = Auth::user()->fertilizerRecords()->selectRaw('sum(quantity * paid) as amount')->where('created_at', '>', $date)->first();
        $urea_profit = $urea_paid->amount - $urea_price->amount;

        $dates = Auth::user()->fertilizerRecords()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $records = Auth::user()->fertilizerRecords()->latest()->get();
        return view('dashboard.roznamcha.fertilizer.index', [
            'dates' => $dates, 'records' => $records, 'urea' => $urea, 'urea_sack' => $urea_sack, 'urea_price' => $urea_price, 'urea_paid' => $urea_paid,
            'urea_profit' => $urea_profit
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
            $stock = $this->getStockInfo();
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $profile = Profile::find($s_id);
            $stock_intake = Auth::user()->fertilizerStocks()->sum('quantity');
            $sale = Auth::user()->fertilizerRecords()->sum('quantity');
            $remain = $stock_intake - $sale;
            return view('dashboard.roznamcha.fertilizer.create', ['profile' => $profile, 'stock' => $stock]);
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
                'weight'                    =>      'required|numeric|min:0',
                'price'                     =>      'required|numeric|min:0',
                'paid'                      =>      'required|numeric|min:0',
                'type'                      =>      'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $added = Auth::user()->fertilizerRecords()->create([
                    'quantity'              =>      $request->get('quantity'),
                    'weight'                =>      $request->get('weight'),
                    'price'                 =>      $request->get('price'),
                    'paid'                  =>      $request->get('paid'),
                    'type'                  =>      $request->get('type'),
                    'profile_id'            =>      $s_id
                ]);
                if ($added) {
                    return redirect()->route('fertilizerRecord.show', base64_encode(($added->id * 123456789) / 12098))->with('success', 'Fertilizer record added successfully.');
                } else {
                    return back()->with('error', 'An error occured while adding fertilizer record.');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FertilizerRecord  $fertilizerRecord
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $record = FertilizerRecord::find($s_id);
            return view('dashboard.roznamcha.fertilizer.show', ['record' => $record]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FertilizerRecord  $fertilizerRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $record = FertilizerRecord::find($s_id);
            return view('dashboard.roznamcha.fertilizer.edit', ['record' => $record]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FertilizerRecord  $fertilizerRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'quantity'                  =>      'required|numeric|min:0',
                'weight'                    =>      'required|numeric|min:0',
                'price'                     =>      'required|numeric|min:0',
                'paid'                      =>      'required|numeric|min:0',
                'type'                      =>      'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $updated = FertilizerRecord::find($s_id)->update([
                    'quantity'              =>      $request->get('quantity'),
                    'weight'                =>      $request->get('weight'),
                    'price'                 =>      $request->get('price'),
                    'paid'                  =>      $request->get('paid'),
                    'type'                  =>      $request->get('type')
                ]);
                if ($updated) {
                    return redirect()->route('fertilizerRecord.show', $id)->with('success', 'Fertilizer record updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating fertilizer record.');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FertilizerRecord  $fertilizerRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $deleted = FertilizerRecord::destroy($s_id);
            if ($deleted) {
                return redirect()->route('fertilizerRecord.index')->with('success', 'Fertilizer record deleted successfully.');
            } else {
                return back()->with('error', 'An error occured while deleting fertilizer record.');
            }
        }
    }

    // Get Stock Info
    public function getStockInfo()
    {
        $stock = [];
        $urea_stock = Auth::user()->fertilizerStocks()->selectRaw('sum(quantity) as quantity')->where('type', 'Urea')->first();
        $urea_record = Auth::user()->fertilizerRecords()->selectRaw('sum(quantity) as quantity')->where('type', 'Urea')->first();
        $stock['urea'] = $urea_stock->quantity - $urea_record->quantity;

        $dap_stock = Auth::user()->fertilizerStocks()->selectRaw('sum(quantity) as quantity')->where('type', 'DAP')->first();
        $dap_record = Auth::user()->fertilizerRecords()->selectRaw('sum(quantity) as quantity')->where('type', 'DAP')->first();
        $stock['dap'] = $dap_stock->quantity - $dap_record->quantity;
        return $stock;
    }
}
