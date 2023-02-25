<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Crew, Group};
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// abort_if( ! auth()->user()->can('group.browse'), 403, 'Forbidden');

		$result = view('group.index')->render();

		return safeResponse($result);
	}

	public function browse(Request $request)
	{
		// abort_if( ! auth()->user()->can('users.browse'), 403, 'Forbidden');
		// abort_if( ! request()->ajax(), 404, 'Not found');

		$rows = Group::query();
		return
			datatables()
				->eloquent( $rows )
				->startsWithSearch()
				->addIndexColumn()
				->addColumn('actions', fn(Group $group) => view('layouts.crud.actions',['model_plural'=>'crews', 'row'=>$group]))
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
		$crews = Crew::all();

		$result = view('group.create', compact('crews'))->render();
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
		$user = Auth::user();
		if($user->hasPermissionTo('groups.create')){
			Validator::make(
				$request->all(),
				$this->validationRules()
			)->validate();

			$row = Group::create([
				'title'=> $request->post('title'),
				'crew_id'=> $request->post('crew_id'),
			]);

			// $row->roles()->attach( $request->post('roles') );
			//if( $request->post('send_confirmation') > 0 )
			//	sendemailto( $row->email );

			return $this->index();
		}else{
			$msg = 'dont have permission to add Group';
			return $msg;
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function show(Group $group)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Group $group)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Group $group)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Group  $group
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Group $group)
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
