<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\{Contract, Document};
use App\Http\Resources\ContractResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\{JsonResponse, Request};

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
		$contracts = Contract::where([
				'model_type' => $type,
				'model_id' => $id,
			])->select(
				'id',
				'reference',
				'model_type',
				'model_id',
				'extra',
				'created_by',
				'created_at',
				'deleted_by',
				'deleted_at'
			)->get();
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
		// Maybe also move this whole thing to a FormRequest class
		if (
			// If the model specified is not in the contract model types
			!in_array($type, Contract::$model_types) ||
			// Or the request is missing contracts files array
			!$request->hasFile('contracts') ||
			// Or the request is missing 'reference' of the contract
			// A "reference" is like a serial number (of passport for ex)
			$request->missing('reference')
		) {
			// Reject the operation
			return response()->json(status: 400); // Bad request
		}
		/*
		 * Create one contract for the reference and related model type
		 * We're assigning a contract_id variable to avoid name conflict
		 * with the iteration underneath, as well as reducing memory usage
		 * i.e we're not holding a gigantic object but just a single primitive
		 * data type
		 */
		$contract_id = Contract::create([
			'reference' => $request->reference,
			'model_type' => $type,
			'model_id' => $id,
			// TODO: we may need to put file metadata in extra column
			// 'extra' => 'To be implemented',
			'created_by' => auth()->id(),
		])->id;
		// Iterate through the contracts files in the request
		foreach ($request->contracts as $contract) {
			/**
			 * A contract is an arbitrary record in the database
			 * i.e it does not hold actual files
			 * We create multiple documents that do, belonging to the contract
			 * But the contract record itself belong to the model type coming
			 * from the request, this also explains why Contract model uses
			 * the trait HasDocuments
			 */
			Document::create([
				/*
				 * All the documents will have the one contract reference
				 * as their title
				 */
				// Hmmm... are you sure it's not the client original name????
				// We already have a reference to the reference (no pun intended)
				// So we might as well keep an extra information here
				// We may need it in the future, you never know ¯\_(ツ)_/¯
				'title' => $contract->getClientOriginalName(),
				'path' => $contract->store('documents'),
				'model_type' => Contract::class,
				'model_id' => $contract_id,
				'created_by' => auth()->id(),
			]);
		}
		return response()->json(data: $contract_id, status: 201); // Created
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
		Contract::where('id', $id)->delete();
		// Soft delete related documents
		Document::where([
			'model_type' => Contract::class,
			'model_id' => $id,
		])->delete();
		return response()->json(status: 204); // No content
	}
}
