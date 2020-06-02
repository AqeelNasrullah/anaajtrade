<?php

namespace App\Http\Controllers;

use App\FillingStation;
use App\OilCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FillingStationController extends Controller
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
        $fillingStations = Auth::User()->manyFillingStations()->latest()->paginate(10);
        return view('dashboard.filling-stations.index', ['stations' => $fillingStations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = OilCompany::all();
        return view('dashboard.filling-stations.create', ['companies' => $companies]);
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
            'name'              =>  'required|min:3',
            'phone_number'      =>  'required|min:5',
            'company'           =>  'required'
        ];
        if($request->get('address')) {
            $rules['address'] = 'min:3';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            dd($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FillingStation  $fillingStation
     * @return \Illuminate\Http\Response
     */
    public function show(FillingStation $fillingStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FillingStation  $fillingStation
     * @return \Illuminate\Http\Response
     */
    public function edit(FillingStation $fillingStation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FillingStation  $fillingStation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FillingStation $fillingStation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FillingStation  $fillingStation
     * @return \Illuminate\Http\Response
     */
    public function destroy(FillingStation $fillingStation)
    {
        //
    }
}
