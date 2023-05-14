<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateCityRequest;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};

class CitiesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(City::class);
    }

	/**
	 * Display a listing of the cities.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
	    if($request->withPaging) {
            $query = City::select('id', 'title', 'location_url');

            $column = 'title';

            $request->whenFilled($column, function ($input) use ($query, $column) {
                $query->where($column, 'LIKE', "%$input%");
            });

            return response()->json(
                data: $query->paginate($request->input('per_page') ?? 15)
            );
        }

        return response()->json(City::select('id', 'title')->get());
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateCityRequest $request)
	{
		City::create($request->validated());

        return response()->json(data: [
            'message' => __('Location created successfully!'),
        ], status: 201); // Created
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  City  $city
	 * @return \Illuminate\Http\Response
	 */
	public function edit(City $city)
	{
        return response()->json(data: [
            'city' => $city
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\City  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(City $city)
	{
        $city->delete();
        return response()->json(status: 204); // No content
	}
}
