<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\{Meal, MealType};
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateMealTypeRequest, UpdateMealTypeRequest};

class MealTypesController extends Controller
{
	/**
	 * Display a listing of the meal type.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(): JsonResponse
	{
		return response()->json(data: MealType::paginate(50));
	}

	/**
	 * Store a newly created meal type in database.
	 *
	 * @param \App\Http\Requests\CreateMealTypeRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateMealTypeRequest $request): JsonResponse
	{
		Meal::create([
			'title' => $request->title,
			'description' => $request->description,
			'has_documents' => $request->has_documents,
		]);
		return response()->json(status: 201); // Created
	}

	/**
	 * Display the specified meal type.
	 *
	 * @param \App\Models\MealType $mealType
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(MealType $mealType)
	{
		return response()->json($mealType);
	}

	/**
	 * Update the specified meal type in database.
	 *
	 * @param \App\Http\Requests\UpdateMealTypeRequest $request
	 * @param \App\Models\MealType $mealType
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateMealTypeRequest $request, MealType $mealType)
	{
		$mealType->update([
			'title' => $request->title,
			'description' => $request->description,
			'has_documents' => $request->has_documents,
		]);
		return response()->json(status: 204); // No content
	}

	/**
	 * Remove the specified meal type from database.
	 *
	 * @param \App\Models\MealType $mealType
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(MealType $mealType): JsonResponse
	{
		$mealType->delete();
		return response()->json(status: 204); // No content
	}
}
