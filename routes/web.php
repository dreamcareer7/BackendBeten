<?php

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

	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

	Route::group(['prefix'=> 'dashboard', 'as'=>'dashboard.'], function() {
        // newWork starts here
		// Crew routes
		Route::group(['prefix'=> '/crew', 'as'=>'crew.'], function() {
			Route::get('/', [ App\Http\Controllers\CrewController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\CrewController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\CrewController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\CrewController::class, 'store'])->name('store');
		});
        // Service routes
		Route::group(['prefix'=> '/service', 'as'=>'service.'], function() {
			Route::get('/', [ App\Http\Controllers\ServiceController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\ServiceController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\ServiceController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\ServiceController::class, 'store'])->name('store');
		});
        // Vehicle routes
		Route::group(['prefix'=> '/vehicle', 'as'=>'vehicle.'], function() {
			Route::get('/', [ App\Http\Controllers\VehicleController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\VehicleController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\VehicleController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\VehicleController::class, 'store'])->name('store');
		});
        // Group routes
		Route::group(['prefix'=> '/group', 'as'=>'group.'], function() {
			Route::get('/', [ App\Http\Controllers\GroupController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\GroupController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\GroupController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\GroupController::class, 'store'])->name('store');
		});
        // Client routes
		Route::group(['prefix'=> '/client', 'as'=>'client.'], function() {
			Route::get('/', [ App\Http\Controllers\ClientController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\ClientController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\ClientController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\ClientController::class, 'store'])->name('store');
		});
        // Document routes
		Route::group(['prefix'=> '/document', 'as'=>'document.'], function() {
			Route::get('/', [ App\Http\Controllers\DocumentController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\DocumentController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\DocumentController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\DocumentController::class, 'store'])->name('store');
		});
        // Contract routes
		Route::group(['prefix'=> '/contract', 'as'=>'contract.'], function() {
			Route::get('/', [ App\Http\Controllers\ContractController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\ContractController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\ContractController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\ContractController::class, 'store'])->name('store');
		});
        // Complaint routes
		Route::group(['prefix'=> '/complaint', 'as'=>'complaint.'], function() {
			Route::get('/', [ App\Http\Controllers\ComplaintController::class, 'index'] )->name('index');
			Route::get('browse', [ App\Http\Controllers\ComplaintController::class, 'browse'] )->name('browse');
			Route::get('create',[App\Http\Controllers\ComplaintController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\ComplaintController::class, 'store'])->name('store');
		});
        // newWork ends here

		Route::group(['prefix'=> '/users', 'as'=>'users.'], function() {
			//Route::resource('users', App\Http\Controllers\UserController::class);
			Route::get('/',[App\Http\Controllers\UserController::class, 'index'])->name('index');
			Route::get('browse', [ App\Http\Controllers\UserController::class, 'browse'] )->name('browse');

			Route::get('create',[App\Http\Controllers\UserController::class, 'create'])->name('create');
			Route::post('create',[App\Http\Controllers\UserController::class, 'store'])->name('store');

			Route::get('{user}',[App\Http\Controllers\UserController::class, 'show'])->name('show');
			Route::get('profile',[App\Http\Controllers\UserController::class, 'profile'])->name('profile');

			Route::get('{user}/edit',[App\Http\Controllers\UserController::class, 'edit'])->name('edit');
			Route::put('{user}/update',[App\Http\Controllers\UserController::class, 'update'])->name('update');
			Route::delete('{user}/delete',[App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');

			Route::get('next/{user}', [ App\Http\Controllers\UserController::class, 'getNext'] )->name('next');
			Route::get('previous/{user}', [ App\Http\Controllers\UserController::class, 'getPrevious'] )->name('previous');
			Route::get('{user}/delete',[App\Http\Controllers\UserController::class, 'delete'])->name('delete');
		});

	});

});
