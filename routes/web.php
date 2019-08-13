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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('person', 'PersonsController',
    ['only' => ['create', 'show', 'store', 'destroy']]);
Route::get('search', 'SearchController@search')->name('search');
Route::get('/search/prepare', 'SearchController@prepare')->name('search.prepare');
Route::get('/search/result', 'ResultController@index')->name('search.result');
