<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class ClientsAPIController extends Controller
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

    public function store(Request $request)
    {
        if ($this->authUser->hasPermissionTo('clients.create')) {
            Validator::make(
                $request->all(),
                $this->validationRules()
            )->validate();

            $client = Client::create([
                'fullname' => $request->post('fullname'),
                'gender' => $request->post('gender'),
                'country_id' => $request->post('country'),
                'phone' => $request->post('phone'),
                'id_type' => $request->post('id_type'),
                'id_no' => $request->post('id_no'),
                'is_handicap' => $request->post('is_handicap'),
                'dob' => $request->post('dob'),
            ]);

            return response()->json( ([
                'message'       => 'Client Created Successfully',
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
        if ($this->authUser->hasPermissionTo('clients.view')) {
            $client = Client::find($id);
            return response()->json($client, 200);
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
        if ($this->authUser->hasPermissionTo('clients.delete')) {
            $client = Client::delete($id);

            return response()->json( ([
                'message'       => 'Client Deleted Successfully',
                'data'          =>  null,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to delete clients', 402);
        }
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
