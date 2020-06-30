<?php

namespace App\Http\Controllers;

use App\Profile;
use App\ProfileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CreateServiceController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    // Create New Customer
    public function customer(Request $request)
    {
        $rules = [
            'name'              =>      'required|min:3',
            'phone_number'      =>      'required|min:12|max:12',
            'cnic'              =>      'required|min:15|max:15',
            'address'           =>      'required'
        ];
        if ($request->has('father_name')) {
            $rules['father_name'] = 'min:3';
        }
        if ($request->has('property')) {
            $rules['property'] = 'numeric';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $phone_number = '+92 ' . substr(addslashes(htmlentities(trim($request->get('phone_number')))), 1);
            $profile = Profile::where('phone_number', $phone_number)->first();
            if($profile) {
                $attached = ProfileUser::where('profile_id', $profile->id)->where('user_id', auth()->guard('api')->user()->id)->first();
                if ($attached) {
                    return response(['error' => 'Customer already exists'], Response::HTTP_UNPROCESSABLE_ENTITY);
                } else {
                    auth()->guard('api')->user()->manyProfiles()->attach($profile);
                    return response(['success' => 'Customer added successfully'], Response::HTTP_CREATED);
                }
            } else {
                $create = Profile::create([
                    'name'                      =>      addslashes(htmlentities(trim($request->get('name')))),
                    'father_name'               =>      addslashes(htmlentities(trim($request->get('father_name')))),
                    'phone_number'              =>      '+92 ' . substr(addslashes(htmlentities(trim($request->get('phone_number')))), 1),
                    'cnic'                      =>      addslashes(htmlentities(trim($request->get('cnic')))),
                    'property'                  =>      $request->get('property'),
                    'address'                   =>      addslashes(htmlentities(trim($request->get('address'))))
                ]);
                if($create) {
                    auth()->guard('api')->user()->manyProfiles()->attach($create);
                    return response(['success' => 'Customer added successfully'], Response::HTTP_CREATED);
                } else {
                    return response(['error' => 'An error occured while adding customer'], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
            }
        }
    }
}
