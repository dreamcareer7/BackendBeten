<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceRequest;
use Illuminate\Http\{JsonResponse, Request};

class ServiceAPIController extends Controller
{
	public function __construct()
	{
		$this->authUser = auth('api')->user();
		$this->userId = @$this->authUser->id;
	}

	/**
	 * Display a listing of the services.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(): JsonResponse
	{
		$services = Service::select(
			'id', 'title', 'city_id', 'before_date', 'exact_date', 'after_date'
		)->with('city:id,title')->paginate(10);

		return response()->json(data: $services, status: 200);
	}

	/**
	 * List all available services
	 *
	 * This is currently consumed by the frontend to populate the services
	 * dropdown menu when creating a service commit
	 *
	 * @return \Illuminate\Http\JsonResponse
	 **/
	public function list(): JsonResponse
	{
		$services = Service::select('id', 'title')->get();
		return response()->json($services);
	}


	/**
	 * Store a newly created service in database.
	 *
	 * @param \App\Http\Requests\CreateServiceRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateServiceRequest $request): JsonResponse
	{
		Service::create([
			'title' => $request->title,
			'city' => $request->city,
			'before_date' => $request->before_date,
			'exact_date' => $request->exact_date,
			'after_date' => $request->after_date,
		]);

		return response()->json(data: [
			'message' => __('Service created!'),
		], status: 201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id)
	{
		//if ($this->authUser->hasPermissionTo('services.view')) {
			$crew = Service::find($id);
			return response()->json(([
				'message' => 'services Details',
				'data' => $crew,
				'status_code' => 200,
			]));
	   // } else {
	   //     return response()->json('dont have permission to see service', 402);
	   // }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update($id,Request $request)
	{
		//
		$service = Service::findOrFail($id);
		$service->update([
			'title' => $request->title,
			'city_id' => $request->city_id,
			'before_date' => $request->before_date,
			'exact_date' => $request->exact_date,
			'after_date' => $request->after_date,
		]);
		return response()->json(status: 204); // No content
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id)
	{
		//if ($this->authUser->hasPermissionTo('services.delete')) {
			$crew = Service::find($id)->delete($id);

			return response()->json( ([
				'message'       => 'services Deleted Successfully',
				'data'          =>  null,
				'status_code'   => 200,
			]));
	   // } else {
		//    return  response()->json('dont have permission to delete service', 402);
	   // }
	}

	public function all(){
		return response()->json(Service::get());
	}
}
