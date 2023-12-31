<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Models\{Country, Crew, Profession, User};
use App\Http\Requests\{CreateCrewRequest, UpdateCrewRequest};

/**
 * @group Crews
 *
 * API endpoints for managing crews
 */
class CrewsController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Crew::class);
	}

	/**
	 * Display a listing of the crew members.
	 *
	 * @queryParam fullname string.
	 * @queryParam country int.
	 * @queryParam phone string.
	 * @queryParam id_number string.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$query = Crew::with('country:id,title');

		$request->whenFilled('fullname', function ($input) use ($query) {
			$query->where('fullname', 'LIKE', '%' . $input . '%');
		});

		$request->whenFilled('country', function ($input) use ($query) {
			$query->where('country_id', $input);
		});

		$request->whenFilled('phone', function ($input) use ($query) {
			$query->where('phone', 'LIKE', '%' . $input . '%');
		});

		$request->whenFilled('id_number', function ($input) use ($query) {
			$query->where('id_number', 'LIKE', '%' . $input . '%');
		});

		return response()->json(
			data: $query->paginate($request->input('per_page')?? 15)
		);
	}

	/**
	 * Get the data for the form for creating a new crew member.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function create(): JsonResponse
	{
		return response()->json([
			'users' => User::select('id', 'name')->get(),
			'professions' => Profession::get(),
			'countries' => Country::select('id', 'title')->get(),
		]);
	}

	/**
	 * Store a newly created resource.
	 *
	 * @bodyParam fullname string required
	 * @bodyParam gender string required
	 * @bodyParam profession_id int
	 * @bodyParam country_id int required
	 * @bodyParam phone string
	 * @bodyParam id_type string required
	 * @bodyParam id_name string required
	 * @bodyParam id_number string required
	 * @bodyParam dob string
	 * @bodyParam is_active boolean
	 *
	 * @param \App\Http\Requests\CreateClientRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateCrewRequest $request): JsonResponse
	{
		Crew::create($request->validated());
		return response()->json(data: [
			'message' => __('Crew member created successfully!'),
		], status: 201); // Created
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Client $client
	 * @return JsonResponse
	 */
	public function show($id)
	{
	  $crew = Crew::findorfail($id);
	  return response()->json($crew);

	}

	/**
	 * Get the data for the form for editing a crew member.
	 *
	 * @param \App\Models\Crew $crew
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit(Crew $crew): JsonResponse
	{
		return response()->json(data: [
			'crew' => $crew,
			'professions' => Profession::get(),
			'countries' => Country::select('id', 'title')->get(),
		]);
	}

	/**
	 * Update the specified crew member.
	 *
	 * @bodyParam fullname string required
	 * @bodyParam gender string required
	 * @bodyParam profession_id int
	 * @bodyParam country_id int required
	 * @bodyParam phone string
	 * @bodyParam id_type string required
	 * @bodyParam id_name string required
	 * @bodyParam id_number string required
	 * @bodyParam dob string
	 * @bodyParam is_active boolean
	 *
	 * @param \App\Models\Crew $crew
	 * @param \App\Http\Requests\UpdateCrewRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Crew $crew, UpdateCrewRequest $request): JsonResponse
	{
        $user_id = $crew->user_id;
        $inputData = $request->validated();

        // when update crew name than update users table name column by user_id
        if($crew->update($inputData)){
            $upDateData['name'] = $inputData['fullname'];
            (new User())->updateById($user_id,$upDateData);
        }
		return response()->json(status: 204); // No content
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return JsonResponse
	 */
	public function destroy($id)
	{
		$crew = Crew::where('id',$id)->delete();
		return response()->json( ([
			'message'       => 'Crew Deleted Successfully',
			'data'          =>  null,
			'status_code'   => 200,
		]));

	}

	public function all(Request $request)
	{
		$query = Crew::select('id', 'fullname');

		$request->whenFilled('fullname', function ($input) use ($query) {
			$query->where('fullname', 'LIKE', '%' . $input . '%');
		});

		return response()->json($query->get());
	}
}
