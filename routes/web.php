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

/* Category */
// Create Category
Route::get('/create-category', 'CategoryController@create')->name('category');
Route::post('/create-category', 'CategoryController@store')->name('category_store');
/* End Category */

/* Posts */
// Create Post
Route::get('/create', 'PostController@create')->name('create');
Route::post('/create', 'PostController@store')->name('store');

// Show All Posts
Route::get('/posts', 'PostController@index')->name('posts');

// Show all details
Route::get('/posts/show/details/{id}', 'PostController@show')->name('show');

// Delete Post
Route::get('/posts/delete/{id}', 'PostController@destroy')->name('delete');
// Edit Posts
Route::get('/posts/edit/{id}', 'PostController@edit')->name('edit');
Route::post('/posts/edit/{id}', 'PostController@update')->name('update');



/* End Posts */

/* Image */
// Create Images
Route::get('/create-image', 'ImageController@create')->name('create_image');
Route::post('create-image', 'ImageController@store')->name('image_store');
/* End Image */