<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\{CreateClientRequest, UpdateClientRequest};

class ClientsAPIController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Client::class);
	}

	/**
	 * Display a listing of the clients.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$query = Client::with('country:id,title');

		$request->whenFilled('fullname', function ($input) use ($query) {
			$query->where('fullname', 'LIKE', '%' . $input . '%');
		});

		$request->whenFilled('country', function ($input) use ($query) {
			$query->where('country_id', $input);
		});

		$request->whenFilled('gender', function ($input) use ($query) {
			$query->where('gender', $input);
		});

		return response()->json(
			data: $query->paginate($request->per_page ?? 15)
		);
	}

	/**
	 * Store a newly created client in database.
	 *
	 * @param \App\HTtp\Requests\CreateClientRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateClientRequest $request): JsonResponse
	{
		Client::create($request->validated());
		return response()->json(status: 201); // Created
	}

	/**
	 * Display the specified client.
	 *
	 * @param \App\Models\Client $client
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Client $client): JsonResponse
	{
		return response()->json(data: $client);
	}

	/**
	 * Update the specified client in database.
	 *
	 * @param \App\Models\Client $client
	 * @param \App\Http\Requests\UpdateClientRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(
		Client $client,
		UpdateClientRequest $request
	): JsonResponse
	{
		$client->update($request->validated());
		return response()->json(status: 204);
	}

	/**
	 * Remove the specified client from database.
	 *
	 * @param \App\Models\Client $client
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Client $client): JsonResponse
	{
		$client->delete();
		return response()->json(status: 204); // No content
	}
}
