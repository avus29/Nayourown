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

Route::group([
    'middleware' =>'auth:api'
], function(){

    Route::post('reports','ReportsController@store');//Create new report
    Route::post('reports/{slug}/{report}/claims', 'ClaimsController@store');// Add a claim to a report

    Route::group([
        'prefix' => 'auth'
      ], function() {
          Route::get('logout', 'AuthController@logout');//Logout a signed in user
          Route::get('user', 'AuthController@user');//Return user model
    });

});


Route::get('reports','ReportsController@index');//List reports
Route::get('reports/{slug}/{report}','ReportsController@show');//Show a single report

Route::put('reports','ReportsController@store');//update report
Route::delete('reports/{report}','ReportsController@destroy');//delete report

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');//Login a user & generate API token
    Route::post('signup', 'AuthController@signup');//Register a new user
    // Route::get('signup/activate/{token}', 'AuthController@signupActivate');
});


