<?php

namespace App\Http\Controllers;

use App\FillingStation;
use App\Http\Resources\AccountBookResource;
use App\Http\Resources\FertilizerRecordResource;
use App\Http\Resources\FertilizerStockResource;
use App\Http\Resources\FertilizerTraderResource;
use App\Http\Resources\FillingStationResource;
use App\Http\Resources\MedicineRecordResource;
use App\Http\Resources\MedicineStockResource;
use App\Http\Resources\MedicineTraderResource;
use App\Http\Resources\OilCompanyResource;
use App\Http\Resources\OilRecordResource;
use App\Http\Resources\OtherRecordResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\RiceRecordResource;
use App\Http\Resources\RiceStockResource;
use App\Http\Resources\WheatRecordResource;
use App\Http\Resources\WheatStockResource;
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

    /**
     * Roznamcha Read Services
     */

    // Oil Records Read Services
    public function getOilRecords()
    {
        return OilRecordResource::collection(auth()->guard('api')->user()->oilRecords()->latest()->get());
    }

    // Account Book Read Services
    public function getAccountBook()
    {
        return AccountBookResource::collection(auth()->guard('api')->user()->accountBooks()->latest()->get());
    }

    // Fertilizer Record Read Services
    public function getFertilizerRecord()
    {
        return FertilizerRecordResource::collection(auth()->guard('api')->user()->fertilizerRecords()->latest()->get());
    }

    // Medicine Record Read Services
    public function getMedicineRecord()
    {
        return MedicineRecordResource::collection(auth()->guard('api')->user()->medicineRecords()->latest()->get());
    }

    // Wheat Record Read Service
    public function getWheatRecord()
    {
        return WheatRecordResource::collection(auth()->guard('api')->user()->wheatRecords()->latest()->get());
    }

    // Rice Record Read Service
    public function getRiceRecord()
    {
        return RiceRecordResource::collection(auth()->guard('api')->user()->riceRecords()->latest()->get());
    }

    // Other Records Read Service
    public function getOtherRecord()
    {
        return OtherRecordResource::collection(auth()->guard('api')->user()->others()->latest()->get());
    }

    /**
     * Stocks Read Services
     */

    // Fertilizer Stock Read Service
    public function getFertilizerStock()
    {
        return FertilizerStockResource::collection(auth()->guard('api')->user()->fertilizerStocks()->latest()->get());
    }

    // Medicine Stock Read Service
    public function getMedicineStock()
    {
        return MedicineStockResource::collection(auth()->guard('api')->user()->medicineStocks()->latest()->get());
    }

    // Wheat Stock Read Service
    public function getWheatStock()
    {
        return WheatStockResource::collection(auth()->guard('api')->user()->wheatStocks()->latest()->get());
    }

    // Rice Stock Read Service
    public function getRiceStock()
    {
        return RiceStockResource::collection(auth()->guard('api')->user()->riceStocks()->latest()->get());
    }

    // Fertilizer Traders Read Service
    public function getFertilizerTraders()
    {
        return FertilizerTraderResource::collection(auth()->guard('api')->user()->manyFertilizerTraders()->orderBy('fertilizer_trader_user.created_at', 'DESC')->get());
    }

    // Medicine Traders Read Service
    public function getMedicineTraders()
    {
        return MedicineTraderResource::collection(auth()->guard('api')->user()->manyMedicineTraders()->orderBy('medicine_trader_user.created_at', 'DESC')->get());
    }
}
