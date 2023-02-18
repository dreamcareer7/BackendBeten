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
    Route::post('/sign_in', [App\Http\Controllers\API\API\API\API\API\API\API\API\API\Auth\LoginAPIController::class, 'signIn']);
    Route::post('/sign_up', [App\Http\Controllers\API\API\API\API\API\API\API\API\API\Auth\RegisterAPIController::class, 'register']);
});

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::resource('/clients', App\Http\Controllers\API\API\API\API\API\API\API\API\API\ClientsAPIController::class);
});
