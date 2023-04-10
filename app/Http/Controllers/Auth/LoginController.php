<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	public function login(Request $request)
	{
		$this->validateLogin($request);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if (
			method_exists($this, 'hasTooManyLoginAttempts') &&
			$this->hasTooManyLoginAttempts($request)
		) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}

		if (auth()->attempt([
			'email' => $request->email, 'password' => $request->password,
		])) {
			$user = User::where([
				'email' => $request->email,
				'is_active' => true,
			])->select('id')->first();

			// issue new Token
			$token = $user->createToken("System Login", $user->getPermissionsViaRoles()->pluck('name')->toArray())->plainTextToken;

			return response()->json([
				'token' => $token,
				'user' => $user,
				'permissions' => $user->getAllPermissions()->pluck('name'),
			]);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
	}

	public function tokenLogout(Request $request): \Illuminate\Http\JsonResponse
	{
		$request->user()->currentAccessToken()->delete();
		Cache::forget(auth()->user()->id);
		return response()->json([
			'status' => 'success'
		]);
	}
}
