<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        if ($this->authUser->hasPermissionTo('crew.create')) {
            Validator::make(
                $request->all(),
                $this->validationRules()
            )->validate();

            $client = Crew::create([
                'fullname'=> $request->post('fullname'),
                'gender'=> $request->post('gender'),
                'profession_id'=> $request->post('profession'),
                'country_id'=> $request->post('country'),
                'phone'=> $request->post('phone'),
                'id_type'=> $request->post('id_type'),
                'id_no'=> $request->post('id_no'),
                'dob'=> $request->post('dob'),
            ]);

            return response()->json( ([
                'message'       => 'Crew Created Successfully',
                'data'          =>  $client,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to add clients', 402);
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
        if ($this->authUser->hasPermissionTo('crew.view')) {
            $crew = Crew::find($id);
            return response()->json( ([
                'message'       => 'Crew Details',
                'data'          =>  $crew,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json(null, 402);
        }
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if ($this->authUser->hasPermissionTo('crew.delete')) {
            $crew = Crew::delete($id);

            return response()->json( ([
                'message'       => 'Crew Deleted Successfully',
                'data'          =>  null,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to delete documents', 402);
        }
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
        $title= $request->input('title') ?? null;
        $phone= $request->input('phone') ?? null;
        $country= $request->input('country') ?? null;
        $city_id= $request->input('city_id') ?? null;
        $location= $request->input('location') ?? null;
        $coordinate= $request->input('coordinate') ?? null;
        $is_active= $request->input('is_active') ?? null;
        $per_page= $request->input('per_page') ?? 25;
        if($title){
            $users->where('title','LIKE',$title.'%');
        }
        if($phone){
            $users->where('phone','LIKE',$phone.'%');
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
