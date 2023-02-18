<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
				->addColumn('actions', function(Vehicle $vehicle) {
                    return view('layouts.crud.actions',['model_plural'=>'crews', 'row'=>$vehicle]);
                })
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

    public function store(Request $request)
    {
        // abort_if( ! auth()->user()->can('users.create'), 403, 'Forbidden');
        $user_ = Auth::user();
        if($user_->hasPermissionTo('users.edit')){
            Validator::make(
                $request->all(),
                $this->validationRules()
            )->validate();

            $row = Service::create([
                'fullname'=> $request->post('fullname'),
                'gender'=> $request->post('gender'),
                'profession_id'=> $request->post('profession'),
                'country_id'=> $request->post('country'),
                'phone'=> $request->post('phone'),
                'id_type'=> $request->post('id_type'),
                'id_no'=> $request->post('id_no'),
                'dob'=> $request->post('dob'),
            ]);

            return $this->index();
        }else{
            $msg = 'dont have permission to add Vehicle';
            return $msg;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Service $vehicle)
    {
        //
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
    public function update(Request $request, Service $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $vehicle)
    {
        //
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
}
