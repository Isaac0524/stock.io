<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/index', 'index')->name('index');
Route::view('/pages/ui-features/buttons', 'pages.ui-features.buttons')->name('ui.buttons');
Route::view('/pages/ui-features/dropdowns', 'pages.ui-features.dropdowns')->name('ui.dropdowns');
Route::view('/pages/ui-features/typography', 'pages.ui-features.typography')->name('ui.typography');
Route::view('/pages/forms/basic-elements', 'pages.forms.basic-elements')->name('forms.basic-elements');
Route::view('/pages/charts/chartjs', 'pages.charts.chartjs')->name('charts.chartjs');
Route::view('/pages/tables/basic-table', 'pages.tables.basic-table')->name('tables.basic-table');
Route::view('/pages/icons/mdi', 'pages.icons.mdi')->name('icons.mdi');
Route::view('/pages/samples/login', 'pages.samples.login')->name('auth.login');
Route::view('/pages/samples/register', 'pages.samples.register')->name('auth.register');

