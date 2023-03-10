<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\{Crew, Group};
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\{CreateGroupRequest, UpdateGroupRequest};

class GroupsController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Group::class);
	}
	/**
	 * Display a listing of the groups.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$groups = Group::query();

		$request->whenFilled('title', function ($input) use ($groups) {
			$groups->where('title', 'LIKE', '%' . $input . '%');
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
			data: $groups->with('crew:id,fullname')->paginate(15)
		);
	}

	/**
	 * Store a newly created group in database.
	 *
	 * @param \App\Http\Requests\CreateGroupRequest
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateGroupRequest $request): JsonResponse
	{
		Group::create($request->validated());
		return response()->json(status: 201); // Created
	}

	/**
	 * Display the specified group.
	 *
	 * @param \App\Models\Group $group
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Group $group): JsonResponse
	{
		return response()->json(
			data: $group->load('crew:id,fullname', 'clients:id,fullname')
		);
	}

	/**
	 * Update the specified group in database.
	 *
	 * @param \App\Models\Group $group
	 * @param \App\Http\Requests\UpdateGroupRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Group $group, UpdateGroupRequest $request): JsonResponse
	{
		$group->update([
			'title' => $request->title,
			'crew_id' => $request->crew_id,
		]);
		// clients from the request is an array of client ids
		// sync means detaching the clients not in said array
		$group->clients()->sync($request->clients);
		return response()->json(status: 204); // No content
	}

	/**
	 * Remove the specified group from database.
	 *
	 * @param \App\Models\Group $group
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Group $group): JsonResponse
	{
		$group->delete();
		return response()->json(status: 204); // No content
	}
}
