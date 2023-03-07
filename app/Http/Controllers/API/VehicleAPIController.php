<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{NewVehicleRequest, UpdateVehicleRequest};

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
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(NewVehicleRequest $request)
	{
		$data = $request->only([
			"model",
			"registration",
			"manufacturer",
			"year",
			"badge",
		]);
		Vehicle::create($data);
		return response()->json([
			"success" => true,
			"message" => "New Vehicle Added Successfully."
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Service  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
		$vehicle = Vehicle::findorfail($id);
		return response()->json($vehicle);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Service  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateVehicleRequest $request, $id)
	{
		$v = Vehicle::find($id);
		if ($request->missing('documents')) {
			$v->update([
				"model" => $request->model,
				"registration" => $request->registration,
				"manufacturer" => $request->manufacturer,
				"year" => $request->year,
				"badge" => $request->badge,
			]);
		} else {
			$v->update(); // trigger update for trait interecfp
		}

		return response()->json([
			"success" => true,
			"message" => "Information Updated Successfully."
		]);
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
