<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Crew;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewCrewRequest;
use Illuminate\Http\{JsonResponse, Request};

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
		return response()->json(
			data: Crew::with('country:id,title')
				->paginate($request->input('per_page')?? 15)
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return JsonResponse
	 */

	public function store(NewCrewRequest $request)
	{
		$data= $request->only([
			'fullname',
			'gender',
			'profession_id',
			'phone',
			'country_id',
			'id_type',
			'id_no',
			'dob',
			'is_active',
		]);


		//check if any crew with same id type id number and country already exists
		$exists = Crew::where('id_type',$request->input('id_type'))
			->where('id_no',$request->input('id_no'))
			->where('country_id', $data['country_id'])
			->exists();
		if(!$exists){
			Crew::create($data);
			return response()->json( ([
				'message'       => 'Crew Created Successfully',
				'success'   => true,
			]));
		}

		return response()->json( [
			'message'       => 'A crew already exists with same id type, id number and country',
			'success'   => false,
		],422);

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
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function update($id,Request $request)
	{
		//
		$crew=  Crew::findorfail($id);

		$data= $request->only([
			'fullname',
			'gender',
			'profession_id',
			'phone',
			'country_id',
			'id_type',
			'id_no',
			'dob',
			'is_active',
		]);
		//check if any crew with same id type id number and country already exists
		$exists = Crew::where('id_type',$request->input('id_type'))
			->where('id_no',$request->input('id_no'))
			->where('country_id',$request->input('country_id'))->where('id','!=',$crew->id)
			->exists();
		if(!$exists){
			$crew->update($data);
			return response()->json( ([
				'message'       => 'Crew updated Successfully',
				'success'   => true,
			]));
		}
		return response()->json( [
			'message'       => 'A crew already exists with same id type, id number and country',
			'success'   => false,
		],422);
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


	private function validationRules()
	{
		$result = [
			// 'fullname' => 'required|string|min:4',
			// 'gender' => 'required',
			// 'id_type' => 'required',
			// 'id_number' => 'required',
		];

		return $result;
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