<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'PanelController@index')->name('panel');//panel 

Route::resource('products','ProductController');