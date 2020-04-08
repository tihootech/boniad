<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Auth::routes([
  'register' => false,
  'reset' => false,
  'verify' => false,
  'confirm' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');
