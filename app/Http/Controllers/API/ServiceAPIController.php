<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Crew;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceAPIController extends Controller
{
    public function __construct()
    {
        $this->authUser = auth('api')->user();
        $this->userId = @$this->authUser->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if ($this->authUser->hasPermissionTo('services.index')) {

            $clients = Service::get();

            return response()->json(([
                'message' => 'services list',
                'data' => $clients,
                'status_code' => 200,
            ]));
        } else {
            return response()->json('dont have permission to see services', 402);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        if ($this->authUser->hasPermissionTo('services.create')) {
            Validator::make(
                $request->all(),
                $this->validationRules()
            )->validate();


            $row = Service::create([
                'title' => $request->post('title'),
                'country_id' => $request->post('country_id'),
                'before_date' => $request->post('before_date'),
                'exact_date' => $request->post('exact_date'),
                'after_date' => $request->post('after_date'),
            ]);

            return response()->json(([
                'message' => 'services created successfully',
                'data' => $row,
                'status_code' => 200,
            ]));
        } else {
            return response()->json('dont have permission to add service', 402);

        }

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if ($this->authUser->hasPermissionTo('services.view')) {
            $crew = Service::find($id);
            return response()->json(([
                'message' => 'services Details',
                'data' => $crew,
                'status_code' => 200,
            ]));
        } else {
            return response()->json('dont have permission to see service', 402);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id,Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->authUser->hasPermissionTo('services.delete')) {
            $crew = Service::delete($id);

            return response()->json( ([
                'message'       => 'services Deleted Successfully',
                'data'          =>  null,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to delete service', 402);
        }    }


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
}
