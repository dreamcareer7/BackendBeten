<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Concurrent;
use App\Models\ConcurrentRole;
use App\Models\ConcurrentUser;
use DB;

class ConcurrentController extends Controller
{

    public function index()
	{
		return response()->json(Concurrent::orderBy('id','desc')->get());
	}
    
    public function getusersroles(){

       $users = User::select('id','name')->where('is_active','1')->get();
       $roles = DB::table('roles')->select('id','name')->get();

       return response()->json(['users' => $users, 'roles' => $roles]);
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
	public function store(Request $request)
	{
		// dd($request->all());
		if($request->input('type') == 'Daily'){
           $data = $request->input('daily');
           $roles = $request->input('daily.roles');
		   $users = $request->input('daily.users');
		}else{
		   $data = $request->input('weekly');
		   $roles = $request->input('weekly.roles');
		   $users = $request->input('weekly.users');
		}

		$concurrent = Concurrent::create([
          'starting_at' => $request->input('start_at'),
          'ending_at' => $request->input('end_at'),
          'model_type' => $request->input('modelType'),
          'model_id' => $request->input('modelId'),
          'repeated_every' => $request->input('repeatedEvery'),
          'extra' => json_encode($data),
		]);
		
		foreach ($roles as $key => $role) {
			foreach ($role as $key2 => $value) {
				ConcurrentRole::create([
					'concurrent_id' => $concurrent->id,
					'role_id' =>  $value
				]);

				ConcurrentUser::create([
					'concurrent_id' => $concurrent->id,
					'user_id' =>  $users[$key][$key2]
				]);
			}

		}
		
		return response()->json(([
			'message' => 'Concurrent Created Successfully',
			'data' => $concurrent,
			'status_code' => 200,
			'success' => true,
		]));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Phase  $phase
	 * @return \Illuminate\Http\Response
	 */
	public function show(Phase $phase)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Phase  $phase
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Phase $phase)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Phase  $phase
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Phase $phase)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Phase  $phase
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Phase $phase)
	{
		//
	}
}
