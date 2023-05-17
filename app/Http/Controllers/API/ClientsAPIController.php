<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\{Client, Country};
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\{CreateClientRequest, UpdateClientRequest};

/**
 * @group Clients
 *
 * API endpoints for managing clients
 */
class ClientsAPIController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Client::class);
	}

	/**
	 * Display a listing of the clients.
	 *
	 * @queryParam fullname string.
	 * @queryParam country int.
	 * @queryParam gender string.
	 * @queryParam id_number string.
	 * @queryParam group int.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$query = Client::query();

		$request->whenFilled('fullname', function ($input) use ($query) {
			$query->where('fullname', 'LIKE', '%' . $input . '%');
		});

		$request->whenFilled('country', function ($input) use ($query) {
			$query->where('country_id', $input);
		});

		$request->whenFilled('gender', function ($input) use ($query) {
			$query->where('gender', $input);
		});

		$request->whenFilled('id_number', function ($input) use ($query) {
			$query->where('id_number', 'LIKE', '%' . $input . '%');
		});

		$request->whenFilled('group', function ($input) use ($query) {
			if ($input === 'ungrouped') {
				$query->whereNull('group_id');
			} else {
				$query->where('group_id', $input);
			}
		});

		$request->whenFilled('client_query', function ($input) use ($query) {
			$query->where('fullname', 'LIKE', '%' . $input . '%')
				->orWhere('id_number', 'LIKE', '%' . $input . '%');
		});

		return response()->json(
			data: $query->paginate($request->per_page ?? 15)
		);
	}

	/**
	 * Store a newly created client.
	 *
	 * @bodyParam fullname string required
	 * @bodyParam country_id int required
	 * @bodyParam id_type string required
	 * @bodyParam id_name string required
	 * @bodyParam id_number string required
	 * @bodyParam dob string required
	 * @bodyParam gender string required
	 * @bodyParam is_handicap boolean required
	 * @bodyParam phone string required
	 *
	 * @param \App\HTtp\Requests\CreateClientRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateClientRequest $request): JsonResponse
	{
		Client::create($request->validated());
		return response()->json(data: [
			'message' => __('Client created successfully!'),
		], status: 201); // Created
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
		return response()->json(data: $client->load('logs'));
	}

	/**
	 * Get the data for the form for editing a client.
	 *
	 * @param \App\Models\Client $client
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit(Client $client): JsonResponse
	{
		return response()->json(data: [
			'client' => $client,
			'countries' => Country::select('id', 'title')->get(),
		]);
	}

	/**
	 * Update the specified client.
	 *
	 * @bodyParam fullname string required
	 * @bodyParam country_id int required
	 * @bodyParam id_type string required
	 * @bodyParam id_name string required
	 * @bodyParam id_number string required
	 * @bodyParam dob string required
	 * @bodyParam gender string required
	 * @bodyParam is_handicap boolean required
	 * @bodyParam phone string required
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
