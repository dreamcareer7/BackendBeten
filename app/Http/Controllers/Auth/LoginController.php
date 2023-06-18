<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * @group Auth
 *
 * API endpoints for managing Auth
 */
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

	/**
	 *
	 * @bodyParam email string required The email of the user
	 * @bodyParam password string required The password
	 * @unauthenticated
	 *
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
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

		$email = $request->email;
		$password = $request->password;

		$user = User::where([
			'email' => $email
		])->first();

		if (!empty($user) && Hash::check($password, $user->password)) {

			/*$user = User::where([
				'email' => $request->email,
				'is_active' => true,
			])->select('id', 'name')->first();

			// issue new Token
			$token = $user->createToken("System Login", $user->getPermissionsViaRoles()->pluck('name')->toArray())->plainTextToken;

			return response()->json([
				'token' => $token,
				'user' => $user,
				'permissions' => $user->getAllPermissions()->pluck('name'),
			]);*/

			try {
				// Set OTP on system cache
				$otp = $this->setOTPCacheByUserId($user->id);

				// SEND SMS TO END USER
				$body = $otp;
				$recipients = $user->contact;
				// taqnyatSendSmsMsg($body, [$recipients]);

				return response()->json([
					'user_id' => $user->id
				]);

			}catch (\Exception $ex){

			}

			return response()->json([
				'message'=> "Unknown error"
			],500);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
	}

	private function setOTPCacheByUserId($id){
		$otp = rand(1000, 9999);
		$otp = 2222;
		cache()->put('user_otp_'.$id, $otp,5000);
		info("The OTP is ".$otp);

		return $otp;
	}

	private function isValidOTP($id,$generated_otp){
	   return cache()->get('user_otp_'.$id) == $generated_otp;
	}


	private function validateOTP(Request $request)
	{
		$request->validate([
			'otp' => 'required|digits:4',
			'user_id' => 'required',
		]);
	}

	/**
	 * @bodyParam user_id int required The id of the user Example: 20
	 * @bodyParam otp int required The otp Example: 2222
	 * @unauthenticated
	 *
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function verifyOTPandLogin(Request $request){

		$this->validateOTP($request);

		$user_id = $request->user_id;
		$otp = $request->otp;

		if($this->isValidOTP($user_id,$otp)){
			return $this->createAuthById($user_id);
		}

		return response()->json([
			'message'=> "OTP not found"
		],422);
	}

	// create auth by id
	private function createAuthById($id){

		if (auth()->loginUsingId($id)) {

			$user = User::where([
				'id' => $id,
				'is_active' => true,
			])->select('id', 'name', 'service_center_id')->first();

			// issue new Token
			$token = $user->createToken("System Login", $user->getPermissionsViaRoles()->pluck('name')->toArray())->plainTextToken;

			return response()->json([
				'token' => $token,
				'user' => $user,
				'permissions' => $user->getAllPermissions()->pluck('name'),
				'service_center'=> \App\Models\ServiceCenter::find($user->service_center_id)
			]);
		}
	}

	public function tokenLogout(Request $request): \Illuminate\Http\JsonResponse
	{
		$request->user()->currentAccessToken()->delete();

		return response()->json([
			'status' => 'success'
		]);
	}
}
