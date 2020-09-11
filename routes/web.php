<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');


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

// Admin: albums

Route::patch('/createAlbum', 'AdminController@createAlbum');
Route::get('/getAlbums', 'AdminController@getAlbums');
Route::patch('/editAlbum/{album:id}', 'AdminController@editAlbum');
Route::get('/getAlbum/{album:id}', 'AdminController@getAlbum');











// Route::get('/', function () {
//     return view('welcome');
// });
