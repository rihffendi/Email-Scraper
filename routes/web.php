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

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::get('/register',  function () {
    return redirect('/');
});

Route::fallback(function() {
    return redirect('/');
});
Route::get('/home','HomeController@index')->name('home');
Route::get('/solo','ScrapeController@solo')->name('solo');
Route::post('/single-site','ScrapeController@singleSite')->name('singleSite');
