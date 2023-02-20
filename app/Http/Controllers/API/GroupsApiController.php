<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\NewDormitoryRequest;
use App\Http\Requests\NewGroupRequest;
use App\Models\Dormitory;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GroupsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGroup(NewGroupRequest $request)
    {
        //
        $data = $request->only([
            "title",
            "crew_id",
        ]);
        Group::create($data);
        return response()->json([
            "success"=>true,
            "message"=>"Group Added Successfully."
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(NewDormitoryRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\Response
     */
    public function show(Dormitory $dormitory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\Response
     */
    public function edit(Dormitory $dormitory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dormitory = Dormitory::findorfail($id);
        $data = $request->only([
            "title",
            "phone",
            "country",
            "city_id",
            "location",
            "coordinate",
            "is_active",
        ]);
        Dormitory::where('id',$id)->update($data);
        return response()->json([
            "success"=>true,
            "message"=>"Dormitory updated Successfully."
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
        $dormitory = Dormitory::findorfail($id);
        Dormitory::where('id',$dormitory->id)->delete();
        return response()->json([
            "success"=>true,
            "message"=>"Dormitory Deleted Successfully."
        ]);
    }

    public function paginate(Request $request){
        $users = Dormitory::orderby('id','desc');
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

}
