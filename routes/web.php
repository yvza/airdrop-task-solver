<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('GarapanNyar');
});

Route::get('list-garapan', function () {
    return Inertia::render('ListGarapan');
});

Route::get('ngatur-akun', function () {
    return Inertia::render('NgaturAkun');
});

Route::get('ngatur-kata-kata', function () {
    return Inertia::render('NgaturKataKata');
});

Route::get('basis-kawruh', function () {
    return Inertia::render('BasisKawruh');
});

Route::get('kridit', function () {
    return Inertia::render('Kridit');
});