<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@index');


Route::get('/admin','AdminController@showFormLogin');
Route::post('/admin','AdminController@login')->name('login.admin');
Route::get('/logout','AdminController@logout')->name('admin.logout');
Route::prefix('admin')->group(function (){
    Route::get('/dashboard','AdminController@dashboard')->name('admin.dashboard');
    Route::get('/add-category','CategoryController@show_form_add_category_product')->name('admin.show-form-add');
    Route::post('/add-category','CategoryController@add_category_product')->name('admin.add-category-product');
    Route::get('/list-category-product','CategoryController@show_list_category_product')->name('admin.show-list-category');
    Route::get('/acive-Product/{id}','CategoryController@activeStatusProduct')->name('admin.active_product');
    Route::get('/unacive-Product/{id}','CategoryController@unactiveStatusProduct')->name('admin.unactive_product');


});

// Route::prefix('admin')->group(function(){

// })
