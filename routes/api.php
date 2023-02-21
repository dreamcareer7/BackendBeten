<?php

use App\Http\Controllers\API\DocumentAPIController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:sanctum')->group(function(){
   // Route::resource('/users', App\Http\Controllers\API\UserAPIController::class); //->middleware(['permission:manage_users']);
    Route::resource('/services', App\Http\Controllers\API\ServiceAPIController::class);

    Route::controller(\App\Http\Controllers\API\UserAPIController::class)->prefix('users')
       // ->middleware(['permission:manage_users'])
        ->group(function(){
            Route::put('','store');
            Route::get('paginate','paginate');
            Route::get('info/{id}','show');
            Route::post('delete/{id}','delete');
            Route::post('update/{id}','update');
            Route::post('add','store');

        });

    Route::controller(\App\Http\Controllers\API\VehicleAPIController::class)->prefix('vehicles')
       // ->middleware(['permission:manage_users'])
        ->group(function(){
            Route::put('','store');
            Route::get('paginate','paginate');
            Route::get('info/{id}','show');
            Route::post('delete/{id}','delete');
            Route::post('update/{id}','update');
            Route::post('add','store');

        });
    Route::controller(\App\Http\Controllers\API\DormitoryAPIController::class)->prefix('dormitories')
       // ->middleware(['permission:manage_users'])
        ->group(function(){
            Route::put('','store');
            Route::get('paginate','paginate');
            Route::get('info/{id}','show');
            Route::post('delete/{id}','delete');
            Route::post('update/{id}','update');
            Route::post('add','add');

    });
    Route::controller(\App\Http\Controllers\API\GroupsApiController::class)->prefix('groups')
       // ->middleware(['permission:manage_users'])
        ->group(function(){
            Route::put('','store');
            Route::get('paginate','paginate');
            Route::get('info/{id}','show');
            Route::post('delete/{id}','destroy');
            Route::post('update/{id}','update');
            Route::post('add','createGroup');
            Route::post('assign_clients/{id}','assignClients');
    });

    Route::controller(\App\Http\Controllers\API\CrewAPIController::class)->prefix('crews')
       // ->middleware(['permission:manage_users'])
        ->group(function(){
            Route::put('','store');
            Route::get('paginate','paginate');
            Route::get('info/{id}','show');
            Route::post('delete/{id}','destroy');
            Route::post('update/{id}','update');
            Route::post('add','store');
            Route::get('all','all');
    });


    Route::controller(\App\Http\Controllers\API\ClientsAPIController::class)->prefix('clients')
       // ->middleware(['permission:manage_users'])
        ->group(function(){
            Route::put('','store');
            Route::get('paginate','paginate');
            Route::get('info/{id}','show');
            Route::post('delete/{id}','destroy');
            Route::post('update/{id}','update');
            Route::post('add','store');
            Route::get('all','all');
    });

    Route::controller(DocumentAPIController::class)->prefix('documents')->group(function(){
        Route::get('paginate','paginated');
        Route::post('upload','uploadFile');
    });

    // Get available roles to select from when creating a user
    Route::get('roles', [RoleController::class, 'index']);

});


Route::prefix('v2')->group(function() {
    Route::post('/sign_in', [App\Http\Controllers\API\Auth\LoginAPIController::class, 'signIn']);

    //we do not need it for client
   // Route::post('/sign_up', [App\Http\Controllers\API\Auth\RegisterAPIController::class, 'register']);
});

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::resource('/clients', App\Http\Controllers\API\ClientsAPIController::class);
    Route::resource('/crew', App\Http\Controllers\API\CrewAPIController::class);
    Route::resource('/documents', App\Http\Controllers\API\DocumentAPIController::class);
      Route::resource('/phases', App\Http\Controllers\API\PhaseAPIController::class);
});
Auth::routes();
Route::get('migrate',function(){
   \Illuminate\Support\Facades\Artisan::call('migrate');
   return 'migrated';
});
