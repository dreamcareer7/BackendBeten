<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{NewVehicleRequest, UpdateVehicleRequest};

class VehicleAPIController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// abort_if( ! auth()->user()->can('vehicle.browse'), 403, 'Forbidden');

		$result = view('vehicle.index')->render();

		return safeResponse($result);
	}

	public function browse(Request $request)
	{
		// abort_if( ! auth()->user()->can('users.browse'), 403, 'Forbidden');
		// abort_if( ! request()->ajax(), 404, 'Not found');

		$rows = Vehicle::query();
		return
			datatables()
				->eloquent( $rows )
				->startsWithSearch()
				->addIndexColumn()
				->addColumn('actions', fn(Vehicle $vehicle) => view('layouts.crud.actions',['model_plural'=>'crews', 'row'=>$vehicle]))
				//->setRowAttr(function($row) {			})

				->setRowClass(function ($row) {
					if( $row->is_active == 1 )
						return 'active';
					return 'not-active';
				})
				->setRowId('rdt_{{$id}}')
				->toJson();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// abort_if( ! auth()->user()->can('users.create'), 403, 'Forbidden');

		$result = view('vehicle.create')->render();
		return safeResponse($result);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(NewVehicleRequest $request)
	{
		$data = $request->only([
			"model",
			"registration",
			"manufacturer",
			"year",
			"badge",
		]);
		Vehicle::create($data);
		return response()->json([
		   "success"=>true,
		   "message"=>"New Vehicle Added Successfully."
		]);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Service  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
		$vehicle = Vehicle::findorfail($id);
		return response()->json($vehicle);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Service  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Service $vehicle)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Service  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateVehicleRequest $request, $id)
	{
		$v = Vehicle::find($id);
		if ($request->missing('documents')) {
			$v->update([
			"model" => $request->model,
			"registration" => $request->registration,
			"manufacturer" => $request->manufacturer,
			"year" => $request->year,
			"badge" => $request->badge,
		]);
		} else {
			$v->update(); // trigger update for trait interecfp
		}

		return response()->json([
			"success"=>true,
			"message"=>"Information Updated Successfully."
		]);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Service  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Vehicle $vehicle)
	{
		$vehicle->forceDelete();
	}


	private function validationRules()
	{
		$result = [
			// 'fullname' => 'required|string|min:4',
			// 'gender' => 'required',
			// 'id_type' => 'required',
			// 'id_number' => 'required',
		];

		return $result;
	}

	public function paginate(Request $request){
		$users = Vehicle::orderby('id','desc');
		$model= $request->input('model') ?? null;
		$year= $request->input('model') ?? null;
		$model= $request->input('model') ?? null;
		$per_page= $request->input('per_page') ?? 25;
		if($model){
			$users->where('model','LIKE',$model.'%');
		}
		return response()->json($users->paginate($per_page));
	}
}
