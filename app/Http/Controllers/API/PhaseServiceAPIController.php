<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewPhaseRequest;
use App\Models\{Phase, PhaseService, Service};

class PhaseServiceAPIController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(NewPhaseRequest $request)
	{

		$phase = Phase::create(["title"=>$request->input('title')]);
		if($phase){
			$this->clearPhaseServices($phase->id);
			$this->assignServices($phase->id,$request);
		}
		return response()->json([
		   "success"=>true,
		   "message"=>"New Phase Added successfully."
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\PhaseService  $phaseService
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id)
	{
		$resp = null;
		$phase  = Phase::findorfail($id);
		$serv = [];
		if($phase){
			$resp = Phase::where('id',$phase->id)->with('services')->first();
			$services = PhaseService::where('phase_id',$phase->id)->get();
			foreach ($services as $phase_service){
			 $service =Service::where('id', $phase_service->service_id)->first();
			 $serv[]=$service;
			}
		}
		return response()->json([
			"phase"=>$phase,
			"services"=>$serv
		]);
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\PhaseService  $phaseService
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update($id,NewPhaseRequest $request)
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

	public function assignServices($phase_id,Request $request){
		$services = $request->input('services') ?? null;
		if($services){
			foreach ($services as $service){
				PhaseService::create([
				   "phase_id"=>$phase_id,
				   "service_id"=>$service["id"]
				]);
			}
		}
	}
	public function clearPhaseServices($phase_id){
		PhaseService::where('phase_id',$phase_id)->delete();
		return true;
	}
	public function destroyPhase($id){
		$phase  = Phase::findorfail($id);

		//delete Phase
		Phase::where('id',$phase->id)->delete();
		//delete the services connection
		$this->clearPhaseServices($id);
		return response()->json([
		   "success"=>true,
		   "message"=>"Phase Removed Successfully."
		]);
	}

	public function paginate(Request $request)
	{

		$per_page = $request->input('per_page') ?? 30;
		$title = $request->input('title') ?? null;
		$phase = Phase::orderby('id', 'desc')->with('services');

		if ($title) {
			$phase->where('title', 'LIKE', $title . '%');
		}
		return response()->json($phase->paginate($per_page));
	}

}
