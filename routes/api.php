<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterUserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/v1/auth/register', [RegisterUserController::class, 'createUser'])->name('user.register');
Route::post('/v1/auth/login', [RegisterUserController::class, 'loginUser'])->name('user.login');

Route::get('/v1/users', [RegisterUserController::class, 'getUsers'])->name('user.users');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
