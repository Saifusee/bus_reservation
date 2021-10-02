<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Object_;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\UserEmailVerificationMail;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function authenticate(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['errors' => ['err' => ['INVALID E-MAIL & PASSWORD']]], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['errors' => ['err' => ['SOMETHING WENT WRONG, TRY AGAIN LATER.']]], 500);
        }
        $user = User::where('email', $request->email)->first();
        $id = $user->id;
        return response()->json(compact('token', 'id'));
    }

    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);
        $id = $user->id;
        Mail::to($request->email)->send(new UserEmailVerificationMail($user->id, $user->name));
        return response()->json(compact('id','token'),201);
    }

    public function getAuthenticatedUser()
        {
                try {

                        if (! $user = JWTAuth::parseToken()->authenticate()) {
                                return response()->json(['user_not_found'], 422);
                        }

                } catch (TokenExpiredException $e) {

                        return response()->json(['token_expired'], 422); //$e->getStatusCode()

                } catch (TokenInvalidException $e) {

                        return response()->json(['token_invalid'], 422);

                } catch (JWTException $e) {

                        return response()->json(['token_absent'], 422);

                }

                return response()->json(compact('user'));
        }

        public function verifyEmail ($user_id, $token)
        {
            try {
                $user = User::findOrFail($user_id);
                if ($user->remember_token == $token)
                {
                    $user->email_verified = true;
                    $user->save();
                    return response()->json("E-Mail Verified", 200);
                }
                else
                {
                    return response()->json("E-Mail Verification Failed", 422);
                }
            }
            catch (Exception $e) {

                return response()->json("E-Mail Verification Failed", 422);
            }

        }

        public function resendEmail (Request $request, $user_id)
        {
                $user = User::findOrFail($user_id);
                Mail::to($user->email)->send(new UserEmailVerificationMail($user->id, $user->name));
                return response()->json($user, 200);
        }

        public function show ($user)
        {
                $user = User::findOrFail($user);
                return response()->json($user, 200);
        }

}
