<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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

		$token = null;
		$user = null;

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
		$success = false;
		$password = $request->input('password');
		$email = $request->input('email');
		$user = User::where([
			'email' => $email,
			'is_active' => true,
		])->first();
		if ($user) {
			//check for password
			$dbpassword = $user->password;
			if (Hash::check($password, $dbpassword)) {
				//issue new Token
				$token = $user->createToken("System Login", $user->getPermissionsViaRoles()->pluck('name')->toArray())->plainTextToken;
				$success = true;
				$message = "successfully logged in.";
			} else {
				$message = "Invalid Password";
			}
		} else {
			$message = "Invalid email address.";
		}

		if ($success) {
			return response()->json([
				"success" => $success,
				"message" => $message,
				"token" => $token,
				"user" => $user,
				'permissions' => $user->getAllPermissions()->pluck('name'),
			], $success ? 200 : 422);
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

		return response()->json([
			'status' => 'success'
		]);
	}
}
