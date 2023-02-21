<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewCrewRequest;
use App\Models\Crew;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class CrewAPIController extends Controller
{
    use  ResponseTrait;


    public function __construct()
    {
        $this->authUser = auth('api')->user();
        $this->userId = @$this->authUser->id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        if ($this->authUser->hasPermissionTo('crew.index')) {

            $clients = Crew::paginate($request->input('per_page')?? 25);

            return response()->json( ([
                'message'       => 'Crew list',
                'data'          =>  $clients,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to see clients', 402);
        }
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
            ->where('country_id',$request->input('country_id'))
            ->exists();
        if(!$exists){
            Crew::create($data);
            return response()->json( ([
                'message'       => 'Crew Created Successfully',
                'success'   => true,
            ]));
        }
        else{
            return response()->json( [
                'message'       => 'A crew already exists with same id type, id number and country',
                'success'   => false,
            ],422);
        }


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
            Crew::where('id',$crew->id)->update($data);
            return response()->json( ([
                'message'       => 'Crew updated Successfully',
                'success'   => true,
            ]));
        }
        else{
            return response()->json( [
                'message'       => 'A crew already exists with same id type, id number and country',
                'success'   => false,
            ],422);
        }
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
        $users = Crew::orderby('id','desc');
        $title= $request->input('fullname') ?? null;
        $id_type= $request->input('id_type') ?? null;
        $country= $request->input('country') ?? null;
        $city_id= $request->input('city_id') ?? null;
        $location= $request->input('location') ?? null;
        $coordinate= $request->input('coordinate') ?? null;
        $is_active= $request->input('is_active') ?? null;
        $per_page= $request->input('per_page') ?? 25;
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
    public function all(){
        return response()->json(Crew::get());
    }

}
