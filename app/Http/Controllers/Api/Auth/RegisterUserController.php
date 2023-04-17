<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class RegisterUserController extends Controller
{
    public function createUser(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            if (!$user) {
                return response()->json([
                    'status' => HttpFoundationResponse::HTTP_REQUEST_TIMEOUT,
                    'message' => 'Error while creating new User!',
                    'data' => []
                ]);
            } else {
                return response()->json([
                    'status' => HttpFoundationResponse::HTTP_CREATED,
                    'message' => 'New User Registered Successfully',
                    'token' => $user->createToken('api_token')->plainTextToken,
                    'data' => $user
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function loginUser(Request $request)
    {
        // validate the login request
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email Address or Password not Found!! Try again',
                    'status_code' => HttpFoundationResponse::HTTP_NOT_FOUND,
                ]);

            } else {
                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => HttpFoundationResponse::HTTP_FOUND,
                    'message' => 'User Login Successful!',
                    'token' => $user->createToken('api_token')->plainTextToken,
                    'data' => $user
                ]);

            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $th->getMessage(),
            ]);
        }
        // dd($request);
    }

    public function getUsers() {
        $users = User::all();

        if (!$users) {
            return response()->json([
                'status' => false,
                'message' => 'Users not found',
                'status_code' => HttpFoundationResponse::HTTP_NOT_FOUND,
                'data' => []
            ]);

        }
        else {
            return response()->json([
                'status' => true,
                'message' => 'Users found',
                'status_code' => HttpFoundationResponse::HTTP_FOUND,
                'data' => $users
            ]);
        }
    }
}
