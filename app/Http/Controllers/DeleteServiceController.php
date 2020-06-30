<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteServiceController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    // Delete customer
    public function customer($id)
    {
        $removeCustomer = auth()->guard('api')->user()->manyProfiles()->detach($id);
        if ($removeCustomer) {
            return response(['success' => 'Customer deleted successfully.'], Response::HTTP_OK);
        } else {
            return response(['error' => 'An error occured while deleting customer.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }
}
