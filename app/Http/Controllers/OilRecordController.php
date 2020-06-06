<?php

namespace App\Http\Controllers;

use App\FillingStation;
use App\OilRecord;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        return view('dashboard.roznamcha.oil.index', ['dates' => $oil_dates,'oils' => $oil_records]);
    }

    public function fillingStations($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $profile = Profile::find($s_id);
            $stations = Auth::User()->manyFillingStations()->latest()->get();
            return view('dashboard.roznamcha.oil.filling-stations', ['profile' => $profile, 'stations' => $stations]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $station)
    {
        if ($id && $station) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $s_station = (base64_decode($station) * 12098) / 123456789;
            $profile = Profile::find($s_id);
            $station = FillingStation::find($s_station);
            return view('dashboard.roznamcha.oil.create', ['profile' => $profile, 'station' => $station]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $station)
    {
        if ($id && $station) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $s_station = (base64_decode($station) * 12098) / 123456789;

            $validator = Validator::make($request->all(), [
                'quantity'                  =>      'required|numeric'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $quantity = trim($request->get('quantity'));
                $created = Auth::user()->oilRecords()->create([
                    'quantity'                  =>      $quantity,
                    'filling_station_id'        =>      $s_station,
                    'profile_id'                =>      $s_id
                ]);
                if ($created) {
                    return redirect()->route('oilRecord.show', base64_encode(($created->id * 123456789) / 12098))->with('success', 'Record created successfully. Print this slip.');
                } else {
                    return back()->with('error', 'An error occured while creating oil record')->withInput();
                }

            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OilRecord  $oilRecord
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $oil_record = OilRecord::find($s_id);
            return view('dashboard.roznamcha.oil.show', ['record' => $oil_record]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OilRecord  $oilRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $record = OilRecord::find($s_id);
            return view('dashboard.roznamcha.oil.edit', ['record' => $record]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OilRecord  $oilRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $validator = Validator::make($request->all(), [
                'price_per_litre'               =>      'required|numeric',
                'paid_per_litre'               =>      'required|numeric'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $updated = OilRecord::find($s_id)->update([
                    'price_per_litre'           =>      trim($request->get('price_per_litre')),
                    'paid_per_litre'           =>      trim($request->get('paid_per_litre'))
                ]);
                if ($updated) {
                    return redirect()->route('oilRecord.show', $id)->with('success', 'Bill updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating bill.');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OilRecord  $oilRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $destroyed = OilRecord::destroy($s_id);
            if ($destroyed) {
                return redirect()->route('oilRecord.index')->with('success', 'Bill deleted successfully.');
            } else {
                return redirect()->route('oilRecord.index')->with('error', 'An error occured while deleting bill.');
            }

        }
    }

    public function searchOilRecord(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->get('name');
            $output = '';
            if ($name !== "") {
                $records = Auth::user()->oilRecords()->join('profiles', 'profiles.id', '=', 'oil_records.profile_id')->join('filling_stations', 'filling_stations.id', '=', 'oil_records.filling_station_id')
                ->select('profiles.id as profile_id', 'profiles.name as profile_name', 'oil_records.id as id', 'oil_records.quantity as quantity', 'oil_records.price_per_litre as price_per_litre', 'oil_records.paid_per_litre as paid_per_litre', 'oil_records.created_at as created_at', 'filling_stations.id as station_id', 'filling_stations.name as station_name')
                ->where('profiles.name', 'like', '%' . $name . '%')->latest()->get();
                if ($records->count() > 0) {
                    $table1 = '<div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th>Customer / <span class="text-urdu-kasheeda">خریدار</span></th>
                                    <th>Quantity / <span class="text-urdu-kasheeda">مقدار</span></th>
                                    <th>Price / <span class="text-urdu-kasheeda">قیمت</span></th>
                                    <th>Price Paid / <span class="text-urdu-kasheeda">ادا شدہ قیمت</span></th>
                                    <th>Total Price / <span class="text-urdu-kasheeda">کل قیمت</span></th>
                                    <th>Filling Station / <span class="text-urdu-kasheeda">پیٹرول پمپ</span></th>
                                    <th>Date &amp; Time / <span class="text-urdu-kasheeda">تاریخ اور وقت</span></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>';
                            $table2 = '';
                            foreach ($records as $record) {
                                $table2 .= '<tr>
                                    <td class="align-middle"><a class="view-customers" data-id="'. base64_encode(($record->profile_id * 123456789) / 12098) .'" href="">' . $record->profile_name . '</a></td>
                                    <td class="align-middle">' . $record->quantity . ' Litres</td>
                                    <td class="align-middle">Rs ' . $record->price_per_litre . ' /-</td>
                                    <td class="align-middle">Rs ' . $record->paid_per_litre . ' /-</td>
                                    <td class="align-middle">Rs ' . ($record->paid_per_litre * $record->quantity) . ' /-</td>
                                    <td class="align-middle"><a data-id="'. base64_encode(($record->station_id * 123456789) / 12098) .'" class="view-stations" href="">' . $record->station_name . '</a></td>
                                    <td class="align-middle">' . date('d-F-Y h:i A', strtotime($record->created_at)) . '</td>
                                    <td class="align-middle">
                                        <a href="' . route('oilRecord.show', base64_encode(($record->id * 123456789) / 12098)) . '" class="d-inline">View Bill</a>
                                        <p class="mb-0 d-inline"> | </p>
                                        <a href="' . route('oilRecord.edit', base64_encode(($record->id * 123456789) / 12098)) . '" class="d-inline">Edit Bill</a>
                                        <p class="mb-0 d-inline"> | </p>
                                        <form action="' . route('oilRecord.destroy', base64_encode(($record->id * 123456789) / 12098)) . '" method="post" class="d-inline">
                                            '. csrf_field() .'
                                            ' . method_field('DELETE') . '
                                            <button type="submit" class="btn btn-link m-0 p-0 destroy-bill">Delete Bill</button>
                                        </form>
                                    </td>
                                </tr>';
                            }
                            $table3 = '</tbody>
                        </table>
                    </div>';
                    $output = $table1.$table2.$table3;
                } else {
                    $output .= '<h5 class="alert alert-danger w-50 mx-auto text-center font-italic">No record found.</h5>';
                }
            }

            $data = ['name_results' => $output];
            return json_encode($data);
        }
    }
}
