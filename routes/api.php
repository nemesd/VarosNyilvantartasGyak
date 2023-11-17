<?php

use App\Http\Controllers\VarosAddController;
use App\Http\Controllers\VarosDeleteController;
use App\Http\Controllers\VarosEditController;
use App\Http\Controllers\VarosListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


//Városok lekérésére használt route
Route::get('/varosLekerese/{megye}', [VarosListController::class, 'varosLekerese']);

//Városok hozzáadására használt route
Route::post('/varosHozzaAd', [VarosAddController::class, 'varosHozzaAd']);

//Városok módosítására használt route
Route::post('/varosModosit', [VarosEditController::class, 'varosModosit']);

//Városok törlésére használt route
Route::post('/varosTorol', [VarosDeleteController::class, 'varosTorol']);