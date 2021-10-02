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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('{user_id}/user/resend-email', 'UserController@resendEmail');
Route::get('{user_id}/user/{token}', 'UserController@verifyEmail');

Route::group(['middleware' => ['jwt.verify']], function() {

    //////     ALL USER RELATED     //////
    Route::get('user', 'UserController@getAuthenticatedUser');

    //////     ALL PARTNER TRAVELS RELATED     //////
    Route::get('{user_id}/partner-travels', 'PartnerTravelController@mainIndex');
    Route::get('{user_id}/partner-travels/tables', 'PartnerTravelController@showToTable');
    Route::resource('partner-travels', 'PartnerTravelController');

    //////     ALL PICKUP-POINTS RELATED     //////
    Route::get('{user_id}/pickup-points', 'PickupPointController@mainIndex');
    Route::get('{user_id}/pickup-points/tables', 'PickupPointController@showToTable');
    Route::resource('pickup-points', 'PickupPointController');

    //////     ALL USERS RELATED     //////
    Route::resource('users', 'UserController');

    //////     ALL TICKETS RELATED     //////
    Route::get('{user_id}/tickets', 'TicketController@index');
    Route::get('tickets/cancel/{ticket_id}', 'TicketController@cancelTicket');
    Route::resource('tickets', 'TicketController');

});
