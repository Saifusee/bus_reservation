<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//////     ALL PARTNER TRAVELS RELATED     //////
Route::get('{user_id}/partner-travels', 'PartnerTravelController@index');
Route::resource('partner-travels', 'PartnerTravelController');

//////     ALL PICKUP-POINTS RELATED     //////
Route::get('{user_id}/pickup-points', 'PickupPointController@index');
Route::resource('pickup-points', 'PickupPointController');

//////     ALL USERS RELATED     //////
Route::resource('users', 'UserController');

//////     ALL TICKETS RELATED     //////
Route::resource('tickets', 'TicketController');

