<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\{JsonResponse, Request};
use App\Models\{Concurrent, ConcurrentRole, ConcurrentUser, User};

class ConcurrentController extends Controller
{
	public function getusersroles(): JsonResponse
	{
		return response()->json(data: [
				'users' => User::select('id', 'name')
					->where('is_active', true)
					->get(),
				'roles' => Role::select('id', 'name')
					->get()
			]);
	}

	/**
	 * Store a newly created concurrent in database.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request): JsonResponse
	{
		$concurrent = Concurrent::create([
			'starting_at' => $request->input('start_at'),
			'ending_at' => $request->input('end_at'),
			'model_type' => $request->input('modelType'),
			'model_id' => $request->input('modelId'),
			'repeated_every' => $request->input('repeatedEvery'),
			'extra' => $request->input('extra'),
		]);
		if ($request->input('type') == 'Weekly') {
			$roles = $request->input('wRoles');
			$users = $request->input('wUsers');
		} else {
			$roles = $request->input('dRoles');
			$users = $request->input('dUsers');
		}
		foreach ($roles as $key => $role) {
			ConcurrentRole::create([
				'concurrent_id' => $concurrent->id,
				'role_id' =>  $role
			]);

			ConcurrentUser::create([
				'concurrent_id' => $concurrent->id,
				'user_id' =>  $users[$key]
			]);
		}

		return response()->json(([
			'message' => 'Concurrent Created Successfully',
			'data' => $concurrent,
			'status_code' => 200,
			'success' => true,
		]));
	}
}
