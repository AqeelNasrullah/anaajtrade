<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UpdateServiceController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    // Update Customer
    public function customer(Request $request, $id)
    {
        $rules = [];
        if ($request->has('name')) {
            $rules['name'] = 'min:3';
        }
        if ($request->has('father_name')) {
            $rules['father_name'] = 'min:3';
        }
        if ($request->has('phone_number')) {
            $rules['phone_number'] = 'min:12|max:12';
        }
        if ($request->has('cnic')) {
            $rules['cnic'] = 'min:15|max:15';
        }
        if ($request->has('property')) {
            $rules['property'] = 'numeric';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $profile = Profile::find($id)->update([
                'name'          =>              trim(htmlentities(addslashes($request->get('name')))),
                'father_name'   =>              trim(htmlentities(addslashes($request->get('father_name')))),
                'phone_number'  =>              '+92 ' . substr(trim(htmlentities(addslashes($request->get('phone_number')))), 1),
                'cnic'          =>              trim(htmlentities(addslashes($request->get('cnic')))),
                'address'       =>              trim(htmlentities(addslashes($request->get('address')))),
                'property'      =>              trim(htmlentities(addslashes($request->get('property')))),
                'role'          =>              trim(htmlentities(addslashes($request->get('role'))))
            ]);
            if ($profile) {
                return response(['success' => 'Customer updated successfully'], Response::HTTP_ACCEPTED);
            } else {
                return response(['error' => 'An error occured while updating customer'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

        }

    }
}
