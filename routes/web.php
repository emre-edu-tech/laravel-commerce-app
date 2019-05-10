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

Route::get('/', 'PagesController@getIndex')->name('startpage');
Route::get('/about', 'PagesController@getAbout')->name('aboutpage');
Route::get('/contact', 'PagesController@getContact')->name('contactpage');
Route::get('/blog', 'PagesController@getBlog')->name('blogpage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::post('/admin/categories/search', 'CategoriesController@search')->middleware('checkrole');

Route::resource('/admin/categories', 'CategoriesController')->middleware('checkrole');

Route::post('/admin/products/search', 'ProductsController@search')->middleware('checkrole');

Route::resource('/admin/products', 'ProductsController')->middleware('checkrole');

Route::resource('/admin/boxtype', 'BoxTypesController')->middleware('checkrole');

Route::resource('/admin/packagetype', 'PackageTypesController')->middleware('checkrole');

Route::post('/admin/posts/search', 'PostsController@search')->middleware('checkrole');

Route::resource('/admin/posts', 'PostsController')->middleware('checkrole');

Route::post('/admin/postcategories/search', 'PostCategoriesController@search')->middleware('checkrole');

Route::resource('/admin/postcategories', 'PostCategoriesController')->middleware('checkrole');