<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Support\Str;
use App\Http\Resources\ContractResource;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{Storage, Validator, database};

class ContractsAPIController extends Controller
{
	/**
	 * Display a listing of the contracts for a given model.
	 *
	 * @param string $type the model type
	 * @param int $id the model id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(string $type, int $id): JsonResponse
	{
		$type = 'App\Models\\' . Str::title($type);
		// If the model specified is not in the contract model types
		// Refuse the query
		if (! in_array($type, Contract::$model_types)) {
			return response()->json(status: 400); // Bad request
		}
		$contracts = Contract::whereContractableType($type)
			->whereContractableId($id)
			->select('id', 'url')
			->get();
		return response()->json(ContractResource::collection($contracts));
	}

	/**
	 * Store newly created contracts for a specific model in database.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param string $type Model type to upload the contracts for
	 * @param int $id Model ID to upload the contracts for
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, string $type, int $id)
	{
		$type = 'App\Models\\' . Str::title($type);
		// TODO: Must also validate that the ID exists in that model
		// If the model specified is not in the contract model types
		// Of the request is missing contracts file
		// Reject the operation
		if (! in_array($type, Contract::$model_types) || !$request->hasFile('contracts')) {
			return response()->json(status: 400); // Bad request
		}
		// Iterate through the contracts files in the request
		foreach ($request->contracts as $contract) {
			// We can't get the dynamic model to attach contracts for
			// But we have the class name, so we invert the operation
			// Create a new contract from each of the files
			Contract::create([
				// TODO: we may need to put file metadata in extra column
				// 'title' => $contract->getClientOriginalName(),
				'url' => $contract->store('contracts'),
				'contractable_type' => $type, // Pass the model type, namespaced
				'contractable_id' => $id, // Pass the model ID
			]);
		}
		return response()->json(status: 201); // Created
	}

	/**
	 * Display the specified contract.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified contract in database.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified contract from database.
	 *
	 * @param int $id The ID of the contract to delete.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id): JsonResponse
	{
		Validator::make(['id' => $id], [
			'id' => 'bail|required|integer|exists:contracts,id'
		])->validate();
		$contract = Contract::select('id', 'url')->where('id', $id)->first();
		$contract->delete();
		// Should also delete the file
		Storage::delete($contract->url);
		return response()->json(status: 204); // No content
	}
}
