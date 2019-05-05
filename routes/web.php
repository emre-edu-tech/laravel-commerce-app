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

Route::post('/admin/categories/search', 'CategoriesController@search')->middleware('checkrole');

Route::resource('/admin/categories', 'CategoriesController')->middleware('checkrole');

Route::post('/admin/products/search', 'ProductsController@search')->middleware('checkrole');

Route::resource('/admin/products', 'ProductsController')->middleware('checkrole');

Route::resource('/admin/boxtype', 'BoxTypesController')->middleware('checkrole');

Route::resource('/admin/packagetype', 'PackageTypesController')->middleware('checkrole');