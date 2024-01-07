<?php

use App\Http\Controllers\CommuneController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VilleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('search', [SearchController::class, 'search']);

Route::apiResource('pays', PaysController::class)->only('index', 'show');
Route::apiResource('provinces', ProvinceController::class)->only('index', 'show');
Route::apiResource('villes', VilleController::class)->only('index', 'show');
Route::apiResource('communes', CommuneController::class)->only('index', 'show');
