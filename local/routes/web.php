<?php

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
Route::get('test',function(){return view('public.payment.info');});

Route::group(['namespace' => 'Pub'], function() {
	Route::get('/','HomeController@getIndex');
	Route::get('search-result','HomeController@getSearch');
	Route::get('detail/{id}','HomeController@getDetail');
	Route::get('register','HomeController@getRegister');
	Route::get('location-api','HomeController@getLocationApi');
	Route::get('search','SearchController@getSearch');

	Route::post('search-ajax','SearchController@getAjaxSearch');
	Route::post('check-ajax','CheckController@getAjaxCheck');

	Route::group(['prefix' => 'signup'], function() {
	    Route::get('/','UserController@getSignup');
	    Route::post('/','UserController@postSignup');
	});

	Route::group(['prefix' => 'login','middleware' => 'CheckLoggedIn'], function() {
		Route::get('/','LoginController@getLogin');
		Route::post('/','LoginController@postLogin');
	});

	Route::group(['prefix' => 'user','middleware' => 'CheckLoggedOut'], function() {
		Route::get('logout','LoginController@getLogout');

		Route::get('/','UserController@getBlank');
		Route::get('profile','UserController@getProfile');
		Route::get('seeDetailModal','UserController@seeDetailModal');
		Route::get('notification','UserController@getNotification');
		Route::get('book','UserController@getBook');

		Route::post('updateProfile','UserController@postUpdateProfile');
		Route::post('ajaxAvatar','UserController@postAjaxAvatar');
		Route::post('updatePassword','UserController@postUpdatePassword');
	});
}); 