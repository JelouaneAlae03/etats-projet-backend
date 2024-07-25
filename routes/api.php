<?php

use App\Http\Controllers\PostEncaissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\EtatReservation;
use App\Http\Controllers\EtatEncaissement;
use App\Http\Controllers\PostReservation;
use App\Http\Controllers\EtatStock;
use App\Http\Controllers\PostStock;
use App\Http\Controllers\EtatConsignations;
use App\Http\Controllers\PostConsignations;
use App\Http\Controllers\AuthController;





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
    Route::get('/stock',EtatStock::class);
    Route::get('/consignations',EtatConsignations::class);

    Route::Post('/getreservationsdata',PostReservation::class);
    Route::Post('/postencaissementsdata',PostEncaissement::class);
    Route::Post('/poststockdata',PostStock::class);
    Route::Post('/postConsignationsdata',PostConsignations::class);


});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);



