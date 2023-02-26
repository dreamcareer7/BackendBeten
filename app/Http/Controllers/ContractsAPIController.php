<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Support\Str;
use App\Http\Resources\ContractResource;
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
		$contracts = Contract::whereContractableType($type)
			->whereContractableId($id)
			->select('id', 'url')
			->get();
		return response()->json(ContractResource::collection($contracts));
	}

	/**
	 * Show the form for creating a new contract.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created contract in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified contract.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified contract.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified contract in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified contract from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
