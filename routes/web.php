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

// general user account management
Route::get('acc', 'AccController@edit')->name('acc');
Route::put('acc', 'AccController@update')->name('acc_update');
Route::put('acc/master', 'AccController@master_update')->name('master_acc_update');

// green management
Route::resource('resource', 'ResourceController')->except(['show','create', 'edit']);
Route::get('green-management', 'ResourceController@landing')->name('green_management');
Route::resource('consumption', 'ConsumptionController')->except('show');

// evaluations system
Route::resource('branch', 'BranchController')->except('show');
Route::resource('category', 'CategoryController')->except('show');
Route::resource('indicator', 'IndicatorController')->except('show');

Route::get('evaluation', 'EvaluationController@landing')->name('eval.landing');
Route::get('evaluation/list', 'EvaluationController@list')->name('eval.list');
Route::get('evaluation/new', 'EvaluationController@new')->name('eval.new');
Route::get('evaluation/{evaluation}', 'EvaluationController@show')->name('eval.show');

Route::post('evaluation/store', 'EvaluationController@store')->name('eval.store');
Route::post('evaluation/next/{evaluation}/{category}', 'EvaluationController@next')->name('eval.next');
Route::delete('evaluation/{evaluation}', 'EvaluationController@destroy')->name('eval.destroy');

Route::get('evaluate/{evaluation}/{category?}', 'EvaluationController@wizard')->name('evaluate');
