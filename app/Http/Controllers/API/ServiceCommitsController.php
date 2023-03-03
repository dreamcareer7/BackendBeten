<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\ServiceCommit;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateServiceCommitRequest, UpdateServiceCommitRequest};

class ServiceCommitsController extends Controller
{
	/**
	 * Display a listing of the service commits.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(): JsonResponse
	{
		$commits = ServiceCommit::select(
			'id',
			'service_id',
			'badge',
			'schedule_at',
			'started_at',
			'from_location',
			'supervisor_id'
		)->with(['service:id,title', 'supervisor:id,name'])->get();
		return response()->json($commits);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\CreateServiceCommitRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateServiceCommitRequest $request): JsonResponse
	{
		ServiceCommit::create($request->validated());
		return response()->json(status: 201); // Created status code
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(int $id): JsonResponse
	{
		$service_commit = ServiceCommit::select(
				'service_id',
				'badge',
				'schedule_at',
				'started_at',
				'location',
				'supervisor_id'
			// Eager load relationships
			)->with(['service:id,title', 'supervisor:id,name'])
			->where('id', $id)
			->first();

		return response()->json($service_commit); // auto serialized
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\UpdateServiceCommitRequest $request
	 * @param int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(UpdateServiceCommitRequest $request, int $id): JsonResponse
	{
		$service_commit = ServiceCommit::select('id')
			->where('id', $id)
			->first();
		// Request data already validated from the form request class
		$service_commit->service_id = $request->service_id;
		$service_commit->badge = $request->badge;
		$service_commit->schedule_at = $request->schedule_at;
		$service_commit->started_at = $request->started_at;
		$service_commit->location = $request->location;
		$service_commit->supervisor_id = $request->supervisor_id;
		// Save in the database
		$service_commit->save();
		return response()->json(status: 204); // No content
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id): JsonResponse
	{
		ServiceCommit::whereId($id)->delete();
		return response()->json(status: 204);
	}
}
