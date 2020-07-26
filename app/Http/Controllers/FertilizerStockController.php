<?php

namespace App\Http\Controllers;

use App\FertilizerStock;
use App\FertilizerTrader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FertilizerStockController extends Controller
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
        $stock = $this->getStockInfo();
        $dates = Auth::user()->fertilizerStocks()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $stocks = Auth::user()->fertilizerStocks()->latest()->get();
        return view('dashboard.stock.fertilizer.index', [
            'dates' => $dates, 'stocks' => $stocks, 'urea' => $stock['urea'], 'dap' => $stock['dap']
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
            $trader = FertilizerTrader::find($s_id);
            return view('dashboard.stock.fertilizer.create', ['trader' => $trader]);
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
                'type'                      =>      'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $created = Auth::user()->fertilizerStocks()->create([
                    'quantity'                      =>      $request->get('quantity'),
                    'weight'                        =>      $request->get('weight'),
                    'price'                         =>      $request->get('price'),
                    'type'                          =>      $request->get('type'),
                    'fertilizer_trader_id'          =>      $s_id
                ]);
                if ($created) {
                    return redirect()->route('fertilizerStock.show', base64_encode(($created->id * 123456789) / 12098))->with('success', 'Fertilizer stock added successfully.');
                } else {
                    return back()->with('error', 'An error occured while adding fertilizer stock.');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FertilizerStock  $fertilizerStock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $stock = FertilizerStock::find($s_id);
            return view('dashboard.stock.fertilizer.show', ['stock' => $stock]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FertilizerStock  $fertilizerStock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $stock = FertilizerStock::find($s_id);
            return view('dashboard.stock.fertilizer.edit', ['stock' => $stock]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FertilizerStock  $fertilizerStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'quantity'                      =>      'required|numeric|min:0',
                'weight'                        =>      'required|numeric|min:0',
                'price'                         =>      'required|numeric|min:0',
                'type'                          =>      'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $updated = FertilizerStock::find($s_id)->update([
                    'quantity'                  =>      $request->get('quantity'),
                    'weight'                    =>      $request->get('weight'),
                    'price'                     =>      $request->get('price'),
                    'type'                      =>      $request->get('type')
                ]);

                if ($updated) {
                    return redirect()->route('fertilizerStock.show', $id)->with('success', 'Fertilizer Stock updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating fertilizer stock.');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FertilizerStock  $fertilizerStock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $destroyed = FertilizerStock::destroy($s_id);
            if ($destroyed) {
                return redirect()->route('fertilizerStock.index')->with('success', 'Fertilizer Stock deleted successfully.');
            } else {
                return back()->with('error', 'An error occured while deleting fertilizer stock.');
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
