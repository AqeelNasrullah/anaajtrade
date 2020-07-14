<?php

namespace App\Http\Controllers;

use App\FillingStation;
use App\FillingStationUser;
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
            $station = FillingStation::where('phone_number', addslashes(htmlentities(trim($request->get('phone_number')))))->first();
            if ($station) {
                $attached = Auth::user()->manyFillingStations()->where('filling_station_id', $station->id)->first();
                if($attached) {
                    return redirect()->route('fillingStation.index')->with('success', 'Filling station already exists.')->withInput();
                } else {
                    Auth::User()->manyFillingStations()->attach($station);
                    return redirect()->route('fillingStation.index')->with('success', 'Filling station created successfully.');
                }
            } else {
                $create = FillingStation::create([
                    'name'                  =>      addslashes(htmlentities(trim($request->get('name')))),
                    'phone_number'          =>      addslashes(htmlentities(trim($request->get('phone_number')))),
                    'address'               =>      addslashes(htmlentities(trim($request->get('address')))),
                    'oil_company_id'        =>      $request->get('company')
                ]);
                if ($create) {
                    Auth::User()->manyFillingStations()->attach($create);
                    return redirect()->route('fillingStation.index')->with('success', 'Filling station created successfully.');
                } else {
                    return back()->with('error', 'An error occured while creating filling station.')->withInput();
                }
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FillingStation  $fillingStation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $station = FillingStation::find($s_id);
            $dates = Auth::user()->oilRecords()->selectRaw('date(created_at) as date')->where('filling_station_id', $s_id)->distinct()->latest()->get();
            $records = Auth::user()->oilRecords()->where('filling_station_id', $s_id)->latest()->get();
            if ($station) {
                return view('dashboard.filling-stations.show', ['station' => $station, 'dates' => $dates, 'records' => $records]);
            } else {
                return redirect()->route('fillingStation.index');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FillingStation  $fillingStation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $station = FillingStation::find($s_id);
            if ($station) {
                $companies = OilCompany::all();
                return view('dashboard.filling-stations.edit', ['station' => $station, 'companies' => $companies]);
            } else {
                return redirect()->route('fillingStation.index');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FillingStation  $fillingStation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $rules = [
                'name'                  =>      'required|min:3',
                'phone_number'          =>      'required|min:5',
                'company'               =>      'required'
            ];
            if($request->get('address')) {
                $rules['address'] = 'min:3';
            }
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $station = FillingStation::find($s_id)->update([
                    'name'                  =>      addslashes(htmlentities(trim($request->get('name')))),
                    'phone_number'          =>      addslashes(htmlentities(trim($request->get('phone_number')))),
                    'address'               =>      addslashes(htmlentities(trim($request->get('address')))),
                    'oil_company_id'        =>      $request->get('company')
                ]);

                if ($station) {
                    return redirect()->route('fillingStation.index')->with('success', 'Filling Station updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating filling station.');
                }

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FillingStation  $fillingStation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = ((base64_decode($id) * 12098) / 123456789);
            $removeStation = Auth::User()->manyFillingStations()->detach($s_id);
            if($removeStation) {
                return redirect()->route('fillingStation.index')->with('success', 'Filling station deleted successfully.');
            } else {
                return redirect()->route('fillingStation.index')->with('error', 'An error occured while deleting filling station.');
            }
        }
    }

    public function filterFillingStation(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('station');
            $output = '';
            if ($search != "") {
                $stations = Auth::User()->manyFillingStations()->where(function($query) use ($search) {
                    $query->where('name', 'like', '%'. $search . '%')->orWhere('phone_number', 'like', '%'. $search . '%');
                })->latest()->get();
            } else {
                $stations = Auth::user()->manyFillingStations()->latest()->get();
            }

            if ($stations->count() > 0) {
                foreach ($stations as $station) {
                    $output .= '<tr>
                        <td class="align-middle"><img src="'. asset('images/logos/'.$station->oilCompany->avatar) .'" width="40px" alt="Image not found"></td>
                        <td class="align-middle">'. $station->name .'</td>
                        <td class="align-middle">'. $station->phone_number .'</td>
                        <td class="align-middle">'. $station->address .'</td>
                        <td class="align-middle">'. $station->oilCompany->name .'</td>
                        <td class="align-middle">
                            <a class="d-inline station-popup" data-id="'. base64_encode(($station->id * 123456789) / 12098) .'" href="">View</a>
                            <p class="mb-0 d-inline"> | </p>
                            <a class="d-inline" href="'. route('fillingStation.edit', base64_encode(($station->id * 123456789) / 12098)) .'">Edit</a>
                            <p class="mb-0 d-inline"> | </p>
                            <form action="'. route('fillingStation.destroy', base64_encode(($station->id * 123456789) / 12098)) .'" method="post">
                                '. csrf_field() .'
                                '. method_field('DELETE') .'
                                <button class="btn btn-link p-0 m-0 d-inline stations-delete">Delete</button>
                            </form>
                        </td>
                    </tr>';
                }
            } else {
                $output .= '<tr>
                    <td colspan="6" class="text-center">No filling station found.</td>
                </tr>';
            }

            $data = ['data_output'=>$output];
            return json_encode($data);
        }
    }

    public function searchFillingStation(Request $request)
    {
        if ($request->ajax()) {
            $s_id = $request->get('id');
            $output = '';
            if ($s_id) {
                $id = (base64_decode($s_id) * 12098) / 123456789;
                $station = FillingStation::find($id);
                if ($station) {
                    $output .= '<div class="modal fade" id="station-search-popup">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="station-header">
                                        <div class="float-left mr-2" style="width: 75px;height: 75px;border: 1px solid black;border-radius: 5px;overflow: hidden;"><img src="'. asset('images/logos/'.$station->oilCompany->avatar) .'" alt="Image not found" width="100%"></div>
                                        <div class="float-left" style="width: calc(100% - 85px);">
                                            <h2 class="fw-900">'. $station->name .'</h2>
                                            <div class="row">
                                                <h5 class=" col-md-12 mb-0 fw-700"><i class="fas fa-phone"></i> '. $station->phone_number .'</h5>
                                                <h6 class=" col-md-12 mb-0"><i class="fas fa-map-marker-alt"></i> '. $station->address .'</h6>
                                            </div>
                                        </div>
                                        <br class="clear">
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <p class="col-md-6 mb-0"><strong>Oil Company:</strong> '. $station->oilCompany->name .'</p>
                                        <p class="col-md-6 mb-0"><strong>Company Phone:</strong> '. $station->oilCompany->phone_number .'</p>
                                        <p class="col-md-12 mb-0"><strong>Company Address:</strong> '. $station->oilCompany->address .'</p>
                                    </div>
                                    <div>
                                        <a href="'. route('fillingStation.edit', base64_encode(($station->id * 123456789) / 12098)) .'" class="btn btn-success float-right"><i class="fas fa-edit"></i> Edit Filling Station</a>
                                        <a href="'. route('fillingStation.show', base64_encode(($station->id * 123456789) / 12098)) .'" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-gas-pump"></i> View Detail</a>
                                        <button class="btn btn-danger float-right mr-2" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                } else {
                    $output .= '<div class="alert alert-danger">
                        <button class="close" data-dismiss="alert">&times;</button>
                        No filling station found.
                    </div>';
                }
            }
            $data = ['data_output'=>$output];
            return json_encode($data);
        }
    }
}
