<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Droits;
use App\Http\Controllers\EtatStock;
use App\Http\Controllers\getDbInfo;
use App\Http\Controllers\PostStock;
use App\Http\Controllers\DeleteRight;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetUsersList;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\GetUserDetails;
use App\Http\Controllers\UpdateDbConfig;
use App\Http\Controllers\EtatReservation;
use App\Http\Controllers\PostReservation;
use App\Http\Controllers\EtatEncaissement;
use App\Http\Controllers\PostEncaissement;
use App\Http\Controllers\ChangeUserDetails;
use App\Http\Controllers\EtatConsignations;
use App\Http\Controllers\PostConsignations;
use App\Http\Controllers\AfectDroitController;
use App\Http\Controllers\GetAllRights;
use App\Http\Controllers\AddRightsToUser;
use App\Http\Controllers\RemoveUserRight;









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


Route::group(['prefix' => 'etats', 'middleware' => ['VerifyJwtToken']], function () {
    Route::get('/', [EtatController::class, 'index']);
    Route::get('/reservations', EtatReservation::class);
    Route::get('/encaissements', EtatEncaissement::class);
    Route::get('/stock', EtatStock::class);
    Route::get('/consignations', EtatConsignations::class);

    Route::post('/getreservationsdata', PostReservation::class);
    Route::post('/postencaissementsdata', PostEncaissement::class);
    Route::post('/poststockdata', PostStock::class);
    Route::post('/postConsignationsdata', PostConsignations::class);
});

Route::group(['prefix' => 'users', 'middleware' => ['VerifyJwtToken']], function () {
    Route::post('/list', GetUsersList::class);
    Route::post('/userdetails', GetUserDetails::class);
    Route::put('/user/{id}', ChangeUserDetails::class);

});
Route::group(['prefix' => 'configuration', 'middleware' => ['VerifyJwtToken']], function () {
    Route::post('/database', getDbInfo::class);
    Route::post('/update-database', UpdateDbConfig::class);

});

Route::group(['prefix' => 'droits', 'middleware' => ['VerifyJwtToken']], function () {
    Route::get('/', [Droits::class, 'index']);
    Route::post('/add-droit', [Droits::class, 'store']);
    Route::post('/update-droit', [Droits::class, 'update']);
    Route::get('/info-formulaires', [Droits::class, 'getForm']);
    Route::post('/delete', DeleteRight::class);

});
Route::group(['prefix' => 'affect', 'middleware' => ['VerifyJwtToken']], function () {
    Route::post('/', [AfectDroitController::class, 'getDroit']);
    Route::post('/allrights', GetAllRights::class);
    Route::post('/addrightstouser', AddRightsToUser::class);
    Route::post('/remove-user-right', RemoveUserRight::class);



});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);



