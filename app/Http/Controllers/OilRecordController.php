<?php

namespace App\Http\Controllers;

use App\OilRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OilRecordController extends Controller
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
        $oil_dates = Auth::user()->oilRecords()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $oil_records = Auth::user()->oilRecords()->latest()->get();
        return view('dashboard.oil.index', ['dates' => $oil_dates,'oils' => $oil_records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OilRecord  $oilRecord
     * @return \Illuminate\Http\Response
     */
    public function show(OilRecord $oilRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OilRecord  $oilRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(OilRecord $oilRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OilRecord  $oilRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OilRecord $oilRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OilRecord  $oilRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(OilRecord $oilRecord)
    {
        //
    }
}
