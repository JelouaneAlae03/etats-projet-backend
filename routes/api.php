<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\EtatReservation;
use App\Http\Controllers\EtatEncaissement;
use App\Http\Controllers\PostReservation;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'etats'], function () {
    Route::get('/',[EtatController::class,'index']);
    Route::get('/reservations',EtatReservation::class);
    Route::get('/encaissements',EtatEncaissement::class);
    Route::Post('/getreservationsdata',PostReservation::class);
    Route::Post('/postencaissementsdata',PostReservation::class);
});


