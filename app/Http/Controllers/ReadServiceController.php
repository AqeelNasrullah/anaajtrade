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
use Illuminate\Http\Request;

class ReadServiceController extends Controller
{
    // Customer Read Services
    public function getCustomers()
    {
        return ProfileResource::collection(Profile::all());
    }

    public function customer($id)
    {
        return new ProfileResource(Profile::find($id));
    }

    // Oil Companies Read Services
    public function getOilCompanies()
    {
        return OilCompanyResource::collection(OilCompany::all());
    }

    public function oilCompany($id)
    {
        return new OilCompanyResource(OilCompany::find($id));
    }

    // Filling Station Read Services
    public function getFillingStations()
    {
        return FillingStationResource::collection(FillingStation::all());
    }

    public function fillingStation($id)
    {
        return new FillingStationResource(FillingStation::find($id));
    }

    // Oil Records Read Services
    public function getOilRecords()
    {
        return OilRecordResource::collection(OilRecord::all());
    }

    public function oilRecord($id)
    {
        return new OilRecordResource(OilRecord::find($id));
    }
}
