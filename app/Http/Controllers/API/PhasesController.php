<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Phase;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePhaseRequest;
use Illuminate\Http\{JsonResponse, Request};

class PhasesController extends Controller
{
	/**
	 * Display a listing of the phases.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$query = Phase::orderby('id');
		$request->whenFilled('title', function ($input) use ($query) {
			$query->where('title', 'LIKE', '%' . $input . '%');
		});
		return response()->json($query->paginate(20));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Requests\CreatePhaseRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreatePhaseRequest $request): JsonResponse
	{
		Phase::create([
			'title' => $request->title,
			'is_required' => $request->is_required,
		])->services()->attach($request->services);
		return response()->json(status: 201); // Created
	}

	/**
	 * Display the specified phase.
	 *
	 * @param \App\Models\Phase $phaseService
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Phase $phase): JsonResponse
	{
		$phase->load('services:id,title');
		return response()->json(data: $phase);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\PhaseService  $phaseService
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update($id,CreatePhaseRequest $request)
	{
		//
		$title = $request->input('title');
		$this->clearPhaseServices($id);
		$this->assignServices($id,$request);
		Phase::where('id',$id)->update(['title'=>$title]);
		return response()->json([
		   "success"=>true,
		   "message"=>"Updated Successfully"
		]);
	}

	public function assignServices(int $phase_id, array $services)
	{
		foreach ($services as $service_id) {
			PhaseService::create([
				'phase_id' => $phase_id,
				'service_id' => $service_id,
			]);
		}
	}

	public function clearPhaseServices($phase_id)
	{
		PhaseService::where('phase_id', $phase_id)->delete();
		return true;
	}

	public function destroyPhase($id)
	{
		$phase = Phase::findorfail($id);
		//delete Phase
		Phase::where('id',$phase->id)->delete();
		//delete the services connection
		$this->clearPhaseServices($id);
		return response()->json([
			"success"=>true,
			"message"=>"Phase Removed Successfully."
		]);
	}
}
