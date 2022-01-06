<?php

use App\Http\Controllers\GarapanNyarController;
use App\Http\Controllers\ListGarapanController;
use App\Http\Controllers\TwitterTokenController;
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

Route::resource('/', GarapanNyarController::class);

Route::resource('twitter-token', TwitterTokenController::class);

Route::resource('list-garapan', ListGarapanController::class);

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