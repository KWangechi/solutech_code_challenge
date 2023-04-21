<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
                    'status' => false,
                    'message' => 'Error while creating new User!',
                    'status_code' => Response::HTTP_REQUEST_TIMEOUT,
                    'data' => []
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'New User Registered Successfully',
                    'token' => $user->createToken('api_token')->plainTextToken,
                    'status_code' => Response::HTTP_CREATED,
                    'data' => $user
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
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
                    'status_code' => Response::HTTP_NOT_FOUND,
                ]);
            } else {
                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => true,
                    'message' => 'User Login Successful!',
                    'token' => $user->createToken('api_token')->plainTextToken,
                    'status_code' => Response::HTTP_FOUND,
                    'data' => $user
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }
    }

    public function getUsers()
    {
        $users = User::all();

        if (!$users) {
            return response()->json([
                'status' => false,
                'message' => 'Users not found',
                'status_code' => Response::HTTP_NOT_FOUND,
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Users found',
                'status_code' => Response::HTTP_FOUND,
                'data' => $users
            ]);
        }
    }

    public function logout()
    {

        try {
            Auth::logout();

            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully!!!',
                'status_code' => Response::HTTP_OK,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }
    }
}
