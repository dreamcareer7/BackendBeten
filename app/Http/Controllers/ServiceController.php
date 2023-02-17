<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if( ! auth()->user()->can('service.browse'), 403, 'Forbidden');

		$result = view('service.index')->render();

		return safeResponse($result);
    }

    public function browse(Request $request)
	{
        // abort_if( ! auth()->user()->can('users.browse'), 403, 'Forbidden');
		// abort_if( ! request()->ajax(), 404, 'Not found');

		$rows = Service::query();
		return
			datatables()
				->eloquent( $rows )
				->startsWithSearch()
				->addIndexColumn()
				->addColumn('actions', function(Service $services) {
                    return view('layouts.crud.actions',['model_plural'=>'services', 'row'=>$services]);
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
        $data['countries'] = Country::all();

		$result = view('service.create', $data)->render();
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

        Validator::make(
			$request->all(),
			$this->validationRules()
		)->validate();

        \Log::info('Request: ', $data);

		$row = Service::create([
			'title'=> $request->post('title'),
			'country_id'=> $request->post('country_id'),
			'before_date'=> $request->post('before_date'),
			'exact_date'=> $request->post('exact_date'),
			'after_date'=> $request->post('after_date'),
		]);

		// $row->roles()->attach( $request->post('roles') );
		//if( $request->post('send_confirmation') > 0 )
		//	sendemailto( $row->email );

		return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Service $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $services
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $services)
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
