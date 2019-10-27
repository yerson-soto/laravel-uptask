<?php

App::setLocale('es');

// Projects routes
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::resource('/projects', 'ProjectController');


