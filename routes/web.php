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

?>
