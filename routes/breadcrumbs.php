<?php

// Home

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function($trail) {
    $trail->push('Home', route('dashboard.index'));
});

// Home >> Roznamcha
Breadcrumbs::for('roznamcha', function($trail) {
    $trail->parent('home');
    $trail->push('Roznamcha', route('dashboard.roznamcha'));
});

// Home >> Customers
Breadcrumbs::for('customers', function($trail) {
    $trail->parent('home');
    $trail->push('Customers', route('profile.index'));
});

// Home >> Customers >> Add Customer
Breadcrumbs::for('new_customers', function($trail) {
    $trail->parent('customers');
    $trail->push('Add Customer', route('profile.create'));
});

// Home >> Customers >> View Customer
Breadcrumbs::for('view_customers', function($trail, $profile) {
    $trail->parent('customers');
    $trail->push($profile->name, route('profile.show', base64_encode(($profile->id*123456789) / 12098)));
});

// Home >> Customers >> Edit Customer
Breadcrumbs::for('edit_customers', function($trail, $profile) {
    $trail->parent('customers');
    $trail->push($profile->name, route('profile.edit', $profile->id));
});

// Home >> Filling Stations
Breadcrumbs::for('filling_stations', function($trail) {
    $trail->parent('home');
    $trail->push('Filling Stations', route('fillingStation.index'));
});

// Home >> Filling Stations >> Add Filling Station
Breadcrumbs::for('add_filling_stations', function($trail) {
    $trail->parent('filling_stations');
    $trail->push('Add Filling Station', route('fillingStation.create'));
});

// Home >> Filling Stations >> View Filling Station
Breadcrumbs::for('view_filling_stations', function($trail, $station) {
    $trail->parent('filling_stations');
    $trail->push($station->name, route('fillingStation.show', base64_encode(($station->id * 123456789) / 12098)));
});

// Home >> Filling Stations >> Edit Filling Station
Breadcrumbs::for('edit_filling_stations', function($trail, $station) {
    $trail->parent('filling_stations');
    $trail->push('Edit Filling Station', route('fillingStation.edit', base64_encode(($station->id * 123456789) / 12098)));
});

// Home >> Fertilizer Traders
Breadcrumbs::for('fertilizer_traders', function($trail) {
    $trail->parent('home');
    $trail->push('Fertilizer Traders', route('fertilizerTraders.index'));
});

// Home >> Fertilizer Traders >> Create Fertilizer Trader
Breadcrumbs::for('create_fertilizer_traders', function($trail) {
    $trail->parent('fertilizer_traders');
    $trail->push('Create Fertilizer Trader', route('fertilizerTraders.create'));
});

// Home >> Fertilizer Traders >> View Fertilizer Trader
Breadcrumbs::for('view_fertilizer_traders', function($trail, $trader) {
    $trail->parent('fertilizer_traders');
    $trail->push('View Fertilizer Trader', route('fertilizerTraders.show', base64_encode(($trader->id * 123456789) / 12098)));
});

// Home >> Fertilizer Traders >> Edit Fertilizer Trader
Breadcrumbs::for('edit_fertilizer_traders', function($trail, $trader) {
    $trail->parent('fertilizer_traders');
    $trail->push('Edit Fertilizer Trader', route('fertilizerTraders.edit', base64_encode(($trader->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Account Book
Breadcrumbs::for('account_books', function($trail) {
    $trail->parent('roznamcha');
    $trail->push('Account Book', route('accountBook.index'));
});

// Home >> Customer >> { User } >> Create
Breadcrumbs::for('account_books_create', function($trail, $profile) {
    $trail->parent('view_customers', $profile);
    $trail->push('Add Account Book', route('accountBook.create', base64_encode(($profile->id * 123456789) / 12098)));
});

// Home >> Account Book >> View Account Book
Breadcrumbs::for('view_account_books', function($trail, $record) {
    $trail->parent('account_books');
    $trail->push('View Account Book', route('accountBook.show', base64_encode(($record->id * 123456789) / 12098)));
});

// Home >> Account Book >> View Account Book
Breadcrumbs::for('edit_account_books', function($trail, $record) {
    $trail->parent('account_books');
    $trail->push('Edit Account Book', route('accountBook.edit', base64_encode(($record->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Oil
Breadcrumbs::for('oil_records', function($trail) {
    $trail->parent('roznamcha');
    $trail->push('Oil Records', route('oilRecord.index'));
});

// Home >> Customer >> {User} >> Filling Stations
Breadcrumbs::for('filling_stations_oil_records', function($trail, $profile) {
    $trail->parent('view_customers', $profile);
    $trail->push('Filling Stations', route('oilRecord.fillingStations', base64_encode(($profile->id * 123456789) / 12098)));
});

// Home >> Customer >> {User} >> {Filling Station} >> Generate Oil Slip
Breadcrumbs::for('add_oil_records', function($trail, $profile, $station) {
    $trail->parent('filling_stations_oil_records', $profile);
    $trail->push('Generate Slip', route('oilRecord.create', [base64_encode(($profile->id * 123456789) / 12098), base64_encode(($station->id * 123456789) / 12098)]));
});

// Home >> Roznamcha >> Oil Records >> View Bill
Breadcrumbs::for('show_oil_records', function($trail, $oil_record) {
    $trail->parent('oil_records');
    $trail->push('View Oil Bill', route('oilRecord.show', base64_encode(($oil_record->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Oil Records >> Edit Bill
Breadcrumbs::for('edit_oil_records', function($trail, $oil_record) {
    $trail->parent('oil_records');
    $trail->push('Edit Oil Bill', route('profile.edit', base64_encode(($oil_record->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Wheat Records
Breadcrumbs::for('wheat_records', function($trail) {
    $trail->parent('roznamcha');
    $trail->push('Wheat Records', route('wheatRecord.index'));
});

// Home >> Customer >> {User} >> Add Wheat Record
Breadcrumbs::for('add_wheat_records', function($trail, $profile) {
    $trail->parent('view_customers', $profile);
    $trail->push('Add Wheat Record', route('wheatRecord.create', base64_encode(($profile->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Wheat Records >> View Bill
Breadcrumbs::for('view_wheat_records', function($trail, $record) {
    $trail->parent('wheat_records');
    $trail->push('View Bill', route('wheatRecord.show', base64_encode(($record->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Wheat Records >> Edit Bill
Breadcrumbs::for('edit_wheat_records', function($trail, $record) {
    $trail->parent('wheat_records');
    $trail->push('Edit Bill', route('wheatRecord.show', base64_encode(($record->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Rice Records
Breadcrumbs::for('rice_records', function($trail) {
    $trail->parent('roznamcha');
    $trail->push('Rice Records', route('riceRecord.index'));
});

// Home >> Customer >> {User} >> Add Rice Record
Breadcrumbs::for('add_rice_records', function($trail, $profile) {
    $trail->parent('view_customers', $profile);
    $trail->push('Add Rice Record', route('riceRecord.create', base64_encode(($profile->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Rice Records >> View Bill
Breadcrumbs::for('view_rice_records', function($trail, $record) {
    $trail->parent('rice_records');
    $trail->push('View Bill', route('riceRecord.show', base64_encode(($record->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Rice Records >> Edit Bill
Breadcrumbs::for('edit_rice_records', function($trail, $record) {
    $trail->parent('rice_records');
    $trail->push('Edit Bill', route('riceRecord.show', base64_encode(($record->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Others
Breadcrumbs::for('others', function($trail) {
    $trail->parent('roznamcha');
    $trail->push('Other Records', route('other.index'));
});

// Home >> Customer >> {User} >> Add Other
Breadcrumbs::for('add_other', function($trail, $profile) {
    $trail->parent('view_customers', $profile);
    $trail->push('Add Other Record', route('other.create', base64_encode(($profile->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Others >> View Record
Breadcrumbs::for('view_other', function($trail, $other) {
    $trail->parent('others');
    $trail->push('View Record', route('other.show', base64_encode(($other->id * 123456789) / 12098)));
});

// Home >> Roznamcha >> Others >> Edit Record
Breadcrumbs::for('edit_other', function($trail, $other) {
    $trail->parent('others');
    $trail->push('Edit Record', route('other.edit', base64_encode(($other->id * 123456789) / 12098)));
});

// Home >> Stock
Breadcrumbs::for('stock', function($trail) {
    $trail->parent('home');
    $trail->push('Stock', route('dashboard.stock'));
});

// Home >> Stock >> Wheat Stock
Breadcrumbs::for('wheat_stock', function($trail) {
    $trail->parent('stock');
    $trail->push('Wheat Stock', route('wheatStock.index'));
});

// Home >> Customer >> {User} >> Add Wheat Stock
Breadcrumbs::for('add_wheat_stock', function($trail, $profile) {
    $trail->parent('view_customers', $profile);
    $trail->push('Add Wheat Stock', route('wheatStock.create', base64_encode(($profile->id * 123456789) / 12098)));
});

// Home >> Stock >> Wheat Stock >> View Bill
Breadcrumbs::for('view_wheat_stock', function($trail, $record) {
    $trail->parent('wheat_stock');
    $trail->push('View Bill', route('wheatStock.show', base64_encode(($record->id * 123456789) / 12098)));
});

// Home >> Stock >> Wheat Stock >> Edit Bill
Breadcrumbs::for('edit_wheat_stock', function($trail, $record) {
    $trail->parent('wheat_stock');
    $trail->push('Edit Bill', route('wheatStock.show', base64_encode(($record->id * 123456789) / 12098)));
});

// Home >> Stock >> Rice Stock
Breadcrumbs::for('rice_stock', function($trail) {
    $trail->parent('stock');
    $trail->push('Rice Stock', route('riceStock.index'));
});

// Home >> Customer >> {User} >> Add Rice Stock
Breadcrumbs::for('add_rice_stock', function($trail, $profile) {
    $trail->parent('view_customers', $profile);
    $trail->push('Add Rice Stock', route('riceStock.create', base64_encode(($profile->id * 123456789) / 12098)));
});

// Home >> Stock >> Rice Stock >> View Bill
Breadcrumbs::for('view_rice_stock', function($trail, $record) {
    $trail->parent('rice_stock');
    $trail->push('View Bill', route('riceStock.show', base64_encode(($record->id * 123456789) / 12098)));
});

// Home >> Stock >> Rice Stock >> Edit Bill
Breadcrumbs::for('edit_rice_stock', function($trail, $record) {
    $trail->parent('rice_stock');
    $trail->push('Edit Bill', route('riceStock.show', base64_encode(($record->id * 123456789) / 12098)));
});

?>
