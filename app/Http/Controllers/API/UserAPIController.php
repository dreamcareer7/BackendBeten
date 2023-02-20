<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\NewUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Service;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;

class UserAPIController extends Controller
{
    public function __construct()
    {
        $this->authUser = auth('api')->user();
        $this->userId = @$this->authUser->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($this->authUser->hasPermissionTo('users.browse')) {

            $clients = User::paginate($request->input('per_page')?? 25);

            return response()->json(([
                'message' => 'Users list',
                'data' => $clients,
                'status_code' => 200,
            ]));
        } else {
            return response()->json('dont have permission to see Users', 402);
        }
    }
    public function paginate(Request $request){

        $per_page = $request->input('per_page') ?? 1;
        $name = $request->input('name') ?? null;
        $email = $request->input('email') ?? null;
        $contact = $request->input('contact') ?? null;
        $clients = User::orderby('id','desc');

        if($name){
            $clients->where('name','LIKE',$name.'%');
        }
        if($email){
             $clients->where('email','LIKE',$email.'%');
        }
        if($email){
             $clients->where('contact','LIKE',$contact.'%');
        }
        return response()->json($clients->paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewUserRequest $request)
    {

            $row = User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'contact' => $request->input('contact'),
                'password' => Hash::make($request->input('password')),
                'is_active' => $request->input('is_active') ?? 1,
            ]);

            return response()->json(([
                'message' => 'Users Created Successfully',
                'data' => $row,
                'status_code' => 200,
                'success' => true,
            ]));


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       /*
        if ($this->authUser->hasPermissionTo('users.show')) {

        } else {
            return response()->json('dont have permission to see user', 402);
        }
       */
            $crew = User::whereId($id)->with('roles')->first();
            $roles = Role::select('name')->get();
            return response()->json([
                'message' => 'user Details',
                'data' => $crew,
                'available_roles' => $roles,
                'status_code' => 200,
            ]);


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        abort_if(!auth()->user()->can('users.profile'), 403, 'Forbidden');
        dd(auth()->user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, $user_id)
    {
       // if ($this->authUser->hasPermissionTo('users.edit')) {

        $user = User::findorfail($user_id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->is_active = $request->input('is_active');

            if ($request->password > ' ') // change password only if user entered a new one
                $user->password =Hash::make( $request->input('password'));

            $user->save();
            $user->syncRoles($request->input('roles'));

            return response()->json(([
                'message' => 'user updated successfully',
                'data' => null,
                'status_code' => 200,
                'success' => true,
            ]));
       // } else {
       //     return response()->json('dont have permission to update user', 402);

       // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {

        $user = User::findorfail($id);
        User::where('id',$user->id)->delete();
            return response()->json(([
                'message' => 'user Deleted Successfully',
                'data' => null,
                'status_code' => 200,
            ]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        //abort_if(!auth()->user()->can('users.destroy'), 403, 'Forbidden');

        $user->delete();
        return response()->json(([
            'message' => 'user Deleted Successfully',
            'data' => null,
            'status_code' => 200,
        ]));
    }


    private function validationRules($resource_id = 0)
    {
        $result = [
            'name' => 'required|string|min:10', //|unique:users,name'.($resource_id > 0 ? ','.$resource_id : ''),
            //'email' => 'required|email:rfc,dns|unique:users,email'.($resource_id > 0 ? ','.$resource_id : ''), //https://laravel.com/docs/9.x/validation#rule-email
         //   'email' => 'required|email|unique:users,email' . ($resource_id > 0 ? ',' . $resource_id : ''),
            'email'=>['required','email', Rule::unique('users')->ignore($this->id, 'id')],
            'username' => 'required|email|unique:users,email' . ($resource_id > 0 ? ',' . $resource_id : ''),
            'password' => 'min:8|confirmed' . ($resource_id > 0 ? '|nullable' : ''),
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
