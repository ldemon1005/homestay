<?php

use \Illuminate\Support\Facades\Route;

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
Route::get('test', function () {
    return view('public.contact_us');
});

Route::group(['namespace' => 'Pub'], function() {
    Route::get('/', 'HomeController@getIndex');
    Route::get('home', 'HomeController@getHome')->name('home');
    Route::get('ajax-blog', 'HomeController@getBlogs');
    Route::get('contact-us', 'HomeController@getContactUs');
    Route::get('terms-and-conditions', 'HomeController@getTermsConditions');
    Route::get('copyright', 'HomeController@getCopyright');
    Route::get('support', 'HomeController@getSupport');

    Route::get('search-result', 'HomeController@getSearch');
    Route::get('detail/{id}', 'HomeController@getDetail')->name('detail_homestay');

    Route::get('register', 'HomeController@getRegister');
    Route::get('search', 'SearchController@getSearch');

    Route::post('search-ajax', 'SearchController@getAjaxSearch');
    Route::post('check-ajax', 'CheckController@getAjaxCheck');

    Route::group(['prefix' => 'signup', 'middleware' => 'CheckLoggedIn'], function () {
        Route::get('/', 'UserController@getSignup');
        Route::post('/', 'UserController@postSignup');
    });

    Route::group(['prefix' => 'login', 'middleware' => 'CheckLoggedIn'], function () {
        Route::get('/', 'LoginController@getLogin');
        Route::post('/', 'LoginController@postLogin');

    });

    Route::group(['prefix' => 'user', 'middleware' => 'CheckLoggedOut'], function () {
        Route::get('logout', 'LoginController@getLogout');

        Route::get('/', 'UserController@getBlank');
        Route::get('profile', 'UserController@getProfile')->name('getProfile');
        Route::get('seeDetailModal', 'UserController@seeDetailModal');
        Route::get('notification', 'UserController@getNotification');
        Route::get('book', 'UserController@getBook');

        Route::post('updateProfile', 'UserController@postUpdateProfile');
        Route::post('ajaxAvatar', 'UserController@postAjaxAvatar');
        Route::post('updatePassword', 'UserController@postUpdatePassword');

        Route::post('add_order', 'OrderController@add_order')->name('add_order');
        Route::get('update_status_book/{id}/{status}', "UserController@update_status_book")->name('update_status_book');
    });
});

Route::group(['namespace' => 'Payment', 'middleware' => 'CheckLoggedOut'], function () {
    Route::get('/info_payment', 'PaymentController@info_payment')->name('info_payment');
    Route::get('/action_info_payment', 'PaymentController@action_info_payment')->name('action_info_payment');
    Route::get('/payment_method', 'PaymentController@payment_method')->name('payment_method');
    Route::post('/action_payment_method', 'PaymentController@action_payment_method')->name('action_payment_method');
    Route::get('/update_status/{book_id}/{status}', 'PaymentController@update_status')->name('update_status');
    Route::get('/complete', 'PaymentController@complete')->name('complete');
    Route::get('/check_status_book/{id}', 'PaymentController@check_status_book')->name('check_status_book');
    Route::get('/ck_confirm/{id}', 'PaymentController@ck_confirm')->name('ck_confirm');
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/redirect/{social}', 'SocialAuthController@redirect')->name('soicial');
    Route::get('/callback/{social}', 'SocialAuthController@callback')->name('soicial_callback');
});

Route::post('/notification', function (Illuminate\Http\Request $request) {
    event(new App\Events\NotiEvent($request->get('message'), $request->get('book_id')));
    return [
        'status' => true,
    ];
})->name('notification');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/',function(){
        return view('admin.index.index');
    });
    Route::group(['prefix' => 'mod'], function(){
        Route::get('/', function(){
            return view('admin.mod.list');
        });
        Route::get('add',function(){
            return view('admin.mod.add');
        });
    });

    Route::group(['prefix' => 'guest'], function(){
        Route::get('/', function(){
            return view('admin.guest.list');
        });
    });

    Route::group(['prefix' => 'host'], function(){
        Route::get('/', function(){
            return view('admin.host.list');
        });
    });

    Route::group(['prefix' => 'config'], function(){
        Route::get('/', 'ConfigController@index');
        Route::post('banner','ConfigController@updateBanner');
        Route::post('info','ConfigController@updateInfo');
        Route::post('term','ConfigController@updateTerm');
        Route::post('policy','ConfigController@updatePolicy');
    });

    Route::get('general',function(){
        return view('admin.index.forms.general');
    });
    Route::get('advanced',function(){
        return view('admin.index.forms.advanced');
    });
    Route::get('editors',function(){
        return view('admin.index.forms.editors');
    });
    Route::get('simple',function(){
        return view('admin.index.tables.simple');
    });
    Route::get('data',function(){
        return view('admin.index.tables.data');
    });
});