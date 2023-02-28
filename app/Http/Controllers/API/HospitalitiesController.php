<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Hospitality;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\CreateHospitalityRequest;

class HospitalitiesController extends Controller
{
	/**
	* Display a listing of the hospitality.
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	public function index(): JsonResponse
	{
		$hospitalities = Hospitality::select(
			'id',
			'title',
			'description',
			'required_date',
			'quantity',
			'received_by',
			'extra'
		// Eager load the receiver (crew member) full name
		)->with('receiver:id,fullname')->paginate(10);
		return response()->json(data: $hospitalities);
	}

	/**
	* Store a newly created hospitality in database.
	*
	* @param \App\Http\Requests\CreateHospitalityRequest $request
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	public function store(CreateHospitalityRequest $request): JsonResponse
	{
		Hospitality::create($request->validated());
		return response()->json(status: 201);
	}

	/**
	* Display the specified hospitality.
	*
	* @param \App\Models\Hospitality $hospitality
	*
	* @return \Illuminate\Http\Response
	*/
	public function show(Hospitality $hospitality)
	{
		//
	}

	/**
	* Update the specified hospitality in database.
	*
	* @param \Illuminate\Http\Request $request
	* @param \App\Models\Hospitality $hospitality
	*
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Hospitality $hospitality)
	{
		//
	}

	/**
	* Remove the specified hospitality from database.
	*
	* @param \App\Models\Hospitality $hospitality
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	public function destroy(Hospitality $hospitality): JsonResponse
	{
		$hospitality->delete();
		return response()->json(status: 204); // No content
	}
}
