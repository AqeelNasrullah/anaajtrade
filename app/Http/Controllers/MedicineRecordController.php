<?php

namespace App\Http\Controllers;

use App\MedicineRecord;
use App\MedicineType;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MedicineRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = Auth::user()->medicineRecords()->selectRaw('date(created_at) as date')->distinct()->latest()->simplePaginate(7);
        $records = Auth::user()->medicineRecords()->latest()->get();
        return view('dashboard.roznamcha.medicine.index', ['dates' => $dates, 'records' => $records]);
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
            $stock_intake = Auth::user()->medicineStocks()->sum('quantity');
            $sale = Auth::user()->medicineRecords()->sum('quantity');
            $remain = $stock_intake - $sale;
            $types = MedicineType::all();
            return view('dashboard.roznamcha.medicine.create', ['profile' => $profile, 'remain' => $remain, 'types' => $types]);
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
                'price'                     =>      'required|numeric|min:0',
                'paid'                      =>      'required|numeric|min:0'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $types = explode(' ', $request->get('medicine'));
                $added = Auth::user()->medicineRecords()->create([
                    'quantity'              =>      $request->get('quantity'),
                    'price'                 =>      $request->get('price'),
                    'paid'                  =>      $request->get('paid'),
                    'type'                  =>      $types[1],
                    'medicine_type_id'      =>      $types[0],
                    'profile_id'            =>      $s_id
                ]);
                if ($added) {
                    return redirect()->route('medicineRecord.show', base64_encode(($added->id * 123456789) / 12098))->with('success', 'Medicine record added successfully.');
                } else {
                    return back()->with('error', 'An error occured while adding medicine record.');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicineRecord  $medicineRecord
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $record = MedicineRecord::find($s_id);
            return view('dashboard.roznamcha.medicine.show', ['record' => $record]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicineRecord  $medicineRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $record = MedicineRecord::find($s_id);
            $types = MedicineType::all();
            return view('dashboard.roznamcha.medicine.edit', ['record' => $record, 'types' => $types]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicineRecord  $medicineRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $validator = Validator::make($request->all(), [
                'medicine'                  =>      'required',
                'quantity'                  =>      'required|numeric|min:0',
                'price'                     =>      'required|numeric|min:0',
                'paid'                      =>      'required|numeric|min:0'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $types = explode(' ', $request->get('medicine'));
                $updated = MedicineRecord::find($s_id)->update([
                    'quantity'              =>      $request->get('quantity'),
                    'price'                 =>      $request->get('price'),
                    'paid'                  =>      $request->get('paid'),
                    'type'                  =>      $types[1],
                    'medicine_type_id'      =>      $types[0]
                ]);
                if ($updated) {
                    return redirect()->route('medicineRecord.show', $id)->with('success', 'Medicine record updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating medicine record.');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicineRecord  $medicineRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $deleted = MedicineRecord::destroy($s_id);
            if ($deleted) {
                return redirect()->route('medicineRecord.index')->with('success', 'Medicine record deleted successfully.');
            } else {
                return back()->with('error', 'An error occured while deleting medicine record.');
            }
        }
    }
}