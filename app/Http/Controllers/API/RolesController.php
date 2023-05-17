<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\{Role, User};
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{DB};
use App\Http\Requests\{CreateRoleRequest, UpdateRoleRequest};

/**
 * @group Roles
 *
 * API endpoints for managing roles
 */
class RolesController extends Controller
{
	/**
	 * Display a listing of the roles.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(): JsonResponse
	{
		// TODO: API resource and collection
		return response()->json(
			Role::select('id', 'name')->get()
		);
	}

	/**
	 * Display a listing of the roles.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getAllPermissions(): JsonResponse
	{
		$permissions = DB::table('permissions')
			->select('id', 'name')
			->get();
		return response()->json([
			'permissions' => $permissions,
		]);
	}

	/**
	 * Store a newly created role in database.
	 *
	 * @param \App\Http\Requests\CreateRoleRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateRoleRequest $request): JsonResponse
	{
		$created_role = Role::create([
			'name' => $request->name,
			'guard_name' => 'web',
			'created_at' => date("Y-m-d h:i:s"),
			'updated_at' => date("Y-m-d h:i:s"),
		]);
		foreach ($request->permissions as $permission) {
			DB::table('role_has_permissions')
				->insert([
					'permission_id' => $permission,
					'role_id' => $created_role['id'],
				]);
		}
		return response()->json(data: [
			'message' => __('Role created successfully!'),
		], status: 201); // Created
	}

	/**
	 * Display the specified role.
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id): JsonResponse
	{
		$role = Role::select('id', 'name')->findorfail($id);
		$role['users'] = User::role($role['id'])
								->select('name')
								->pluck('name')
								->toArray();
		return response()->json($role);
	}

	/**
	 * Display the specified role.
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit($id): JsonResponse
	{
		$role = Role::select('id', 'name')->findorfail($id);
		$role['permissions'] = DB::table('role_has_permissions as r')
			->leftJoin('permissions as p', 'p.id', 'r.permission_id')
			->where([
				'r.role_id' => $role['id'],
			])
			->select('p.id', 'p.name')
			->get();
		$role['available_permissions'] = DB::table('permissions')
			->select('id', 'name')
			->get();
		return response()->json($role);
	}

	/**
	 * Update the specified role in database.
	 *
	 * @param $id
	 * @param \App\Http\Requests\UpdateRoleRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update($id, UpdateRoleRequest $request): JsonResponse
	{
		Role::where('id', $id)
			->update([
				'name' => $request->name,
				'updated_at' => date("Y-m-d h:i:s"),
			]);
		DB::table('role_has_permissions')
			->where('role_id', $id)
			->delete();
		foreach ($request->permissions as $permission) {
			DB::table('role_has_permissions')
				->insert([
					'role_id' => $id,
					'permission_id' => $permission
				]);
		}
		return response()->json(status: 204); // No content
	}
}
