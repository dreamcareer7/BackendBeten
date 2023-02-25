<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// abort_if( ! auth()->user()->can('document.browse'), 403, 'Forbidden');

		$result = view('document.index')->render();

		return safeResponse($result);
	}

	public function browse(Request $request)
	{
		// abort_if( ! auth()->user()->can('users.browse'), 403, 'Forbidden');
		// abort_if( ! request()->ajax(), 404, 'Not found');

		$rows = Document::query();
		return
			datatables()
				->eloquent( $rows )
				->startsWithSearch()
				->addIndexColumn()
				->addColumn('actions', fn(Document $document) => view('layouts.crud.actions',['model_plural'=>'clients', 'row'=>$document]))
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
		$countries = Country::all();

		$result = view('document.create' , compact('countries'))->render();
		return safeResponse($result);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return string
	 */

	public function store(Request $request)
	{
		$user = Auth::user();
		if($user->hasPermissionTo('documents.create')){
			Validator::make(
				$request->all(),
				$this->validationRules()
			)->validate();

			Document::create([
				'fullname'=> $request->post('fullname'),
				'gender'=> $request->post('gender'),
				'country_id'=> $request->post('country'),
				'phone'=> $request->post('phone'),
				'id_type'=> $request->post('id_type'),
				'id_no'=> $request->post('id_no'),
				'is_handicap'=> $request->post('is_handicap'),
				'dob'=> $request->post('dob'),
			]);

			return $this->index();
		}else{
			$msg = 'dont have permission to add documents';
			return $msg;
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Service  $document
	 * @return \Illuminate\Http\Response
	 */
	public function show(Service $document)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Service  $document
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Service $document)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Service  $document
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Service $document)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Service  $document
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Service $document)
	{
		//
	}


	private function validationRules()
	{
		$result = [
			'fullname' => 'required|string|min:4',
			'gender' => 'required',
			'id_type' => 'required',
			'id_number' => 'required',
		];

		return $result;
	}
}
