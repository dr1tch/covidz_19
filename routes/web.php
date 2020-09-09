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


//Admin: Tags
Route::post('/addTag', 'AdminController@createTag');
Route::get('/getTags', 'AdminController@getTags');
Route::post('/editTag/{tag:id}', 'AdminController@editTag');
Route::post('/deleteTag/{tag:id}', 'AdminController@deleteTag');
Route::post('/deleteAllTags', 'AdminController@deleteAllTags');

// Admin: Categories
Route::post('/addCategory', 'AdminController@createCategory');
Route::get('/getCategories', 'AdminController@getCategories');
Route::post('/editCategory/{category:id}', 'AdminController@editCategory');
Route::post('/deleteCategory/{category:id}', 'AdminController@deleteCategory');
Route::post('/deleteAllCategories', 'AdminController@deleteAllCategories');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

