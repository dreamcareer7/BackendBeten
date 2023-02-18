<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Group;
use App\Models\Crew;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupAPIController extends Controller
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
        if ($this->authUser->hasPermissionTo('groups.index')) {

            $doc = Group::get();

            return response()->json( ([
                'message'       => 'Groups list',
                'data'          =>  $doc,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to see Documents', 402);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        if($this->authUser->hasPermissionTo('groups.create')){
            Validator::make(
                $request->all(),
                $this->validationRules()
            )->validate();

            $row = Group::create([
                'title'=> $request->post('title'),
                'crew_id'=> $request->post('crew_id'),
            ]);


            return response()->json( ([
                'message'       => 'Groups Created Successfully',
                'data'          =>  $row,
                'status_code'   => 200,
            ]));
        }else{
            $msg = 'dont have permission to add Group';
            return $msg;
        }

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->authUser->hasPermissionTo('groups.view')) {
            $doc = Group::find($id);
            return response()->json( ([
                'message'       => 'Group Details',
                'data'          =>  $doc,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to see Group', 402);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
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
        if ($this->authUser->hasPermissionTo('groups.delete')) {
            $doc = Group::delete($id);

            return response()->json( ([
                'message'       => 'Groups Deleted Successfully',
                'data'          =>  null,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to delete Document', 402);
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
}
