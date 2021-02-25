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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('profile', 'ProfileController@index');
Route::get('profile/{id}', 'ProfileController@show');
Route::post('profile/create', 'ProfileController@store');


//adminview
Route::put('adminupdate/{id}', 'API\UserController@adminupdate');
Route::delete('delete/{id}', 'API\UserController@delete');
Route::post('adminview', 'API\UserController@adminview');
Route::post('logindetails', 'API\UserController@userdetails');
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::put('userinside/{email}', 'API\UserController@userInside');
Route::put('useroutside/{email}', 'API\UserController@userOutside');

Route::post('userforms', 'API\UserformsController@index');
Route::post('displaysurvey', 'API\UserformsController@displayrecords');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::put('update', 'API\UserController@update');
});

Route::get('estmonitor', 'API\EstMonitorController@display');
Route::put('estmonitor/formcreated', 'API\EstMonitorController@formCreated');
Route::put('estmonitor/isout', 'API\EstMonitorController@updateOut');

Route::get('contact-us', 'API\ContactController@getContact');
Route::post('contact-us', 'API\ContactController@saveContact');

Route::post('forgot_password', 'API\ForgotPassController@password');
Route::get('reset_password/{email}/{code}', 'API\ForgotPassController@reset');
Route::post('reset_password/{email}/{code}', 'API\ForgotPassController@resetPassword');








