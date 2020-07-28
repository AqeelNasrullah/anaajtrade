<?php

namespace App\Http\Controllers;

use App\FillingStation;
use App\Http\Resources\FillingStationResource;
use App\Http\Resources\OilCompanyResource;
use App\Http\Resources\OilRecordResource;
use App\Http\Resources\ProfileResource;
use App\OilCompany;
use App\OilRecord;
use App\Profile;
// use Illuminate\Http\Request;

class ReadServiceController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    // Customer Read Services
    public function getCustomers()
    {
        return ProfileResource::collection(auth()->guard('api')->user()->manyProfiles()->latest()->get());
    }

    // Oil Companies Read Services
    public function getOilCompanies()
    {
        return OilCompanyResource::collection(OilCompany::all());
    }

    // Filling Station Read Services
    public function getFillingStations()
    {
        return FillingStationResource::collection(auth()->guard('api')->user()->manyFillingStations()->latest()->get());
    }

    // Oil Records Read Services
    public function getOilRecords()
    {
        return OilRecordResource::collection(auth()->guard('api')->user()->oilRecords()->latest()->get());
    }
}
