<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\NewDormitoryRequest;
use App\Http\Requests\NewGroupRequest;
use App\Models\Client;
use App\Models\Dormitory;
use App\Models\Group;
use App\Models\GroupClients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GroupsApiController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createGroup(NewGroupRequest $request)
    {
        //
        $data = $request->only([
            "title",
            "crew_id",
        ]);
      $group=  Group::create($data);
      $group_id =$group->id;

      $this->assignClients($group_id,$request);

        return response()->json([
            "success"=>true,
            "message"=>"Group Added Successfully."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $group = Group::findorfail($id);
        $clients = GroupClients::where('group_id',$id)->get();
        $group_clients = [];

        foreach($clients as $client){
            $client = Client::where('id',$client->client_id)->first();
            $group_clients[]=$client;
        }
        return response()->json([
            "group"=>$group,
            "clients"=>$group_clients
        ]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id,Request $request)
    {
        $group = Group::findorfail($id);
        $data = $request->only([
            "title",
            "crew_id",
        ]);

        Group::where('id', $id)->update($data);


        return response()->json([
            "success"=>true,
            "message"=>"Group updated Successfully."
        ]);

    }

    public function assignClients($id,Request $request){
        $group = Group::findorfail($id);

        //delete all the group clients and insert new
        GroupClients::where('group_id', $id)->delete();

        $clients = $request->input('clients');
        if ($clients){
            foreach ($clients as $client) {
                $s=  GroupClients::create([
                    "client_id" => $client['id'],
                    "group_id" => $id
                ]);
             }
        }
        return response()->json([
           "success"=>true,
           "message"=>"Updated Successfully."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $group = Group::findorfail($id);
        Group::where('id',$id)->delete();
        return response()->json([
            "success"=>true,
            "message"=>"Group Deleted Successfully."
        ]);
    }

    public function paginate(Request $request){
        $groups = Group::orderby('id','desc');
        $title= $request->input('title') ?? null;
        $crew_id= $request->input('crew_id') ?? null;
        $per_page= $request->input('per_page') ?? 25;
        if($title){
            $groups->where('title','LIKE',$title.'%');
        }
        if($crew_id){
            $groups->where('crew_id',$crew_id);

        }

        return response()->json($groups->with('crew')->paginate($per_page));
    }

}
