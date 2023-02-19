<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v2')->group(function() {
    Route::post('/sign_in', [App\Http\Controllers\API\Auth\LoginAPIController::class, 'signIn']);

    //we do not need it for client
   // Route::post('/sign_up', [App\Http\Controllers\API\Auth\RegisterAPIController::class, 'register']);
});

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::resource('/clients', App\Http\Controllers\API\ClientsAPIController::class);
    Route::resource('/services', App\Http\Controllers\API\ServiceAPIController::class);
    Route::resource('/crew', App\Http\Controllers\API\CrewAPIController::class);
    Route::resource('/users', App\Http\Controllers\API\UserAPIController::class);
    Route::resource('/vehicles', App\Http\Controllers\API\VehicleAPIController::class);
    Route::resource('/documents', App\Http\Controllers\API\DocumentAPIController::class);
    Route::resource('/groups', App\Http\Controllers\API\GroupAPIController::class);
    Route::resource('/dormitory', App\Http\Controllers\API\DormitoryAPIController::class);
    Route::resource('/phases', App\Http\Controllers\API\PhaseAPIController::class);
});
