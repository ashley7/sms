<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::resource('members','CustomerController');

Route::post('send_message','CustomerController@send_message');

Route::get('clean_phone','CustomerController@cleanPhone');

Auth::routes();

Route::get('/', 'CustomerController@index');

Route::resource('import_data','ImportDataController');
