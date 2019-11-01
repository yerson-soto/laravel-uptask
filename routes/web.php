<?php

// Set the language
App::setLocale('es');

// Auth routes
Auth::routes(['verify' => true]);

// Home
Route::get('/', 'HomeController@index')->name('home');

// Projects routes
Route::resource('/projects', 'ProjectController');

// Tasks routes
Route::get('/{project}/tasks', 'TaskController@index');
Route::post('/{project}/tasks', 'TaskController@store');
Route::put('/tasks/{task}', 'TaskController@update');
Route::delete('/tasks/{task}', 'TaskController@destroy');



