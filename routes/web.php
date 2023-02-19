<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function() {

	Route::get('/home', [App\Http\Controllers\API\API\API\API\API\API\API\API\HomeController::class, 'index'])->name('home');

	Route::group(['prefix'=> 'dashboard', 'as'=>'dashboard.'], function() {
        // newWork starts here
		// Crew routes
		Route::group(['prefix'=> '/crew', 'as'=>'crew.'], function() {
			Route::get('/', [ App\Http\Controllers\API\API\API\API\API\API\API\API\CrewController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\API\API\API\API\API\API\API\API\CrewController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\CrewController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\CrewController::class, 'store'])->name('store');
		});
        // Service routes
		Route::group(['prefix'=> '/service', 'as'=>'service.'], function() {
			Route::get('/', [ App\Http\Controllers\API\API\API\API\API\API\API\API\ServiceController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\API\API\API\API\API\API\API\API\ServiceController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\ServiceController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\ServiceController::class, 'store'])->name('store');
		});
        // Vehicle routes
		Route::group(['prefix'=> '/vehicle', 'as'=>'vehicle.'], function() {
			Route::get('/', [ App\Http\Controllers\API\API\API\API\API\API\API\API\VehicleController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\API\API\API\API\API\API\API\API\VehicleController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\VehicleController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\VehicleController::class, 'store'])->name('store');
		});
        // Group routes
		Route::group(['prefix'=> '/group', 'as'=>'group.'], function() {
			Route::get('/', [ App\Http\Controllers\API\API\API\API\API\API\API\API\GroupController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\API\API\API\API\API\API\API\API\GroupController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\GroupController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\GroupController::class, 'store'])->name('store');
		});
        // Client routes
		Route::group(['prefix'=> '/client', 'as'=>'client.'], function() {
			Route::get('/', [ App\Http\Controllers\API\API\API\API\API\API\API\API\ClientController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\API\API\API\API\API\API\API\API\ClientController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\ClientController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\ClientController::class, 'store'])->name('store');
		});
        // Document routes
		Route::group(['prefix'=> '/document', 'as'=>'document.'], function() {
			Route::get('/', [ App\Http\Controllers\API\API\API\API\API\API\API\API\DocumentController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\API\API\API\API\API\API\API\API\DocumentController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\DocumentController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\DocumentController::class, 'store'])->name('store');
		});
        // Contract routes
		Route::group(['prefix'=> '/contract', 'as'=>'contract.'], function() {
			Route::get('/', [ App\Http\Controllers\API\API\API\API\API\API\API\API\ContractController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\API\API\API\API\API\API\API\API\ContractController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\ContractController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\ContractController::class, 'store'])->name('store');
		});
        // Complaint routes
		Route::group(['prefix'=> '/complaint', 'as'=>'complaint.'], function() {
			Route::get('/', [ App\Http\Controllers\API\API\API\API\API\API\API\API\ComplaintController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\API\API\API\API\API\API\API\API\ComplaintController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\ComplaintController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\ComplaintController::class, 'store'])->name('store');
		});
        // newWork ends here

		Route::group(['prefix'=> '/users', 'as'=>'users.'], function() {
			//Route::resource('users', App\Http\Controllers\UserController::class);
			Route::get('/',[App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'index'])->name('index');
			Route::get('browse', [ App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'browse'] )->name('browse');

			Route::get('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'store'])->name('store');

			Route::get('{user}',[App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'show'])->name('show');
			Route::get('profile',[App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'profile'])->name('profile');

			Route::get('{user}/edit',[App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'edit'])->name('edit');
			Route::put('{user}/update',[App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'update'])->name('update');
			Route::delete('{user}/delete',[App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'destroy'])->name('destroy');

			Route::get('next/{user}', [ App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'getNext'] )->name('next');
			Route::get('previous/{user}', [ App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'getPrevious'] )->name('previous');
			Route::get('{user}/delete',[App\Http\Controllers\API\API\API\API\API\API\API\API\UserController::class, 'delete'])->name('delete');
		});

	});

});


Route::get('migrate',function (){
    Artisan::call('migrate');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
