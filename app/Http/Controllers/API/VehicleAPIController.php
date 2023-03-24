<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\{CreateVehicleRequest, UpdateVehicleRequest};

class VehicleAPIController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Vehicle::class);
	}
	public function paginate(Request $request)
	{
		$users = Vehicle::query();
		$model = $request->input('model') ?? null;
		$year = $request->input('model') ?? null;
		$model = $request->input('model') ?? null;
		$per_page = $request->input('per_page') ?? 15;
		if ($model) {
			$users->where('model', 'LIKE', $model . '%');
		}
		return response()->json($users->paginate($per_page));
	}

	/**
	 * Store a newly created vehicle in database.
	 *
	 * @param \App\Http\Requests\CreateVehicleRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateVehicleRequest $request): JsonResponse
	{
		Vehicle::create($request->validated());
		return response()->json(status: 201); // Created
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Service  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$vehicle = Vehicle::findorfail($id);
		return response()->json($vehicle);
	}

	/**
	 * Update the specified vehicle in database.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Vehicle $vehicle
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(
		UpdateVehicleRequest $request,
		Vehicle $vehicle
	): JsonResponse
	{
		$vehicle->update($request->validated());
		return response()->json(status: 202);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Service  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Vehicle $vehicle)
	{
		$vehicle->forceDelete();
	}
}
