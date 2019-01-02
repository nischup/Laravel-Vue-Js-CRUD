<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', function () {
    return view('form');
});
 
Route::resource('users', 'UserController');
Route::resource('products', 'ProductController');
Route::resource('student', 'StudentController');
Route::post('student/delete_users', 'StudentController@deleteMarkData');

Auth::routes(['verify' => true]);

Route::get('profile', function () {
	return ('this is profile');
})->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');
