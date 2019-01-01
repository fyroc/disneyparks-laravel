<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| All the routes for the Shopify App setup.
|
*/


Route::group(['middleware' => ['api']], function () {
    Route::get(
        '/api/disneyparks/resort/{resortid}',
        'fyroc\DisneyParks\Controllers\ResortController@resort'
    )
    ->name('resort');
    Route::get(
        '/api/disneyparks/resorts',
        'fyroc\DisneyParks\Controllers\ResortController@resorts'
    )
    ->name('resorts');

    Route::get(
        '/api/disneyparks/parks/{resortid}/{region?}',
        'fyroc\DisneyParks\Controllers\ParkController@parks'
    )
    ->name('parks');
    Route::get(
        '/api/disneyparks/park/{parkid}/{region?}',
        'fyroc\DisneyParks\Controllers\ParkController@park'
    )
    ->name('park');

    Route::get(
        '/api/disneyparks/attraction/{attractionid}/{type}/{region?}',
        'fyroc\DisneyParks\Controllers\AttractionController@attraction'
    )
    ->name('attraction');
    Route::get(
        '/api/disneyparks/attractions/{parkid}/{region?}',
        'fyroc\DisneyParks\Controllers\AttractionController@attractions'
    )
    ->name('attractions');
});