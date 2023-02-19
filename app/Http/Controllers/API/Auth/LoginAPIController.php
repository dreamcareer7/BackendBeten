<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class LoginAPIController extends Controller
{
    public function signIn(Request $request)
    {
        $input = $request->only('username', 'password');
        //valid credential
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please check all the required parameter',
                'response' => $validator->errors()], 422);
        }

        try {
            if (!$tokenAll = JWTAuth::attempt($input)) {
                return response()->json([
                    'status' => false,
                    'message' => "Login credentials are invalid.",
                    'response' => null], 422);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login Successfully',
            'response' => $tokenAll], 200);
    }

    public function getProfile(Request $request)
    {
        $current_user = auth('customer-app')->user()->load(['wallet', 'wallet.restrictions', 'wallet.transaction', 'wallet.transaction.transaction_lines', 'wallet.balance', 'wallet.mop', 'transaction']);
        if ($current_user->wallet && $current_user->wallet->transaction && $current_user->transaction) {
            foreach ($current_user->wallet->transaction as $trsWallet) {
                if ($trsWallet->type === 'transfer_balance_sub_user') {
                    $trsWallet['sub_customer'] = Contact::find($trsWallet['contact_id']);
                }
            }

            foreach ($current_user->transaction as $trs) {
                if ($trs->type === 'order_fuel') {
                    $trs['station'] = Contact::find($trs['station_id']);
                    $trs['product'] = Contact::find($trs['station_id']);
                }
            }
        }


        return response()->json([
            'status' => true,
            'message' => 'Current User Successfully',
            'response' => $current_user], 200);
    }

    public function updateProfile(Request $request, $id)
    {
        $current = Contact::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'email' => 'required|unique:contacts',
            'mobile' => 'required|string|max:20|unique:contacts',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please check all the required parameter',
                'response' => $validator->errors()], 422);
        }

        $current->name = $request->name;
        $current->mobile = $request->mobile;
        $current->email = $request->email;
        $current->save();

        return response()->json([
            'status' => true,
            'message' => 'Updated User Successfully',
            'response' => $current], 200);

    }

    public function updateLang(Request $request, $id)
    {
        $user = Contact::find($id);
        $user->default_lang = $request->default_lang;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Default lang updated Successfully',
            'response' => $user], 200);
    }


    public function generateOtp()
    {
        $current_user = auth('customer-app')->user();

        # Get latest OTP Of The Customer
        $verificationCode = VerificationOTP::where('user_id', $current_user->id)->latest()->first();

        $now = Carbon::now();

        if ($verificationCode && $now->isBefore($verificationCode->expire_at)) { //Return Old OTP If Not expired
            return $verificationCode->otp;
        } else { //Delete Old OTP If Exist
            VerificationOTP::where('user_id', $current_user->id)->delete();
        }

        // Create a New OTP
        $otp = rand(123456, 999999);

        VerificationOTP::create([
            'user_id' => $current_user->id,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addMinutes(5)
        ]);

        //Send Mail With OTP

        return response()->json([
            'status' => true,
            'message' => 'OTP Code generate Successfull',
            'response' => $otp], 200);
    }

    public function RegisterVerificationOTP(Request $request)
    {

        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'otp_recieved' => 'required|numeric|digits:6',
                'mobile' => 'required',
            ], [
                'otp_recieved.required' => 'OTP Field Is Required.',
                'otp_recieved.number' => 'OTP Should Be A Number.',
                'otp_r  ecieved.max' => 'OTP Exceeds the Charecters Limit.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Plese check all the required parameter',
                    'response' => $validator->errors()], 422);
            }

            $user = Contact::where('mobile', '=', $request->input('mobile'))->first();
            if ($user) {
                $otpData = VerificationOTP::where('user_id', '=', $user->id)->latest()->first();
                $now = Carbon::now();
                if ($request->input('otp_recieved') == $otpData->otp && $now->isBefore($otpData->expire_at)) {
                    return response()->json([
                        'status' => true,
                        'message' => 'verification successfully',
                        'response' => null], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'The OTP Expired!',
                        'response' => null], 401);
                }
            }

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => "Server Error. " . $e->getMessage(),
                'response' => $validator->errors()], 500);
        }

    }

    public function forgetPassword(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Plese check all the required parameter',
                'response' => $validator->errors()], 422);
        }

        if ($request->input('type') === 'email') {
            $customers = Contact::where('email', $request->input('value'))->first();
            if (!$customers) {
                return response()->json([
                    'status' => true,
                    'message' => 'This Customer not exist!',
                    'response' => null], 404);
            } else {
                $verificationOTP = VerificationOTP::where('user_id', $customers->id)->latest()->first();
                if ($verificationOTP) {
                    $now = Carbon::now();
                    if ($verificationOTP && $now->isBefore($verificationOTP->expire_at)) { //Return Old OTP If Not expired
                        return response()->json([
                            'status' => true,
                            'message' => 'Verification OTP',
                            'response' => $verificationOTP], 200);
                    } else { //Delete Old OTP If Exist
                        VerificationOTP::where('user_id', $customers->id)->delete();
                        // Create a New OTP
                        $otp = rand(123456, 999999);

                        $code = VerificationOTP::create([
                            'user_id' => $customers->id,
                            'otp' => $otp,
                            'expire_at' => Carbon::now()->addMinutes(5)
                        ]);

                        return response()->json([
                            'status' => true,
                            'message' => 'Verification OTP',
                            'response' => $code], 200);
                    }
                } else {
                    // Create a New OTP
                    $otp = rand(123456, 999999);

                    $code = VerificationOTP::create([
                        'user_id' => $customers->id,
                        'otp' => $otp,
                        'expire_at' => Carbon::now()->addMinutes(5)
                    ]);

                    return response()->json([
                        'status' => true,
                        'message' => 'Verification OTP',
                        'response' => $code], 200);
                }
            }

        } else if ($request->input('type') === 'mobile') {
            $customers = Contact::where('mobile', $request->input('value'))->first();
            if (!$customers) {
                return response()->json([
                    'status' => true,
                    'message' => 'This Customer not exist!',
                    'response' => null], 404);
            } else {
                $verificationOTP = VerificationOTP::where('user_id', $customers->id)->latest()->first();

                if ($verificationOTP) {
                    $now = Carbon::now();
                    if ($verificationOTP && $now->isBefore($verificationOTP->expire_at)) { //Return Old OTP If Not expired
                        return response()->json([
                            'status' => true,
                            'message' => 'Verification OTP',
                            'response' => $verificationOTP], 200);
                    } else { //Delete Old OTP If Exist
                        VerificationOTP::where('user_id', $customers->id)->delete();
                        // Create a New OTP
                        $otp = rand(123456, 999999);

                        $code = VerificationOTP::create([
                            'user_id' => $customers->id,
                            'otp' => $otp,
                            'expire_at' => Carbon::now()->addMinutes(5)
                        ]);

                        return response()->json([
                            'status' => true,
                            'message' => 'Verification OTP',
                            'response' => $code], 200);
                    }
                } else {
                    // Create a New OTP
                    $otp = rand(123456, 999999);

                    $code = VerificationOTP::create([
                        'user_id' => $customers->id,
                        'otp' => $otp,
                        'expire_at' => Carbon::now()->addMinutes(5)
                    ]);

                    return response()->json([
                        'status' => true,
                        'message' => 'Verification OTP',
                        'response' => $code], 200);
                }
            }
        }
    }

    public function forgetPasswordVerificationOTP(Request $request)
    {
        $input = $request->all();

        // Validation
        $validator = Validator::make($request->all(), [
            'value' => 'required',
            'otp' => 'required',
            'password' => 'required|'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Plese check all the required parameter',
                'response' => $validator->errors()], 422);
        }

        $now = Carbon::now();


        if ($input['type'] === 'email') {
            $user = Contact::where('email', $input['value'])->first();
            $verificationOTP = VerificationOTP::where('user_id', $user->id)->where('otp', $input['otp'])->latest()->first();

            if ($user && $verificationOTP && $now->isBefore($verificationOTP->expire_at)) {
                $user->password = Hash::make($input['password']);
                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Password Has changed Successfully',
                    'response' => $user], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Verification OTP expired or customer not exist',
                    'response' => null], 200);
            }

        } else if ($input['type'] === 'mobile') {
            $user = Contact::where('mobile', $input['value'])->first();
            $verificationOTP = VerificationOTP::where('user_id', $user->id)->where('otp', $input['otp'])->latest()->first();

            if ($user && $verificationOTP && $now->isBefore($verificationOTP->expire_at)) {
                $user->password = Hash::make($input['password']);
                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Password Has changed Successfully',
                    'response' => $user], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Verification OTP expired or customer not exist',
                    'response' => null], 404);
            }
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Error',
                'response' => null], 404);
        }
    }
}
