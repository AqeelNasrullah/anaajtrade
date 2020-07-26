<?php

namespace App\Http\Controllers;

use App\MedicineStock;
use App\MedicineTrader;
use App\MedicineType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MedicineStockController extends Controller
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
        $stock_dets = $this->getStockInfo();
        $dates = Auth::user()->medicineStocks()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $stocks = Auth::user()->medicineStocks()->latest()->get();
        return view('dashboard.stock.medicine.index', [
            'dates' => $dates, 'stocks' => $stocks, 'stock_dets' => $stock_dets
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
            $trader = MedicineTrader::find($s_id);
            $types = MedicineType::all();
            return view('dashboard.stock.medicine.create', ['trader' => $trader, 'types' => $types]);
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
                'medicine'                  =>      'required',
                'quantity'                  =>      'required|numeric|min:0',
                'price'                     =>      'required|numeric|min:0'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $types = explode(' ', $request->get('medicine'));
                $created = Auth::user()->medicineStocks()->create([
                    'type'                          =>      $types[1],
                    'quantity'                      =>      $request->get('quantity'),
                    'price'                         =>      $request->get('price'),
                    'medicine_type_id'              =>      $types[0],
                    'medicine_trader_id'            =>      $s_id
                ]);
                if ($created) {
                    return redirect()->route('medicineStock.show', base64_encode(($created->id * 123456789) / 12098))->with('success', 'Fertilizer stock added successfully.');
                } else {
                    return back()->with('error', 'An error occured while adding medicine stock.');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $stock = MedicineStock::find($s_id);
            return view('dashboard.stock.medicine.show', ['stock' => $stock]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $stock = MedicineStock::find($s_id);
            $medicine_types = MedicineType::all();
            return view('dashboard.stock.medicine.edit', ['stock' => $stock, 'medicine_types' => $medicine_types]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'medicine'                      =>      'required',
                'quantity'                      =>      'required|numeric|min:0',
                'price'                         =>      'required|numeric|min:0'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $type = explode(' ', $request->get('medicine'));
                $updated = MedicineStock::find($s_id)->update([
                    'quantity'                  =>      $request->get('quantity'),
                    'price'                     =>      $request->get('price'),
                    'type'                      =>      $type[1],
                    'medicine_type_id'          =>      $type[0]
                ]);

                if ($updated) {
                    return redirect()->route('medicineStock.show', $id)->with('success', 'Medicine Stock updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating medicine stock.');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $destroyed = MedicineStock::destroy($s_id);
            if ($destroyed) {
                return redirect()->route('medicineStock.index')->with('success', 'Medicine Stock deleted successfully.');
            } else {
                return back()->with('error', 'An error occured while deleting medicine stock.');
            }
        }
    }

    // Get Stock Info
    public function getStockInfo()
    {
        $stock = [];
        $types = MedicineType::all();
        foreach ($types as $type) {
            $med_stock[$type->name] = Auth::user()->medicineStocks()->selectRaw('sum(quantity) as quantity')->where('medicine_type_id', $type->id)->first();
            $med_record[$type->name] = Auth::user()->medicineRecords()->selectRaw('sum(quantity) as quantity')->where('medicine_type_id', $type->id)->first();
            $stock[$type->name] = $med_stock[$type->name]->quantity - $med_record[$type->name]->quantity;
        }
        return $stock;
    }
}
