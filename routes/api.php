<?php

declare(strict_types=1);

use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\ContractsAPIController;
use App\Http\Controllers\API\{
	CitiesController,
	ClientsAPIController,
	CrewAPIController,
	DocumentAPIController,
	DormitoryAPIController,
	GroupsApiController,
	HospitalitiesController,
	MealTypesController,
	MealsAPIController,
	PhaseServiceAPIController,
	ServiceAPIController,
	ServiceCommitAPIController,
	UserAPIController,
	VehicleAPIController
};

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here we register necessary API routes
| We only need POST /login & /password-confirm & /password/email & /password/reset
|
*/
Auth::routes();

Route::get('documents/{path}', [DocumentAPIController::class, 'download']);

Route::middleware('auth:sanctum')->group(function () {
	Route::get('countries', [\App\Http\Controllers\API\Data\CountriesController::class, 'index']);
	Route::apiResource('/services', ServiceAPIController::class);
	Route::apiResource('/cities', CitiesController::class);
	Route::apiResource('/meals', MealsAPIController::class);
	Route::apiResource('/meal_types', MealTypesController::class);
	Route::apiResource('hospitalities', HospitalitiesController::class);

	/** Contracts */
	Route::controller(ContractsAPIController::class)->prefix('contracts')
		->group(function () {
			Route::get('/{type}/{id}', 'index');
			Route::post('/{type}/{id}', 'store');
			Route::delete('/{id}', 'destroy');
		});
	
	/** Documents */
	Route::controller(DocumentAPIController::class)->prefix('documents')
		->group(function () {
			Route::get('/{type}/{id}', 'index');
			Route::post('/{type}/{id}', 'store');
			Route::delete('/{id}', 'destroy');
		});

	Route::controller(UserAPIController::class)->prefix('users')
		->group(function () {
			Route::put('','store');
			Route::get('paginate','paginate');
			Route::get('info/{id}','show');
			Route::post('delete/{id}','delete');
			Route::post('update/{id}','update');
			Route::post('add','store');

		});

	Route::controller(VehicleAPIController::class)->prefix('vehicles')
	   // ->middleware(['permission:manage_users'])
		->group(function () {
			Route::put('','store');
			Route::get('paginate','paginate');
			Route::get('info/{id}','show');
			Route::post('delete/{vehicle}','delete');
			Route::post('update/{id}','update');
			Route::post('add','store');

		});
	Route::controller(DormitoryAPIController::class)->prefix('dormitories')
		->group(function () {
			Route::put('','store');
			Route::get('paginate','paginate');
			Route::get('{id}','show');
			Route::post('delete/{id}','destroy');
			Route::patch('{id}','update');
			Route::post('add','add');
	});
	Route::controller(GroupsApiController::class)->prefix('groups')
	   // ->middleware(['permission:manage_users'])
		->group(function () {
			Route::put('','store');
			Route::get('paginate','paginate');
			Route::get('{id}', 'show');
			Route::post('delete/{id}','destroy');
			Route::post('update/{id}','update');
			Route::post('add','createGroup');
			Route::post('assign_clients/{id}','assignClients');
	});

	Route::controller(CrewAPIController::class)->prefix('crews')
	   // ->middleware(['permission:manage_users'])
		->group(function () {
			Route::put('','store');
			Route::get('paginate','paginate');
			Route::get('info/{id}','show');
			Route::post('delete/{id}','destroy');
			Route::post('update/{id}','update');
			Route::post('add','store');
			Route::get('all','all');
			Route::get('list', 'list');
	});


	Route::controller(ClientsAPIController::class)->prefix('clients')
	   // ->middleware(['permission:manage_users'])
		->group(function () {
			Route::put('','store');
			Route::get('paginate','paginate');
			Route::get('info/{id}','show');
			Route::post('delete/{id}','destroy');
			Route::post('update/{id}','update');
			Route::post('add','store');
			Route::get('all','all');
	});

	Route::controller(PhaseServiceAPIController::class)->prefix('phases')->group(function () {
	   Route::get('paginate','paginate');
	   Route::post('add','store');
	   Route::post('update/{id}','update');
	   Route::post('delete/{id}','destroyPhase');
	   Route::get('info/{id}','show');
	});


	// Get available roles & crew members to select from when creating a user
	Route::get(
		'populate-create-user-dropdowns',
		[UserAPIController::class, 'populateCreateUserDropdowns']
	);
	Route::get('services/all', [ServiceAPIController::class, 'all']);

	// Get available services to select from when creating a service commit
	Route::get('service/list', [ServiceAPIController::class, 'list']);
	// Get available users to select from when creating a service commit
	// as a supervisor_id
	Route::get('users/list_supervisors', [UserAPIController::class, 'list_supervisors']);

	// Service commits CRUD endpoints
	Route::controller(ServiceCommitAPIController::class)
		->prefix('service/commits')->group(function() {

			Route::get('/', 'index');
			Route::post('/', 'store');
			Route::get('{id}', 'show');
			Route::patch('{id}', 'update');
			Route::delete('{id}', 'destroy');
	});
});
// TODO: clean this up, figure out what it's for
Route::prefix('v2')->group(function() {
	Route::post('/sign_in', [App\Http\Controllers\API\Auth\LoginAPIController::class, 'signIn']);

	//we do not need it for client
   // Route::post('/sign_up', [App\Http\Controllers\API\Auth\RegisterAPIController::class, 'register']);
});
