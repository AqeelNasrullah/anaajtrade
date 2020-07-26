<?php

namespace App\Http\Controllers;

use App\Profile;
use App\RiceType;
use App\WheatStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WheatStockController extends Controller
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
        $price = $this->getPriceInfo();
        $dates = Auth::user()->wheatStocks()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $records = Auth::user()->wheatStocks()->latest()->get();
        return view('dashboard.stock.wheat.index', [
            'dates' => $dates, 'records' => $records, 'price' => $price
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
            return view('dashboard.stock.wheat.create', ['profile' => $profile]);
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
                'num_of_sacks'                  =>      'required|numeric|min:0',
                'weight_per_sack'               =>      'required|numeric|min:0',
                'price_per_sack'                =>      'required|numeric|min:0',
                'commission'                    =>      'required|numeric|min:0',
                'category'                      =>      'required'
            ]);

            if($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $added = Auth::user()->wheatStocks()->create([
                    'num_of_sack'               =>      trim($request->get('num_of_sacks')),
                    'weight_per_sack'           =>      trim($request->get('weight_per_sack')),
                    'price'                     =>      trim($request->get('price_per_sack')),
                    'commission'                =>      trim($request->get('commission')),
                    'category'                  =>      trim($request->get('category')),
                    'profile_id'                =>      $s_id
                ]);

                if ($added) {
                    return redirect()->route('wheatStock.show', base64_encode(($added->id * 123456789) / 12098))->with('success', 'Wheat stock added successfully.');
                } else {
                    return back()->with('error', 'An error occured while adding wheat stock.')->withInput();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WheatStock  $wheatStock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $wheat_stock = WheatStock::find($s_id);
            return view('dashboard.stock.wheat.show', ['stock' => $wheat_stock]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WheatStock  $wheatStock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $wheat_stock = WheatStock::find($s_id);
            return view('dashboard.stock.wheat.edit', ['stock' => $wheat_stock]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WheatStock  $wheatStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'num_of_sacks'                  =>      'required|numeric|min:0',
                'weight_per_sack'               =>      'required|numeric|min:0',
                'price_per_sack'                =>      'required|numeric|min:0',
                'commission'                    =>      'required|numeric|min:0',
                'category'                      =>      'required'
            ]);

            if($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $updated = WheatStock::find($s_id)->update([
                    'num_of_sack'               =>      trim($request->get('num_of_sacks')),
                    'weight_per_sack'           =>      trim($request->get('weight_per_sack')),
                    'price'                     =>      trim($request->get('price_per_sack')),
                    'commission'                =>      trim($request->get('commission')),
                    'category'                  =>      $request->get('category'),
                ]);
                if ($updated) {
                    return redirect()->route('wheatStock.show', $id)->with('success', 'Wheat stock updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating wheat stock.');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WheatStock  $wheatStock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $destroyed = WheatStock::destroy($s_id);
            if ($destroyed) {
                return redirect()->route('wheatStock.index')->with('success', 'Wheat stock deleted successfully.');
            } else {
                return redirect()->route('wheatStock.index')->with('error', 'An error occured while deleting wheat stock.');
            }
        }
    }

    // Get Prices Info
    public function getPriceInfo()
    {
        $price = [];
        $date = date('Y-m-d', time());
        $wheat_mann = Auth::user()->wheatStocks()->select('price')->latest()->first();
        $wheat_price = Auth::user()->wheatStocks()->selectRaw('sum(((num_of_sack * weight_per_sack) / 40) * price) as amount')->where('created_at', '>', $date)->first();
        $wheat_com = Auth::user()->wheatStocks()->selectRaw('sum((commission / 100) * (((num_of_sack * weight_per_sack) / 40) * price)) as amount')->where('created_at', '>', $date)->first();
        $wheat_paid = $wheat_price->amount - $wheat_com->amount;
        $price['mann'] = $wheat_mann->price; $price['paid'] = $wheat_paid; $price['com'] = $wheat_com->amount;
        return $price;
    }
}
