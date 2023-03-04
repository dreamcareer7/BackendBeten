<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\{CreateClientRequest, UpdateClientRequest};

class ClientsAPIController extends Controller
{
	/**
	 * Display a listing of the clients.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$query = Client::with('country:id,name');
		$request->whenFilled('fullname', function ($input) use ($query) {
			$query->where('fullname', 'LIKE', '%' . $input . '%');
		});
		return response()->json(
			data: $query->paginate($request->per_page ?? 15)
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\HTtp\Requests\CreateClientRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateClientRequest $request): JsonResponse
	{
		Client::create($request->validate());
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

	public function paginate(Request $request)
	{

		$per_page = $request->input('per_page') ?? 15;
		$name = $request->input('name') ?? null;
		$gender = $request->input('gender') ?? null;
		$phone = $request->input('phone') ?? null;
		$country_id = $request->input('country') ?? null;
		$id_number = $request->input('id_number') ?? null;
		$clients = Client::countryName()->orderby('id', 'desc');

		if ($name) {
			$clients->where('fullname', 'LIKE', $name . '%');
		}
		if ($country_id) {
			$clients->where('country_id', 'LIKE', $country_id . '%');
		}
		if ($phone) {
			$clients->where('phone', 'LIKE', $phone . '%');
		}
		if ($gender) {
			$clients->where('gender', $gender);
		}
		if ($id_number) {
			$clients->where('id_number', 'LIKE', $id_number . '%');
		}
		return response()->json($clients->paginate($per_page));
	}
}
