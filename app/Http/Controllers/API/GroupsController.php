<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\{Client, Crew, Group};
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\{AddClientsToGroupRequest, CreateGroupRequest, UpdateGroupRequest};

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
			data: $groups->with('crew:id,fullname')
				->withCount('clients')
				->paginate(15)
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
		return response()->json(data: [
			'message' => __('Group created successfully!'),
		], status: 201); // Created
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
			data: $group->load('crew:id,fullname', 'clients:id,group_id,fullname')
		);
	}

	/**
	 * Get the data for the form for editing a group.
	 *
	 * @param \App\Models\Group $group
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit(Group $group): JsonResponse
	{
		return response()->json(data: [
			'group' => $group,
			'crew_members' => Crew::select('id', 'fullname')->get(),
		]);
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
	 * Add clients to the group
	 *
	 * Update an array of clients setting their group_id to the current grou
	 *
	 * @param \App\Http\Requests\AddClientsToGroupRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 **/
	public function addClients(AddClientsToGroupRequest $request): JsonResponse
	{
		Client::whereIn('id', $request->clients)
			/**
			 * Extra filter just in case
			 * It's so we avoid overriding existing clients
			 */
			->whereNull('group_id')
			->update([
				'group_id' => $request->group_id,
			]);
		return response()->json(status: 202); // Accepted
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
