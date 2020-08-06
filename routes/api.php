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

/*-- Routes for Auth --*/
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

/**
 * Create Service Routes
 */

//  Create customer routes
Route::post('customer/create', 'CreateServiceController@customer');
Route::post('account-book/create', 'CreateServiceController@accountBook');
Route::post('fertilizer-stock/create', 'CreateServiceController@fertilizerStock');

/**
 * Read Service Routes
 */

// Customers API Routes
Route::post('customers', 'ReadServiceController@getCustomers');
// Oil Companies API Routes
Route::post('oil-companies', 'ReadServiceController@getOilCompanies');
// Filling Stations API Routes
Route::post('filling-stations', 'ReadServiceController@getFillingStations');
// Oil Records API Routes
Route::post('oil-records', 'ReadServiceController@getOilRecords');
// Account Book API Routes
Route::post('account-books', 'ReadServiceController@getAccountBook');
// Fertilizer Record API Routes
Route::post('fertilizer-records', 'ReadServiceController@getFertilizerRecord');
// Medicine Record API Routes
Route::post('medicine-records', 'ReadServiceController@getMedicineRecord');
// Wheat Record API Routes
Route::post('wheat-records', 'ReadServiceController@getWheatRecord');
// Rice Record API Routes
Route::post('rice-records', 'ReadServiceController@getRiceRecord');
// Other Records API Routes
Route::post('other-records', 'ReadServiceController@getOtherRecord');

// Fertilizer Stock API Route
Route::post('fertilizer-stocks', 'ReadServiceController@getFertilizerStock');
// Medicine Stock API Route
Route::post('medicine-stocks', 'ReadServiceController@getMedicineStock');
// Wheat Stock API Route
Route::post('wheat-stocks', 'ReadServiceController@getWheatStock');
// Rice Stock API Route
Route::post('rice-stocks', 'ReadServiceController@getRiceStock');

// Fertilizer Traders API Route
Route::post('fertilizer-traders', 'ReadServiceController@getFertilizerTraders');
// Medicine Traders API Route
Route::post('medicine-traders', 'ReadServiceController@getMedicineTraders');


/**
 * Update Service Routes
 */

//  update customer routes
Route::post('customer/{id}/update', 'UpdateServiceController@customer');

/**
 * Delete Service Routes
 */

 Route::post('customer/{id}/delete', 'DeleteServiceController@customer');
