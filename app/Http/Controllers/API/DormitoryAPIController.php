<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\{Client, Dormitory};
use App\Http\Controllers\Controller;
use App\Http\Requests\NewDormitoryRequest;

class DormitoryAPIController extends Controller
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
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function add(NewDormitoryRequest $request)
	{
		//
		$data = $request->only([
		   "title",
		   "phones",
		   "city_id",
		   "location",
		   "coordinate",
		   "is_active",
		]);
		Dormitory::create($data);
		return response()->json([
			"success"=>true,
			"message"=>"Dormitory Added Successfully."
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Dormitory  $dormitory
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$dormitory = Dormitory::findorfail($id);
		return response()->json($dormitory);
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
			"phones",
			"city_id",
			"location",
			"coordinate",
			"is_active",
		]);
		$dormitory->update($data);
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

	public function paginate(Request $request)
	{
		$dormitories = Dormitory::orderby('id','desc');
		$title = $request->input('title') ?? null;
		$phone = $request->input('phones') ?? null;
		$city_id = $request->input('city_id') ?? null;
		$location = $request->input('location') ?? null;
		$coordinate = $request->input('coordinate') ?? null;
		$is_active = $request->input('is_active') ?? null;
		$per_page = $request->input('per_page') ?? 25;
		if ($title){
			$dormitories->where('title','LIKE',$title.'%');
		}
		if ($phone){
			$dormitories->where('phones','LIKE',$phone.'%');
		}
		if ($city_id){
			$dormitories->where('city_id','LIKE',$city_id.'%');
		}
		if ($location){
			$dormitories->where('location','LIKE',$location.'%');
		}
		if ($coordinate){
			$dormitories->where('coordinate','LIKE',$coordinate.'%');
		}
		if ($is_active){
			$dormitories->where('is_active',$is_active);
		}
		return response()->json($dormitories->paginate($per_page));
	}

}
