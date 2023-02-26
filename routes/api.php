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

Route::middleware('auth:sanctum')->group(function () {
	Route::get('countries', [\App\Http\Controllers\API\Data\CountriesController::class, 'index']);
	Route::resource('/services', ServiceAPIController::class);
	Route::resource('/cities', CitiesController::class);
	Route::resource('/meals', CitiesController::class);
	Route::get('/contracts/{type}/{id}', [ContractsAPIController::class, 'index']);

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
			Route::post('delete/{id}','delete');
			Route::post('update/{id}','update');
			Route::post('add','store');

		});
	Route::controller(DormitoryAPIController::class)->prefix('dormitories')
	   // ->middleware(['permission:manage_users'])
		->group(function () {
			Route::put('','store');
			Route::get('paginate','paginate');
			Route::get('info/{id}','show');
			Route::post('delete/{id}','destroy');
			Route::post('update/{id}','update');
			Route::post('add','add');

	});
	Route::controller(GroupsApiController::class)->prefix('groups')
	   // ->middleware(['permission:manage_users'])
		->group(function () {
			Route::put('','store');
			Route::get('paginate','paginate');
			Route::get('info/{id}','show');
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

	Route::controller(DocumentAPIController::class)->prefix('documents')->group(function () {
		Route::get('paginate','paginate');
		Route::post('upload','uploadFile');
		Route::get('info/{id}','info');
		Route::post('update/{id}','updateDocument');
		Route::post('delete/{id}','destroy');
		Route::get('model-types', 'getModelTypes');
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

	Route::apiResource('hospitalities', HospitalitiesController::class);

});
Route::controller(DocumentAPIController::class)->prefix('documents')->group(function () {
	Route::get('view/{path}','getFile');
});
// TODO: clean this up, figure out what it's for
Route::prefix('v2')->group(function() {
	Route::post('/sign_in', [App\Http\Controllers\API\Auth\LoginAPIController::class, 'signIn']);

	//we do not need it for client
   // Route::post('/sign_up', [App\Http\Controllers\API\Auth\RegisterAPIController::class, 'register']);
});
