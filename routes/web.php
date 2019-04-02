<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', function () {
    return view('form');
});
 
Route::resource('users', 'UserController');
Route::resource('email-send', 'EmailController');
Route::resource('products', 'ProductController');
Route::post('student/saveplan', 'StudentController@saveplan');
Route::resource('student', 'StudentController');
Route::get('subscription-package/package_id', 'StudentController@packageDetail');
Route::post('student/delete_users', 'StudentController@deleteMarkData');

Auth::routes(['verify' => true]);

Route::get('profile', function () {
	return ('this is profile');
})->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');
