<?php

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


Route::group(['prefix'=>'v1','namespace'=>'API'], function () {
    Route::post('/zomato/cities', 'ZomatoController@getCities');
    Route::get('/zomato/categories', 'ZomatoController@getCategories');
    Route::post('/zomato/collections', 'ZomatoController@getCollections');
    Route::post('/zomato/cuisines', 'ZomatoController@getCuisines');
    Route::post('/zomato/establishments', 'ZomatoController@getEstablishments');
    Route::post('/zomato/geocode', 'ZomatoController@getGeoCode');
    Route::post('/zomato/locations', 'ZomatoController@getLocations');
    Route::post('/zomato/location-details', 'ZomatoController@getLocationDetails');
});

