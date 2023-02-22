<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewClientRequest;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class ClientsAPIController extends Controller
{
    use  ResponseTrait;


    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $authUser;
    private $userId;

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
        if ($this->authUser->hasPermissionTo('clients.index')) {

            $clients = Client::paginate($request->input('per_page')?? 25);

            return response()->json( ([
                'message'       => 'Client list',
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

    public function store(NewClientRequest $request)
    {

        $success = false;
        $message = '';

        $data = $request->only([
            "fullname",
            "gender",
            "country_id",
            "phone",
            "id_type",
            "id_no",
            "is_handicap",
            "dob",
        ]);

        //check if this client already exists
        $client = Client::where('country_id',$request->input('country_id'))
            ->where('id_type',$request->input('id_type'))
            ->where('id_no',$request->input('id_no'))->first();
        if($client){
           $success = false;
           $message ="There is already a client from same country, id type and id number.";
        }
        else{
            $c = Client::create($data);
            $success = true;
            $message = "New Client added successfully.";
        }

        return response()->json([
           "success"=>$success,
           "message"=>$message
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     * @return JsonResponse
     */
    public function show($id)
    {
        $client = Client::findorfail($id);
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id,Request $request)
    {
        $data = $request->only([
            "fullname",
            "gender",
            "country_id",
            "phone",
            "id_type",
            "id_no",
            "is_handicap",
            "dob",
        ]);
        $s = Client::findorfail($id);

        //check if this client already exists
        $client = Client::where('country_id',$request->input('country_id'))
            ->where('id_type',$request->input('id_type'))
            ->where('id','!=',$s->id)
            ->where('id_no',$request->input('id_no'))->first();
        if($client){
            $success = false;
            $message ="There is already a client from same country, id type and id type.";
        }
        else{
            $c = Client::where('id',$s->id)->update($data);
            $success = true;
            $message = "Client Updated successfully.";
        }

        return response()->json([
            "success"=>$success,
            "message"=>$message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {

            $client = Client::where('id',$id)->delete($id);

            return response()->json( ([
                'message'       => 'Client Deleted Successfully',
                'data'          =>  null,
                'status_code'   => 200,
            ]));

    }

    public function paginate(Request $request){

        $per_page = $request->input('per_page') ?? 25;
        $name = $request->input('name') ?? null;
        $gender= $request->input('gender') ?? null;
        $phone= $request->input('phone') ?? null;
        $country_id= $request->input('country') ?? null;
        $id_number = $request->input('id_number') ?? null;
        $clients = Client::countryName()->orderby('id','desc');

        if($name){
            $clients->where('fullname','LIKE',$name.'%');
        }
        if($country_id){
            $clients->where('country_id','LIKE',$country_id.'%');
        }
        if($phone){
            $clients->where('phone','LIKE',$phone.'%');
        }
        if($gender){
            $clients->where('gender',$gender);
        }
        if($id_number){
            $clients->where('id_number','LIKE',$id_number.'%');
        }
       return response()->json($clients->paginate($per_page));
    }

    private function validationRules()
    {
        $result = [
            'fullname' => 'required|string|min:4',
            'gender' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
        ];

        return $result;
    }

}
