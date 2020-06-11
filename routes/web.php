<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth Routes
Route::get('login', 'LoginController@index')->name('login.index');
Route::post('login', 'LoginController@loginAttempt')->name('login.loginAttempt');
Route::get('logout', 'LoginController@logout')->name('login.logout');

// Registration Routes
Route::get('register/profile', 'RegisterController@addProfile')->name('register.addProfile');
Route::get('register/user', 'RegisterController@addUser')->name('register.addUser');

// Dashboard Routes
Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
Route::get('dashboard/roznamcha', 'DashboardController@roznamcha')->name('dashboard.roznamcha');
Route::get('dashboard/stock', 'DashboardController@stock')->name('dashboard.stock');

// Customers Routes
Route::get('dashboard/customers', 'ProfileController@index')->name('profile.index');
Route::get('dashboard/customer/create', 'ProfileController@create')->name('profile.create');
Route::post('dashboard/customer/create', 'ProfileController@store')->name('profile.store');
Route::get('dashboard/customer/{id}', 'ProfileController@show')->name('profile.show');
Route::get('dashboard/customer/{id}/edit', 'ProfileController@edit')->name('profile.edit');
Route::put('dashboard/customer/{id}/edit', 'ProfileController@update')->name('profile.update');
Route::delete('dashboard/customer/{id}', 'ProfileController@destroy')->name('profile.destroy');
Route::get('dashboard/customers/search', 'ProfileController@searchCustomers')->name('profile.searchCustomers');

// Customer Search Routes
Route::get('search/customer', 'CustomerSearchController@searchCustomer')->name('customerSearch.searchCustomer');
Route::post('search/customer', 'CustomerSearchController@customer')->name('customerSearch.customer');
Route::get('customers/names', 'CustomerSearchController@namesList')->name('customerSearch.namesList');

// Filling Stations Routes
Route::get('dashboard/filling-stations', 'FillingStationController@index')->name('fillingStation.index');
Route::get('dashboard/filling-station/create', 'FillingStationController@create')->name('fillingStation.create');
Route::post('dashboard/filling-station/create', 'FillingStationController@store')->name('fillingStation.store');
Route::get('dashboard/filling-station/{id}', 'FillingStationController@show')->name('fillingStation.show');
Route::get('dashboard/filling-station/{id}/edit', 'FillingStationController@edit')->name('fillingStation.edit');
Route::put('dashboard/filling-station/{id}/edit', 'FillingStationController@update')->name('fillingStation.update');
Route::delete('dashboard/filling-station/{id}', 'FillingStationController@destroy')->name('fillingStation.destroy');

Route::get('dashboard/filling-stations/search', 'FillingStationController@filterFillingStation')->name('fillingStation.filterFillingStation');
Route::get('search/filling-station', 'FillingStationController@searchFillingStation')->name('fillingStation.searchFillingStation');

// Oil Record Routes
Route::get('dashboard/roznamcha/oil', 'OilRecordController@index')->name('oilRecord.index');
Route::get('dashboard/roznamcha/oil/{id}/filling-stations', 'OilRecordController@fillingStations')->name('oilRecord.fillingStations');
Route::get('dashboard/roznamcha/oil/{id}/filling-station/{station}/create', 'OilRecordController@create')->name('oilRecord.create');
Route::post('dashboard/roznamcha/oil/{id}/filling-station/{station}/create', 'OilRecordController@store')->name('oilRecord.store');
Route::get('dashboard/roznamcha/oil/{id}', 'OilRecordController@show')->name('oilRecord.show');
Route::get('dashboard/roznamcha/oil/{id}/edit', 'OilRecordController@edit')->name('oilRecord.edit');
Route::put('dashboard/roznamcha/oil/{id}/edit', 'OilRecordController@update')->name('oilRecord.update');
Route::delete('dashboard/roznamcha/{id}', 'OilRecordController@destroy')->name('oilRecord.destroy');

Route::get('search/oil-record', 'OilRecordController@searchOilRecord')->name('oilRecord.searchOilRecord');

// Wheat Stock Routes
Route::get('dashboard/stock/wheat', 'WheatStockController@index')->name('wheatStock.index');
Route::get('dashboard/{id}/stock/wheat/create', 'WheatStockController@create')->name('wheatStock.create');
Route::post('dashboard/{id}/stock/wheat/create', 'WheatStockController@store')->name('wheatStock.store');
Route::get('dashboard/stock/wheat/{id}', 'WheatStockController@show')->name('wheatStock.show');
Route::get('dashboard/stock/wheat/{id}/edit', 'WheatStockController@edit')->name('wheatStock.edit');
Route::put('dashboard/stock/wheat/{id}/edit', 'WheatStockController@update')->name('wheatStock.update');
Route::delete('dashboard/stock/wheat/{id}', 'WheatStockController@destroy')->name('wheatStock.destroy');

// Wheat Record Routes
Route::get('dashboard/roznamcha/wheat', 'WheatRecordController@index')->name('wheatRecord.index');
Route::get('dashboard/{id}/roznamcha/wheat/create', 'WheatRecordController@create')->name('wheatRecord.create');
Route::post('dashboard/{id}/roznamcha/wheat/create', 'WheatRecordController@store')->name('wheatRecord.store');
Route::get('dashboard/roznamcha/wheat/{id}', 'WheatRecordController@show')->name('wheatRecord.show');
Route::get('dashboard/roznamcha/wheat/{id}/edit', 'WheatRecordController@edit')->name('wheatRecord.edit');
Route::put('dashboard/roznamcha/wheat/{id}/edit', 'WheatRecordController@update')->name('wheatRecord.update');
Route::delete('dashboard/roznamcha/wheat/{id}/edit', 'WheatRecordController@destroy')->name('wheatRecord.destroy');

// Rice Stock Routes
Route::get('dashboard/stock/rice', 'RiceStockController@index')->name('riceStock.index');
Route::get('dashboard/{id}/stock/rice/create', 'RiceStockController@create')->name('riceStock.create');
Route::post('dashboard/{id}/stock/rice/create', 'RiceStockController@store')->name('riceStock.store');
Route::get('dashboard/stock/rice/{id}', 'RiceStockController@show')->name('riceStock.show');
Route::get('dashboard/stock/rice/{id}/edit', 'RiceStockController@edit')->name('riceStock.edit');
Route::put('dashboard/stock/rice/{id}/edit', 'RiceStockController@update')->name('riceStock.update');
Route::delete('dashboard/rice/wheat/{id}', 'RiceStockController@destroy')->name('riceStock.destroy');

// Rice Record Routes
Route::get('dashboard/roznamcha/rice', 'RiceRecordController@index')->name('riceRecord.index');
Route::get('dashboard/{id}/roznamcha/rice/create', 'RiceRecordController@create')->name('riceRecord.create');
Route::post('dashboard/{id}/roznamcha/rice/create', 'RiceRecordController@store')->name('riceRecord.store');
Route::get('dashboard/roznamcha/rice/{id}', 'RiceRecordController@show')->name('riceRecord.show');
Route::get('dashboard/roznamcha/rice/{id}/edit', 'RiceRecordController@edit')->name('riceRecord.edit');
Route::put('dashboard/roznamcha/rice/{id}/edit', 'RiceRecordController@update')->name('riceRecord.update');
Route::delete('dashboard/roznamcha/rice/{id}/edit', 'RiceRecordController@destroy')->name('riceRecord.destroy');
