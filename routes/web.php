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
});

// Auth Routes
Route::get('login', 'LoginController@index')->name('login.index');
Route::post('login', 'LoginController@loginAttempt')->name('login.loginAttempt');
Route::get('logout', 'LoginController@logout')->name('login.logout');

// Registration Routes
Route::get('register/profile', 'RegisterController@addProfile')->name('register.addProfile');
Route::get('register/user', 'RegisterController@addUser')->name('register.addUser');

// Dashboard Routes
Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

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

?>
