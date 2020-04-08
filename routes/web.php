<?php

use Illuminate\Support\Facades\Route;

// base route
Route::redirect('/', 'login');
Route::get('/home', 'HomeController@index')->name('dashboard');

// laravel auth
Auth::routes([
  'register' => false,
  'reset' => false,
  'verify' => false,
  'confirm' => false,
]);

// general user account control
Route::get('acc', 'AccController@edit')->name('acc');
Route::put('acc', 'AccController@update')->name('acc_update');
