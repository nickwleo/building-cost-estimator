<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::auth();

Route::get('/home', [
    'as' => 'home', 'uses' => 'HomeController@index']);

Route::get('/', 'HomeController@index');

Route::get('/notification/form', 'AdminController@createNotificationForm');

Route::get('/notification/edit/{id}', 'AdminController@updateNotificationForm');

Route::post('/notification/create', 'AdminController@createNotification');

Route::post('/notification/update/{id}', 'AdminController@updateNotification');

Route::get('/notification/delete/{id}', 'AdminController@deleteNotification');

Route::post('/user/update/{id}', 'AdminController@updateRegistration');

Route::post('/user/updateViaAdmin/{id}', 'AdminController@adminUpdateRegistration');

Route::post('/user/passwordchange/{id}', 'AdminController@passwordChange');

Route::post('/node/create/{parent_id}', 'AdminController@createNode');

Route::get('/nodes', 'AdminController@getNodes');

Route::get('/prices/form', 'AdminController@pricingForm');

Route::post('/prices/update/{id}', 'AdminController@updatePricing');

Route::get('/users/manage', 'AdminController@manageUsers');

Route::get('/users/manage/{id}', 'AdminController@manageUser');

Route::post('/calculations/create', 'AdminController@createCalculation');

Route::get('/landingpage', 'AdminController@landingPage');




