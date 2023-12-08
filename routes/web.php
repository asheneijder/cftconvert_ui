<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AccParamsController;
use App\Http\Controllers\redirection\divert;

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

Route::get('/', [divert::class, 'redirectordivert']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('companies', CompanyController::class);
// Route::resource('accountparams', AccParamsController::class);

// Route::get('/search',[ AccParamsController::class, 'search']);