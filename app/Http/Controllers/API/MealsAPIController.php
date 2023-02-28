<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Meal;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};

class MealsAPIController extends Controller
{
	/**
	 * Display a listing of the meals.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(): JsonResponse
	{
		// TODO: API resource and collection
		return response()->json(Meal::get());
	}

	/**
	 * Store a newly created meal in database.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request): JsonResponse
	{
		// TODO: add validation
		Meal::create([
			'meal_type_id' => $request->type_id,
			'quntity' => $request->quantity,
			'to_model_type' => $request->model_type,
			'to_model_id' => $request->model_id,
			'sent_at' => $request->sent_at,
		]);
		return response()->json(status: 201); // Created
	}

	/**
	 * Display the specified meal.
	 *
	 * @param \App\Models\Meal $meal
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Meal $meal): JsonResponse
	{
		return response()->json($meal);
	}

	/**
	 * Update the specified meal in database.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		// TODO: add validation
		$meal = Meal::findOrFail($id);
		$meal->update([
			'meal_type_id' => $request->type_id,
			'quntity' => $request->quantity,
			'to_model_type' => $request->model_type,
			'to_model_id' => $request->model_id,
			'sent_at' => $request->sent_at,
		]);
		return response()->json(status: 204); // No content
	}

	/**
	 * Remove the specified meal from database.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$meal = Meal::findOrFail($id);
		$meal->delete();
		return response()->json(status: 204); // No content
	}
}
