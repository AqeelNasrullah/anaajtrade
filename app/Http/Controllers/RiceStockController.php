<?php

namespace App\Http\Controllers;

use App\Profile;
use App\RiceStock;
use App\RiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RiceStockController extends Controller
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
        $stock = $this->getPriceInfo();
        $dates = Auth::user()->riceStocks()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $records = Auth::user()->riceStocks()->latest()->get();
        return view('dashboard.stock.rice.index', ['dates' => $dates, 'records' => $records, 'stock' => $stock]);
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
            return view('dashboard.stock.rice.create', ['profile' => $profile, 'types' => $types]);
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
                'type'                          =>      'required',
                'category'                      =>      'required'
            ]);

            if($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $added = Auth::user()->riceStocks()->create([
                    'num_of_sack'               =>      trim($request->get('num_of_sacks')),
                    'weight_per_sack'           =>      trim($request->get('weight_per_sack')),
                    'price'                     =>      trim($request->get('price_per_sack')),
                    'commission'                =>      trim($request->get('commission')),
                    'rice_type_id'                      =>      $request->get('type'),
                    'category'                  =>      $request->get('category'),
                    'profile_id'                =>      $s_id
                ]);

                if ($added) {
                    return redirect()->route('riceStock.show', base64_encode(($added->id * 123456789) / 12098))->with('success', 'Wheat stock added successfully.');
                } else {
                    return back()->with('error', 'An error occured while adding rice stock.')->withInput();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RiceStock  $riceStock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $wheat_stock = RiceStock::find($s_id);
            return view('dashboard.stock.rice.show', ['stock' => $wheat_stock]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RiceStock  $riceStock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $wheat_stock = RiceStock::find($s_id);
            $types = RiceType::all();
            return view('dashboard.stock.rice.edit', ['stock' => $wheat_stock, 'types' => $types]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RiceStock  $riceStock
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
                'type'                          =>      'required',
                'category'                      =>      'required'
            ]);

            if($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $updated = RiceStock::find($s_id)->update([
                    'num_of_sack'               =>      trim($request->get('num_of_sacks')),
                    'weight_per_sack'           =>      trim($request->get('weight_per_sack')),
                    'price'                     =>      trim($request->get('price_per_sack')),
                    'commission'                =>      trim($request->get('commission')),
                    'rice_type_id'              =>      $request->get('type'),
                    'category'                  =>      $request->get('category')
                ]);
                if ($updated) {
                    return redirect()->route('riceStock.show', $id)->with('success', 'Rice stock updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating rice stock.');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RiceStock  $riceStock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $destroyed = RiceStock::destroy($s_id);
            if ($destroyed) {
                return redirect()->route('riceStock.index')->with('success', 'Rice stock deleted successfully.');
            } else {
                return redirect()->route('riceStock.index')->with('error', 'An error occured while deleting rice stock.');
            }
        }
    }

    // Get Prices Info
    public function getPriceInfo()
    {
        $price = [];
        $date = date('Y-m-d', time());
        $rice_mann = Auth::user()->riceStocks()->select('price')->latest()->first();
        $rice_price = Auth::user()->riceStocks()->selectRaw('sum(((num_of_sack * weight_per_sack) / 40) * price) as amount')->where('created_at', '>', $date)->first();
        $rice_com = Auth::user()->riceStocks()->selectRaw('sum((commission / 100) * (((num_of_sack * weight_per_sack) / 40) * price)) as amount')->where('created_at', '>', $date)->first();
        $rice_paid = $rice_price->amount - $rice_com->amount;
        $price['mann'] = $rice_mann->price; $price['paid'] = $rice_paid; $price['com'] = $rice_com->amount;
        return $price;
    }
}
