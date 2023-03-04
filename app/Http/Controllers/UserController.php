<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

use Illuminate\Auth\Events\{Registered, Verified};
use Illuminate\Support\Facades\{Auth, Hash, Validator};
use Illuminate\Foundation\Auth\{AuthenticatesUsers, VerifiesEmails};

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		abort_if( ! auth()->user()->can('users.browse'), 403, 'Forbidden');

		$result = view('users.index')->render();

		return safeResponse($result);
	}

	public function paginate(Request $request){
		$users = User::orderby('id','desc');
		$search= $request->input('q') ?? null;
		$per_page= $request->input('per_page') ?? 15;
		if($search){
			$users->where('name','LIKE',$search.'%');
		}
		return response()->json($users->paginate($per_page));
	}

	/**
	 * Display a listing of the resource using Oracle DataTables / Yejira
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function browse(Request $request)
	{
		abort_if( ! auth()->user()->can('users.browse'), 403, 'Forbidden');
		abort_if( ! request()->ajax(), 404, 'Not found');

		$rows = User::query()->with(['roles', 'permissions']);
		$master = config('eogsoft.adminuser');
		return
			datatables()
				->eloquent( $rows )
				->startsWithSearch()
				->addIndexColumn()
				->addColumn('actions', function(User $user) use ($master) {
					if($user->username == $master) return '---';
					return view('layouts.crud.actions',['model_plural'=>'users', 'row'=>$user]);
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
		abort_if( ! auth()->user()->can('users.create'), 403, 'Forbidden');
		$roles= Role::all();

		$result = view('users.create', compact('roles'))->render();
		return safeResponse($result);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreUserRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$user = Auth::user();
		if($user->hasPermissionTo('users.create')){
			Validator::make(
				$request->all(),
				$this->validationRules()
			)->validate();

			$row = User::create([
				'name'=> $request->post('name'),
				'username'=> $request->post('username'),
				'contact'=> $request->post('contact'),
				'password'=> $request->post('password'), // Hash::make($request->post('password')), we hash in model
				'is_active'=> $request->post('is_active'),
			]);

			$row->roles()->attach( $request->post('roles') );
			//if( $request->post('send_confirmation') > 0 )
			//	sendemailto( $row->email );

			return $this->index();
		}else{
			$msg = 'dont have permission to add User';
			return $msg;
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		$result = view('users.show', ['row'=> $user])->render();

		return safeResponse($result);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function profile()
	{
		abort_if( ! auth()->user()->can('users.profile'), 403, 'Forbidden');
		dd(auth()->user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		abort_if( ! auth()->user()->can('users.edit'), 403, 'Forbidden');
		$roles= Role::all();
		$result = view('users.edit', ['row'=> $user, 'roles'=>$roles])->render();

		return safeResponse($result);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateUserRequest  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		$user_ = Auth::user();
		if($user_->hasPermissionTo('users.edit')){
			Validator::make(
				$request->all(),
				$this->validationRules( $user->id )
			)->validate();

			$user->name = $request->post('name');
			$user->email = $request->post('email');
			$user->is_active = $request->post('is_active');

			if( $request->password > ' ' ) // change password only if user entered a new one
				$user->password= $request->post('password');

			$user->save();
			$user->syncRoles( $request->post('roles') );

			return "Saved Successfully.";
		}else{
			$msg = 'dont have permission to add user';
			return $msg;
		}

		//return redirect()->route('dashboard.users.show', $user->id)->with('success', __('dashboard.messages.record_updated_successfully'));


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function delete(User $user)
	{
		abort_if( ! auth()->user()->can('users.destroy'), 403, 'Forbidden');
		$result = view('users.show', ['row'=> $user])->render();

		return safeResponse($result);

	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */

	public function destroy(User $user)
	{
		abort_if( ! auth()->user()->can('users.destroy'), 403, 'Forbidden');

	}


	private function validationRules($resource_id = 0)
	{
		$result = [
			'name' => 'required|string|min:10', //|unique:users,name'.($resource_id > 0 ? ','.$resource_id : ''),
			//'email' => 'required|email:rfc,dns|unique:users,email'.($resource_id > 0 ? ','.$resource_id : ''), //https://laravel.com/docs/9.x/validation#rule-email
			'email' => 'required|email|unique:users,email'.($resource_id > 0 ? ','.$resource_id : ''),
			'password' => 'min:4|confirmed'.($resource_id > 0 ? '|nullable' : ''),
/*
			'password' => [	// reference https://stackoverflow.com/questions/31539727/laravel-password-validation-rule
						'sometimes',
						'nullable',
						'string',
						'min:6',			  // must not be less than 6 letters
						'max:16',			  // must not be more than 16 letters
						//'regex:/[a-z]/',      // must contain at least one lowercase letter
						//'regex:/[A-Z]/',      // must contain at least one uppercase letter
						//'regex:/[0-9]/',      // must contain at least one digit
						//'regex:/[@$!%*#?&]/', // must contain a special character
						],
			'password_confirmation' => 'sometimes|nullable|min:6|max:16|same:password',
*/
		];

		return $result;
	}


}
