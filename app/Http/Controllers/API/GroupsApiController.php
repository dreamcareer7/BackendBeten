<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\{NewDormitoryRequest, NewGroupRequest};
use App\Models\{Client, Crew, Dormitory, Group, GroupClients};

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
	 * Display the specified group.
	 *
	 * @param int $id The ID of the group to fetch
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(int $id): JsonResponse
	{
		$group = Group::select('id', 'title', 'crew_id')
			->where('id', $id)
			->with('crew:id,fullname')
			->first();

		return response()->json($group);
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

	public function paginate(Request $request)
	{
		$groups = Group::orderby('id');

		$request->whenFilled('title', function ($input) use ($groups) {
			$groups->where('title', 'LIKE', $input . '%');
		});

		$request->whenFilled('crew_member', function ($input) use ($groups) {
			// Get IDs of crew members starting with the query string value
			$crew_members_ids = Crew::select('id')
				->where('fullname', 'LIKE', '%' . $input . '%')
				->limit(50) // Reasonable limit, this gets hit on keyup
				->pluck('id');
			$groups->whereIn('crew_id', $crew_members_ids);
		});

		return response()->json(
			// Only eager load what's necessary for display
			data: $groups->with('crew:id,fullname')->paginate(25)
		);
	}

}
