<?php

namespace App\Http\Controllers;

use App\MedicineTrader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MedicineTraderController extends Controller
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
        $traders = Auth::user()->manyMedicineTraders()->orderBy('medicine_trader_user.created_at', 'DESC')->paginate(10);
        return view('dashboard.medicine-traders.index', ['traders' => $traders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.medicine-traders.create');
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
            'name'                      =>      'required|min:3',
            'phone_number'              =>      'required|min:12|max:12',
            'address'                   =>      'required'
        ];
        if ($request->hasFile('avatar')) {
            $rules['avatar'] = 'mimes:png,jpg,jpeg,gif|max:2048';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $phone_number = '+92 ' . substr($request->get('phone_number'), 1);
            $trader = MedicineTrader::where('phone_number', $phone_number)->first();
            if ($trader) {
                $rel_trader = Auth::user()->manyMedicineTraders()->where('medicine_trader_id', $trader->id)->first();
                if ($rel_trader) {
                    return redirect()->route('medicineTraders.index')->with('success', 'Medicine trader already exists.');
                } else {
                    Auth::user()->manyMedicineTraders()->attach($trader);
                    return redirect()->route('medicineTraders.index')->with('success', 'Medicine trader added successfully');
                }
            } else {
                $filename = 'logo.png';
                if ($request->hasFile('avatar')) {
                    $avatar = $request->file('avatar');
                    $filename = 'ATM_MT_' . time() . '.' . $avatar->getClientOriginalExtension();
                    $uploaded = $avatar->move(public_path('/images/logos/'), $filename);
                    if (!$uploaded) {
                        return back()->with('error', 'An error occured while uploading avatar.');
                    }
                }
                $added = Auth::user()->manyMedicineTraders()->create([
                    'avatar'                =>      $filename,
                    'name'                  =>      addslashes(htmlentities($request->get('name'))),
                    'phone_number'          =>      $phone_number,
                    'address'               =>      addslashes(htmlentities($request->get('address')))
                ]);
                if ($added) {
                    return redirect()->route('medicineTraders.index')->with('success', 'Medicine trader added successfully');
                } else {
                    return back()->with('error', 'An error occured while adding medicine trader.');
                }

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicineTrader  $medicineTrader
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $trader = MedicineTrader::find($s_id);
            $stocks = Auth::user()->medicineStocks()->where('medicine_trader_id', $s_id)->latest()->get();
            return view('dashboard.medicine-traders.show', ['trader' => $trader, 'stocks' => $stocks]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicineTrader  $medicineTrader
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $trader = MedicineTrader::find($s_id);
            return view('dashboard.medicine-traders.edit', ['trader' => $trader]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicineTrader  $medicineTrader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {
            $rules = [
                'name'                      =>      'required|min:3',
                'phone_number'              =>      'required|min:12|max:12',
                'address'                   =>      'required'
            ];
            if ($request->hasFile('avatar')) {
                $rules['avatar'] = 'mimes:png,jpg,jpeg,gif|max:2048';
            }
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $s_id = (base64_decode($id) * 12098) / 123456789;
                $trader = MedicineTrader::find($s_id);
                $filename = $trader->avatar;
                if ($request->hasFile('avatar')) {
                    $avatar = $request->file('avatar');
                    $filename = 'ATM_MT_' . time() . '.' . $avatar->getClientOriginalExtension();
                    $uploaded = $avatar->move(public_path('/images/logos/'), $filename);
                    if (!$uploaded) {
                        return back()->with('error', 'An error occured while uploading avatar.');
                    }
                }
                $updated = $trader->update([
                    'avatar'                =>      $filename,
                    'name'                  =>      addslashes(htmlentities($request->get('name'))),
                    'phone_number'          =>      '+92 ' . substr($request->get('phone_number'), 1),
                    'address'               =>      addslashes(htmlentities($request->get('address')))
                ]);
                if ($updated) {
                    return redirect()->route('medicineTraders.index')->with('success', 'Medicine trader updated successfully.');
                } else {
                    return back()->with('error', 'An error occured while updating medicine trader.');
                }

            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicineTrader  $medicineTrader
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            $s_id = (base64_decode($id) * 12098) / 123456789;
            $deleted = Auth::user()->manyMedicineTraders()->detach($s_id);
            if ($deleted) {
                return back()->with('success', 'Medcine trader deleted successfully.');
            } else {
                return back()->with('error', 'An error occured while deleting medicine trader.');
            }
        }
    }

    public function searchMedicineTraders(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->get('name');
            $traders = ""; $output = ""; $flag = 0;
            if ($name != "") {
                $flag = 1;
                $traders = Auth::user()->manyMedicineTraders()->where('name', 'like', '%' . $name . '%')->orderBy('medicine_trader_user.created_at', 'DESC')->get();
            } else {
                $traders = Auth::user()->manyMedicineTraders()->orderBy('medicine_trader_user.created_at', 'DESC')->paginate(10);
            }
            if ($traders->count() > 0) {
                foreach ($traders as $trader) {
                    $output .= '<tr>
                        <td class="align-middle"><img src="' . asset('images/logos/' . $trader->avatar) . '" width="45px" alt="Image not found"></td>
                        <td class="align-middle">' . $trader->name . '</td>
                        <td class="align-middle">' . $trader->phone_number . '</td>
                        <td class="align-middle">' . $trader->address . '</td>
                        <td class="align-middle">
                            <a href="' . route('medicineTraders.show', base64_encode(($trader->id * 123456789) / 12098)) . '" class="d-inline">View</a>
                            <p class="d-inline mb-0"> | </p>
                            <a href="' . route('medicineTraders.edit', base64_encode(($trader->id * 123456789) / 12098)) . '" class="d-inline">Edit</a>
                            <p class="d-inline mb-0"> | </p>
                            <form action="' . route('medicineTraders.destroy', base64_encode(($trader->id * 123456789) / 12098)) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="m-0 p-0 btn btn-link delete-trader d-inline">Delete</button>
                            </form>
                        </td>
                    </tr>';
                }
            } else {
                $output .= '<tr>
                    <td colspan="5" class="text-center font-italic">No record to show.</td>
                </tr>';
            }
            $data = [
                'data_output'            =>      $output,
                'flag'                   =>      $flag
            ];
            return json_encode($data);
        }
    }
}
