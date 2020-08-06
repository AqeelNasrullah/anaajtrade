<?php

namespace App\Http\Controllers;

use App\Profile;
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
            'phone_number'      =>      'required|min:15|max:15',
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
            $phone_number = htmlentities(trim($request->get('phone_number')));
            $profile = Profile::where('phone_number', $phone_number)->first();
            if($profile) {
                $attached = auth()->guard('api')->user()->manyProfiles()->where('profile_id', $profile->id)->first();
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
                    'phone_number'              =>      addslashes(htmlentities(trim($request->get('phone_number')))),
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

    public function accountBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_id'            =>      'required|min:1|numeric',
            'amount'                =>      'required|min:0|numeric',
            'type'                  =>      'required'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $created = auth()->guard('api')->user()->accountBooks()->create([
                'profile_id'        =>      $request->get('profile_id'),
                'amount'            =>      $request->get('amount'),
                'type'              =>      $request->get('type')
            ]);
            if ($created) {
                return response(['success' => 'Account book added successfully.'], Response::HTTP_CREATED);
            } else {
                return response(['error' => 'An error occured while adding account book.'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

    }

    public function fertilizerStock(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity'                  =>      'required|min:0|numeric',
            'price'                     =>      'required|min:0|numeric',
            'type'                      =>      'required',
            'weight'                    =>      'required|min:0|numeric',
            'fertilizer_trader_id'      =>      'required|min:1|numeric'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $created = auth()->guard('api')->user()->fertilizerStocks()->create([
                'quantity'                      =>      $request->get('quantity'),
                'price'                         =>      $request->get('price'),
                'type'                          =>      $request->get('type'),
                'weight'                        =>      $request->get('weight'),
                'fertilizer_trader_id'          =>      $request->get('fertilizer_trader_id')
            ]);
            if ($created) {
                return response(['success' => 'Fertilizer stock added successfully.'], Response::HTTP_CREATED);
            } else {
                return response(['error' => 'An error occured while adding fertilizer stock.'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
    }
}
