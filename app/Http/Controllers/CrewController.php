<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\User;
use App\Models\Profession;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if( ! auth()->user()->can('crew.browse'), 403, 'Forbidden');

		$result = view('crew.index')->render();

		return safeResponse($result);
    }

    public function browse(Request $request)
	{
        // abort_if( ! auth()->user()->can('users.browse'), 403, 'Forbidden');
		// abort_if( ! request()->ajax(), 404, 'Not found');

		$rows = Crew::query();
		$master = config('eogsoft.adminuser');
		return
			datatables()
				->eloquent( $rows )
				->startsWithSearch()
				->addIndexColumn()
				->addColumn('actions', function(Crew $crew) {
					// if($user->username == $master) return '---';
                    return view('layouts.crud.actions',['model_plural'=>'crews', 'row'=>$crew]);
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
        $data['users'] = User::all();
        $data['countries'] = Country::all();
        $data['profession'] = Profession::all();

		$result = view('crew.create', $data)->render();
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
        // abort_if( ! auth()->user()->can('users.create'), 403, 'Forbidden');
        $user = Auth::user();
        if($user->hasPermissionTo('crew.create')){
            Validator::make(
                $request->all(),
                $this->validationRules()
            )->validate();

            \Log::info('Request: ', $data);

            $row = Crew::create([
                'fullname'=> $request->post('fullname'),
                'gender'=> $request->post('gender'),
                'profession_id'=> $request->post('profession'),
                'country_id'=> $request->post('country'),
                'phone'=> $request->post('phone'),
                'id_type'=> $request->post('id_type'),
                'id_no'=> $request->post('id_no'),
                'dob'=> $request->post('dob'),
            ]);

            // $row->roles()->attach( $request->post('roles') );
            //if( $request->post('send_confirmation') > 0 )
            //	sendemailto( $row->email );

            return $this->index();
        }else{
            $message = 'dont have permission to create Crew';
            return $message;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crew  $crew
     * @return \Illuminate\Http\Response
     */
    public function show(Crew $crew)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crew  $crew
     * @return \Illuminate\Http\Response
     */
    public function edit(Crew $crew)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crew  $crew
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crew $crew)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crew  $crew
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crew $crew)
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
