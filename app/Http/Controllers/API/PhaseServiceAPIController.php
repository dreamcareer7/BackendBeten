<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewPhaseRequest;
use App\Models\Phase;
use App\Models\PhaseService;
use Illuminate\Http\Request;

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
        if($phase){
            $resp = Phase::where('id',$phase->id)->with('services')->first();
        }
        return response()->json($resp);
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
                   "services_id"=>$service["id"]
                ]);
            }
        }
    }
    public function clearPhaseServices($phase_id){
        PhaseService::where('phase_id',$phase_id)->delete();
        return true;
    }
    public function destroyService($id){
        $phase  = Phase::findorfail($id);

        //delete Phase
        Phase::where('id',$phase->id)->delete();
        //delete the services connection
        PhaseService::where('phase_id',$phase->id)->delete();
        return response()->json([
           "success"=>true,
           "message"=>"Phase Removed Successfully."
        ]);
    }
}
