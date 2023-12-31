<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\{City, Dormitory};
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\{CreateDormitoryRequest, UpdateDormitoryRequest};

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DormitoriesImport;

/**
 * @group Dormitories
 *
 * API endpoints for managing Dormitories
 */
class DormitoriesController extends Controller
{
	/**
	 * Display a listing of the dormitories.
	 *
	 * @queryParam title string.
	 * @queryParam phones string.
	 * @queryParam city string.
	 *
	 * @param \Illuminate\Http\Request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$query = Dormitory::with('city:id,title');

		$request->whenFilled('title', function ($input) use ($query) {
			$query->where('title', 'LIKE', '%' . $input . '%');
		});

		$request->whenFilled('phones', function ($input) use ($query) {
			$query->where('phones', 'LIKE', '%' . $input . '%');
		});

		$request->whenFilled('city', function ($input) use ($query) {
			$query->whereIn(
				'city_id',
				City::where('title', 'LIKE', '%' . $input . '%')
					->select('id')->pluck('id')->toArray()
			);
		});

		return response()->json(
			data: $query->paginate($request->input('per_page') ?? 15)
		);
	}

	/**
	 * Store a newly created dormitory.
	 *
	 * @bodyParam title string required
	 * @bodyParam phones string required
	 * @bodyParam city_id int required
	 * @bodyParam location string required
	 * @bodyParam coordinate string
	 * @bodyParam is_active boolean required
	 *
	 * @param \App\HTtp\Requests\CreateDormitoryRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateDormitoryRequest $request): JsonResponse
	{
        //Dormitory::create($request->validated());
        $data = $request->only( [
            'title', 'phones', 'city_id', 'location', 'coordinate', 'is_active',
            // the follows been requested by Hulool/ArbHaj to be imported from Excel file
            'HOUSE_ID',
            'HOUSE_COMMERCIAL_NAME_AR',
            'HOUSE_COMMERCIAL_NAME_LA',
            'HOUSE_CITY_ID',
            'HOUSE_TOTAL_ROOMS',
            'HOUSE_GUEST_CAPACITY',
            'HOUSE_MAP_ADDRESS_LATITUDE',
            'HOUSE_MAP_ADDRESS_LONGITUDE',
            'HOUSE_ADDRESS_1',
            'HOUSE_PHONES_NO',
            'HOUSE_MANAGER_NAME',
            'HOUSE_MANAGER_PHONE',
            'HOUSE_RENEWAL_SEASON',
        ]);
        Dormitory::create($data);
		return response()->json(data: [
			'message' => __('Dormitory created successfully!'),
		], status: 201); // Created
	}

	/**
	 * Display the specified dormitory.
	 *
	 * @param \App\Models\Dormitory $dormitory
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Dormitory $dormitory): JsonResponse
	{
		return response()->json($dormitory->load('city:id,title'));
	}

	/**
	 * Update the specified dormitory in database.
	 *
	 * @bodyParam title string required
	 * @bodyParam phones string required
	 * @bodyParam city_id int required
	 * @bodyParam location string required
	 * @bodyParam coordinate string
	 * @bodyParam is_active boolean required
	 *
	 * @param \App\Models\Dormitory $dormitory
	 * @param \App\Http\Requests\UpdateDormitoryRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(
		Dormitory $dormitory,
		UpdateDormitoryRequest $request
	): JsonResponse
	{
		$dormitory->update($request->validated());
		return response()->json(status: 204);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Dormitory $dormitory
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Dormitory $dormitory): JsonResponse
	{
		$dormitory->delete();
		return response()->json(status: 204);
	}

	public function import_xlsx(Request $request)
	{
        Excel::import(new DormitoriesImport, request()->file('dormitories'));

		return response()->json(status: 200);


	}
}
