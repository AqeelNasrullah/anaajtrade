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

/**
 * Update Service Routes
 */

//  update customer routes
Route::post('customer/{id}/update', 'UpdateServiceController@customer');

/**
 * Delete Service Routes
 */

 Route::post('customer/{id}/delete', 'DeleteServiceController@customer');
