<?php

use App\Http\Controllers\VarosController;
use App\Models\Megye;
use App\Models\Varos;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Föoldal route
Route::get('/', function () {
    return view('fo', [
        'megyek' => Megye::all(),
        'varosok' => Varos::all(),
    ]);
});

//Városok lekérésére használt route
Route::get('/varosLekerese/{megye}', [VarosController::class, 'varosLekerese']);

//Városok hozzáadására használt route
Route::post('/varosHozzaad', [VarosController::class, 'varosHozzaad'])->name('varosHozzaad');;

//Városok módosítására használt route
Route::post('/varosModosit', [VarosController::class, 'varosModosit'])->name('varosModosit');;

//Városok törlésére használt route
Route::post('/varosTorol', [VarosController::class, 'varosTorol'])->name('varosTorol');;