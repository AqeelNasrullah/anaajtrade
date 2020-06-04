<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Customers API Routes
Route::get('customers', 'ReadServiceController@getCustomers');
Route::get('customer/{id}', 'ReadServiceController@customer');
// Oil Companies API Routes
Route::get('oil-companies', 'ReadServiceController@getOilCompanies');
Route::get('oil-company/{id}', 'ReadServiceController@oilCompany');
// Filling Stations API Routes
Route::get('filling-stations', 'ReadServiceController@getFillingStations');
Route::get('filling-station/{id}', 'ReadServiceController@fillingStation');
// Oil Records API Routes
Route::get('oil-records', 'ReadServiceController@getOilRecords');
Route::get('oil-record/{id}', 'ReadServiceController@oilRecord');
