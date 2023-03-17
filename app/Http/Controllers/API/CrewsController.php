<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Models\{Country, Crew, Profession, User};
use App\Http\Requests\{CreateCrewRequest, UpdateCrewRequest};

class CrewsController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Crew::class);
	}
	/**
	 * Display a listing of the crew members.
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

		$request->whenFilled('id_number', function ($input) use ($query) {
			$query->where('id_number', 'LIKE', '%' . $input . '%');
		});

		return response()->json(
			data: $query->paginate($request->input('per_page')?? 15)
		);
	}

	public function create()
	{
		return response()->json([
			'users' => User::select('id', 'name')->get(),
			'professions' => Profession::get(),
			'countries' => Country::select('id', 'title')->get(),
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\CreateClientRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateCrewRequest $request): JsonResponse
	{
		Crew::create($request->validated());
		return response()->json(status: 201); // Created
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
	 * Update the specified crew member in database.
	 *
	 * @param \App\Models\Crew $crew
	 * @param \App\Http\Requests\UpdateCrewRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Crew $crew, UpdateCrewRequest $request): JsonResponse
	{
		$crew->update($request->validated());
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

	public function paginate(Request $request){
		$users = Crew::countryName()->orderby('id','desc');
		$title= $request->input('fullname') ?? null;
		$id_type= $request->input('id_type') ?? null;
		$country= $request->input('country') ?? null;
		$city_id= $request->input('city_id') ?? null;
		$location= $request->input('location') ?? null;
		$coordinate= $request->input('coordinate') ?? null;
		$is_active= $request->input('is_active') ?? null;
		$per_page= $request->input('per_page') ?? 15;
		if($title){
			$users->where('fullname','LIKE',$title.'%');
		}
		if($id_type){
			$users->where('id_type',$id_type);
		}
		if($country){
			$users->where('country','LIKE',$country.'%');
		}
		if($city_id){
			$users->where('city_id','LIKE',$city_id.'%');
		}
		if($location){
			$users->where('location','LIKE',$location.'%');
		}
		if($coordinate){
			$users->where('coordinate','LIKE',$coordinate.'%');
		}
		if($is_active){
			$users->where('is_active',$is_active);
		}
		return response()->json($users->paginate($per_page));
	}

	public function all(Request $request)
	{
		$query = Crew::select('id', 'fullname');

		$request->whenFilled('fullname', function ($input) use ($query) {
			$query->where('fullname', 'LIKE', '%' . $input . '%');
		});

		return response()->json($query->get());
	}

	/**
	 * List crew members
	 *
	 * This endpoint is currently used to populate the dropdown
	 * on the hospitality creation page
	 *
	 * @return \Illuminate\Http\JsonResponse
	 **/
	public function list(): JsonResponse
	{
		$crew = Crew::select('id', 'fullname')->get();
		return response()->json(data: $crew);
	}
}
