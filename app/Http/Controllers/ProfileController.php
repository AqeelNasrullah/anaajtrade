<?php

namespace App\Http\Controllers;

use App\Profile;
use App\ProfileUser;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
        $customers = Auth::User()->manyProfiles()->latest()->paginate(10);
        return view('dashboard.customers.index', ['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.customers.create');
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
            'image'                 =>      'required|mimes:png,jpg,jpeg,gif|max:2048',
            'name'                  =>      'required|min:3',
            'phone_number'          =>      'required|min:12',
            'cnic'                  =>      'required|min:15',
            'address'               =>      'required'
        ];
        if($request->get('father_name') !== null) {
            $rules['father_name'] = 'min:3';
        }
        if($request->get('property') !== null) {
            $rules['property'] = 'numeric';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $phone_number = '+92 ' . substr(addslashes(htmlentities(trim($request->get('phone_number')))), 1);
            $profile = Profile::where('phone_number', $phone_number)->first();
            if($profile) {
                $attached = Auth::user()->manyProfiles()->where('profile_id', $profile->id)->first();
                if ($attached) {
                    return redirect()->route('profile.index')->with('success', 'Customer already exists.')->withInput();
                } else {
                    Auth::User()->manyProfiles()->attach($profile);
                    return redirect()->route('profile.index')->with('success', 'Customer created successfully.');
                }
            } else {
                if($request->hasFile('image')) {
                    $avatar = $request->file('image');
                    $filename = time() . '.' . $avatar->getClientOriginalExtension();
                    $file = $avatar->move(public_path('/images/dps/'), $filename);
                    if($file) {
                        $create = Profile::create([
                            'avatar'                    =>      $filename,
                            'name'                      =>      addslashes(htmlentities(trim($request->get('name')))),
                            'father_name'               =>      addslashes(htmlentities(trim($request->get('father_name')))),
                            'phone_number'              =>      '+92 ' . substr(addslashes(htmlentities(trim($request->get('phone_number')))), 1),
                            'cnic'                      =>      addslashes(htmlentities(trim($request->get('cnic')))),
                            'property'                  =>      $request->get('property'),
                            'address'                   =>      addslashes(htmlentities(trim($request->get('address'))))
                        ]);
                        if($create) {
                            Auth::User()->manyProfiles()->attach($create);
                            return redirect()->route('profile.index')->with('success', 'Customer created successfully.');
                        } else {
                            return redirect()->route('profile.create')->with('error', 'An error occured while creating customer.');
                        }
                    } else {
                        return redirect()->route('profile.create')->with('error', 'An error occured while uploading image.');
                    }
                } else {
                    return redirect()->route('profile.create')->with('error', 'The image field is required.');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id) {
            $d_id = (base64_decode($id) * 12098) / 123456789;
            $profile = Profile::find($d_id);
            $wheat_stocks = Auth::user()->wheatStocks()->where('profile_id', $d_id)->latest()->get();
            $rice_stocks = Auth::user()->riceStocks()->where('profile_id', $d_id)->latest()->get();
            $wheat_records = Auth::user()->wheatRecords()->where('profile_id', $d_id)->latest()->get();
            $rice_records = Auth::user()->riceRecords()->where('profile_id', $d_id)->latest()->get();
            $oil_records = Auth::user()->oilRecords()->where('profile_id', $d_id)->latest()->get();
            $account_books = Auth::user()->accountBooks()->where('profile_id', $d_id)->latest()->get();
            $others = Auth::user()->others()->where('profile_id', $d_id)->latest()->get();
            if ($profile) {
                return view('dashboard.customers.show', [
                    'profile' => $profile, 'oil_records' => $oil_records, 'wheat_stocks' => $wheat_stocks,
                    'wheat_records' => $wheat_records, 'rice_stocks' => $rice_stocks, 'rice_records' => $rice_records,
                    'account_books' => $account_books, 'others' => $others
                    ]);
            } else {
                return redirect()->route('profile.index');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id) {
            $d_id = (base64_decode($id) * 12098) / 123456789;
            $profile = Profile::where('id', $d_id)->first();
            $roles = Role::all();
            return view('dashboard.customers.edit', ['profile'=>$profile, 'roles'=>$roles]);
        } else {
            return redirect()->route('profile.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'                  =>      'required|min:3',
            'phone_number'          =>      'required|min:12',
            'cnic'                  =>      'required|min:15',
            'address'               =>      'required',
            'role'                  =>      'required|numeric'
        ];
        if($request->hasFile('image')) {
            $rules['image'] = 'mimes:jpg,png,gif,jpeg|max:2048';
        }
        if($request->get('father_name') !== null) {
            $rules['father_name'] = 'min:3';
        }
        if($request->get('property') !== null) {
            $rules['property'] = 'numeric';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $d_id = (base64_decode($id) * 12098) / 123456789;
            $profile = Profile::find($d_id);
            $filename = $profile->avatar;
            if ($request->hasFile('image')) {
                $avatar = $request->file('image');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path('/images/dps/'), $filename);
            }
            $updateCustomer = $profile->update([
                'avatar'                =>      $filename,
                'name'                  =>      addslashes(htmlentities(trim($request->get('name')))),
                'father_name'           =>      addslashes(htmlentities(trim($request->get('father_name')))),
                'phone_number'          =>      '+92 ' . substr(addslashes(htmlentities(trim($request->get('phone_number')))), 1),
                'cnic'                  =>      addslashes(htmlentities(trim($request->get('cnic')))),
                'property'              =>      $request->get('property'),
                'address'               =>      addslashes(htmlentities(trim($request->get('address')))),
                'role_id'               =>      $request->get('role')
            ]);
            if ($updateCustomer) {
                return redirect()->route('profile.index')->with('success', 'Customer updated successfully.');
            } else {
                return back()->with('error', 'An error occured while updating customer.')->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id) {
            $d_id = (base64_decode($id) * 12098) / 123456789;
            $removeCustomer = Auth::User()->manyProfiles()->detach($d_id);
            if ($removeCustomer) {
                return redirect()->route('profile.index')->with('success', 'Customer removed successfully.');
            } else {
                return redirect()->route('profile.index')->with('error', 'An error occured while removing customer.');
            }
        }
    }

    public function searchCustomers(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->get('name');
            $output = '';
            $profiles='';

            if ($name !== "") {
                $profiles = Auth::User()->manyProfiles()->where(function($query) use ($name) {
                    $query->where('name', 'like', '%'.$name.'%')->orWhere('phone_number', 'like', '%'.$name.'%')->orWhere('cnic', 'like', '%'.$name.'%');
                })->latest()->get();
            } else {
                $profiles = Auth::User()->manyProfiles()->latest()->get();
            }
            $total_profiles = $profiles->count();
            if($total_profiles > 0) {
                foreach ($profiles as $profile) {
                    $output .= '<tr>
                        <td class="align-middle"><img src="'.asset('images/dps/'.$profile->avatar).'" width="40px" alt="Image not found"></td>
                        <td class="align-middle">'.$profile->name.'</td>
                        <td class="align-middle">'.$profile->phone_number.'</td>
                        <td class="align-middle">'.$profile->cnic.'</td>
                        <td class="align-middle">'.$profile->address.'</td>
                        <td class="align-middle">'.$profile->role->name.'</td>
                        <td class="align-middle">
                            <a class="d-inline view-customer" data-id="'. base64_encode(($profile->id * 123456789) / 12098) .'" href="">View</a>
                            <p class="mb-0 d-inline">|</p>
                            <a class="d-inline" href="'. route('profile.edit', base64_encode(($profile->id * 123456789) / 12098)) .'">Edit</a>
                            <p class="mb-0 d-inline">|</p>
                            <form class="d-inline" action="'. route('profile.destroy', base64_encode(($profile->id * 123456789) / 12098)) .'" method="post">
                                '. csrf_field() .'
                                '. method_field('DELETE') .'
                                <button type="submit" class="btn btn-link delete-customer" style="margin: 0px !important;padding: 0px !important;">Delete</button>
                            </form>
                        </td>
                    </tr>';
                }
            } else {
                $output .= '<tr>
                    <td colspan="7" class="text-center font-italic">No customer found.</td>
                </tr>';
            }

            $data = [
                'data_output'           =>  $output
            ];
            return json_encode($data);
        }
    }
}
