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

// Fertilizer Traders Routes
Route::get('dashboard/fertilizer-traders', 'FertilizerTraderController@index')->name('fertilizerTraders.index');
Route::get('dashboard/fertilizer-trader/create', 'FertilizerTraderController@create')->name('fertilizerTraders.create');
Route::post('dashboard/fertilizer-trader/create', 'FertilizerTraderController@store')->name('fertilizerTraders.store');
Route::get('dashboard/fertilizer-trader/{id}', 'FertilizerTraderController@show')->name('fertilizerTraders.show');
Route::get('dashboard/fertilizer-trader/{id}/edit', 'FertilizerTraderController@edit')->name('fertilizerTraders.edit');
Route::put('dashboard/fertilizer-trader/{id}/edit', 'FertilizerTraderController@update')->name('fertilizerTraders.update');
Route::delete('dashboard/fertilizer-trader/{id}', 'FertilizerTraderController@destroy')->name('fertilizerTraders.destroy');

Route::get('dashboard/fertilizer-traders/search', 'FertilizerTraderController@searchFertilizerTraders')->name('fertilizerTraders.searchFertilizerTrader');

// Medicine Traders Routes
Route::get('dashboard/medicine-traders', 'MedicineTraderController@index')->name('medicineTraders.index');
Route::get('dashboard/medicine-trader/create', 'MedicineTraderController@create')->name('medicineTraders.create');
Route::post('dashboard/medicine-trader/create', 'MedicineTraderController@store')->name('medicineTraders.store');
Route::get('dashboard/medicine-trader/{id}', 'MedicineTraderController@show')->name('medicineTraders.show');
Route::get('dashboard/medicine-trader/{id}/edit', 'MedicineTraderController@edit')->name('medicineTraders.edit');
Route::put('dashboard/medicine-trader/{id}/edit', 'MedicineTraderController@update')->name('medicineTraders.update');
Route::delete('dashboard/medicine-trader/{id}', 'MedicineTraderController@destroy')->name('medicineTraders.destroy');

Route::get('dashboard/medicine-traders/search', 'MedicineTraderController@searchMedicineTraders')->name('medicineTraders.searchMedicineTrader');

// Account Book Routes
Route::get('dashboard/roznamcha/account-book', 'AccountBookController@index')->name('accountBook.index');
Route::get('dashboard/customer/{id}/roznamcha/account-book/create', 'AccountBookController@create')->name('accountBook.create');
Route::post('dashboard/customer/{id}/roznamcha/account-book/create', 'AccountBookController@store')->name('accountBook.store');
Route::get('dashboard/roznamcha/account-book/{id}', 'AccountBookController@show')->name('accountBook.show');
Route::get('dashboard/roznamcha/account-book/{id}/edit', 'AccountBookController@edit')->name('accountBook.edit');
Route::put('dashboard/roznamcha/account-book/{id}/edit', 'AccountBookController@update')->name('accountBook.update');
Route::delete('dashboard/roznamcha/account-book/{id}', 'AccountBookController@destroy')->name('accountBook.destroy');

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

// Fertilizer Stock Routes
Route::get('dashboard/stock/fertilizer', 'FertilizerStockController@index')->name('fertilizerStock.index');
Route::get('dashboard/fertilizer-trader/{id}/create', 'FertilizerStockController@create')->name('fertilizerStock.create');
Route::post('dashboard/fertilizer-trader/{id}/create', 'FertilizerStockController@store')->name('fertilizerStock.store');
Route::get('dashboard/stock/fertilizer/{id}', 'FertilizerStockController@show')->name('fertilizerStock.show');
Route::get('dashboard/stock/fertilizer/{id}/edit', 'FertilizerStockController@edit')->name('fertilizerStock.edit');
Route::put('dashboard/stock/fertilizer/{id}/edit', 'FertilizerStockController@update')->name('fertilizerStock.update');
Route::delete('dashboard/stock/fertilizer/{id}', 'FertilizerStockController@destroy')->name('fertilizerStock.destroy');

Route::post('dashboard/stock/fertilizer/search-trader', 'FertilizerStockSearchController@searchFertilizerTrader')->name('fertilizerStockSearch.searchFertilizerTrader');
Route::get('dashboard/traders/list', 'FertilizerStockSearchController@tradersList')->name('fertilizerStockSearch.tradersList');

// Fertilizer Record Routes
Route::get('dashboard/roznamcha/fertilizer', 'FertilizerRecordController@index')->name('fertilizerRecord.index');
Route::get('dashboard/customer/{id}/roznamcha/fertilizer/create', 'FertilizerRecordController@create')->name('fertilizerRecord.create');
Route::post('dashboard/customer/{id}/roznamcha/fertilizer/create', 'FertilizerRecordController@store')->name('fertilizerRecord.store');
Route::get('dashboard/roznamcha/fertilizer/{id}', 'FertilizerRecordController@show')->name('fertilizerRecord.show');
Route::get('dashboard/roznamcha/fertilizer/{id}/edit', 'FertilizerRecordController@edit')->name('fertilizerRecord.edit');
Route::put('dashboard/roznamcha/fertilizer/{id}/edit', 'FertilizerRecordController@update')->name('fertilizerRecord.update');
Route::delete('dashboard/roznamcha/fertilizer/{id}', 'FertilizerRecordController@destroy')->name('fertilizerRecord.destroy');

// Medicine Stock Routes
Route::get('dashboard/stock/medicine', 'MedicineStockController@index')->name('medicineStock.index');
Route::get('dashboard/medicine-trader/{id}/create', 'MedicineStockController@create')->name('medicineStock.create');
Route::post('dashboard/medicine-trader/{id}/create', 'MedicineStockController@store')->name('medicineStock.store');
Route::get('dashboard/stock/medicine/{id}', 'MedicineStockController@show')->name('medicineStock.show');
Route::get('dashboard/stock/medicine/{id}/edit', 'MedicineStockController@edit')->name('medicineStock.edit');
Route::put('dashboard/stock/medicine/{id}/edit', 'MedicineStockController@update')->name('medicineStock.update');
Route::delete('dashboard/stock/medicine/{id}', 'MedicineStockController@destroy')->name('medicineStock.destroy');

Route::post('dashboard/stock/medicine/search-trader', 'MedicineStockSearchController@searchMedicineTrader')->name('medicineStockSearch.searchMedicineTrader');
Route::get('dashboard/medicine-traders/list', 'MedicineStockSearchController@tradersList')->name('medicineStockSearch.tradersList');

// Fertilizer Record Routes
Route::get('dashboard/roznamcha/medicine', 'MedicineRecordController@index')->name('medicineRecord.index');
Route::get('dashboard/customer/{id}/roznamcha/medicine/create', 'MedicineRecordController@create')->name('medicineRecord.create');
Route::post('dashboard/customer/{id}/roznamcha/medicine/create', 'MedicineRecordController@store')->name('medicineRecord.store');
Route::get('dashboard/roznamcha/medicine/{id}', 'MedicineRecordController@show')->name('medicineRecord.show');
Route::get('dashboard/roznamcha/medicine/{id}/edit', 'MedicineRecordController@edit')->name('medicineRecord.edit');
Route::put('dashboard/roznamcha/medicine/{id}/edit', 'MedicineRecordController@update')->name('medicineRecord.update');
Route::delete('dashboard/roznamcha/medicine/{id}', 'MedicineRecordController@destroy')->name('medicineRecord.destroy');

// Wheat Stock Routes
Route::get('dashboard/stock/wheat', 'WheatStockController@index')->name('wheatStock.index');
Route::get('dashboard/customer/{id}/stock/wheat/create', 'WheatStockController@create')->name('wheatStock.create');
Route::post('dashboard/customer/{id}/stock/wheat/create', 'WheatStockController@store')->name('wheatStock.store');
Route::get('dashboard/stock/wheat/{id}', 'WheatStockController@show')->name('wheatStock.show');
Route::get('dashboard/stock/wheat/{id}/edit', 'WheatStockController@edit')->name('wheatStock.edit');
Route::put('dashboard/stock/wheat/{id}/edit', 'WheatStockController@update')->name('wheatStock.update');
Route::delete('dashboard/stock/wheat/{id}', 'WheatStockController@destroy')->name('wheatStock.destroy');

// Wheat Record Routes
Route::get('dashboard/roznamcha/wheat', 'WheatRecordController@index')->name('wheatRecord.index');
Route::get('dashboard/customer/{id}/roznamcha/wheat/create', 'WheatRecordController@create')->name('wheatRecord.create');
Route::post('dashboard/customer/{id}/roznamcha/wheat/create', 'WheatRecordController@store')->name('wheatRecord.store');
Route::get('dashboard/roznamcha/wheat/{id}', 'WheatRecordController@show')->name('wheatRecord.show');
Route::get('dashboard/roznamcha/wheat/{id}/edit', 'WheatRecordController@edit')->name('wheatRecord.edit');
Route::put('dashboard/roznamcha/wheat/{id}/edit', 'WheatRecordController@update')->name('wheatRecord.update');
Route::delete('dashboard/roznamcha/wheat/{id}', 'WheatRecordController@destroy')->name('wheatRecord.destroy');

// Rice Stock Routes
Route::get('dashboard/stock/rice', 'RiceStockController@index')->name('riceStock.index');
Route::get('dashboard/customer/{id}/stock/rice/create', 'RiceStockController@create')->name('riceStock.create');
Route::post('dashboard/customer/{id}/stock/rice/create', 'RiceStockController@store')->name('riceStock.store');
Route::get('dashboard/stock/rice/{id}', 'RiceStockController@show')->name('riceStock.show');
Route::get('dashboard/stock/rice/{id}/edit', 'RiceStockController@edit')->name('riceStock.edit');
Route::put('dashboard/stock/rice/{id}/edit', 'RiceStockController@update')->name('riceStock.update');
Route::delete('dashboard/rice/wheat/{id}', 'RiceStockController@destroy')->name('riceStock.destroy');

// Rice Record Routes
Route::get('dashboard/roznamcha/rice', 'RiceRecordController@index')->name('riceRecord.index');
Route::get('dashboard/customer/{id}/roznamcha/rice/create', 'RiceRecordController@create')->name('riceRecord.create');
Route::post('dashboard/customer/{id}/roznamcha/rice/create', 'RiceRecordController@store')->name('riceRecord.store');
Route::get('dashboard/roznamcha/rice/{id}', 'RiceRecordController@show')->name('riceRecord.show');
Route::get('dashboard/roznamcha/rice/{id}/edit', 'RiceRecordController@edit')->name('riceRecord.edit');
Route::put('dashboard/roznamcha/rice/{id}/edit', 'RiceRecordController@update')->name('riceRecord.update');
Route::delete('dashboard/roznamcha/rice/{id}', 'RiceRecordController@destroy')->name('riceRecord.destroy');

// Others Routes
Route::get('dashboard/roznamcha/other', 'OtherController@index')->name('other.index');
Route::get('dashboard/customer/{id}/roznamcha/other/create', 'OtherController@create')->name('other.create');
Route::post('dashboard/customer/{id}/roznamcha/other/create', 'OtherController@store')->name('other.store');
Route::get('dashboard/roznamcha/other/{id}', 'OtherController@show')->name('other.show');
Route::get('dashboard/roznamcha/other/{id}/edit', 'OtherController@edit')->name('other.edit');
Route::put('dashboard/roznamcha/other/{id}/edit', 'OtherController@update')->name('other.update');
Route::delete('dashboard/roznamcha/other/{id}', 'OtherController@destroy')->name('other.destroy');
