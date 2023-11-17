<?php

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
