<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterUserController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserTaskController;
use App\Models\UserTask;

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
// Auhentication
Route::prefix('v1')->group(function () {
    Route::post('auth/register', [RegisterUserController::class, 'createUser'])->name('user.register');
    Route::post('auth/login', [RegisterUserController::class, 'loginUser'])->name('user.login');

    Route::get('/taskUsers', [UserTaskController::class, 'taskUsers'])->name('task.users');

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('auth/logout', [RegisterUserController::class, 'logout'])->name('user.logout');

        Route::get('user', function(Request $request) {
            return $request->user();
        });

        Route::get('users', [RegisterUserController::class, 'getUsers'])->name('user.users');

        // Status CRUD
        // Route::apiResource('/v1/status', StatusController::class);
        Route::get('status', [StatusController::class, 'index']);
        Route::post('status', [StatusController::class, 'store']);
        Route::get('status/{id}', [StatusController::class, 'edit']);
        Route::patch('status/{id}', [StatusController::class, 'update']);
        Route::delete('status/{id}', [StatusController::class, 'destroy']);



        // Tasks CRUD
        // Route::apiResource('/v1/status', TaskController::class);
        Route::get('tasks', [TaskController::class, 'index']);
        Route::post('tasks', [TaskController::class, 'store']);
        Route::patch('tasks/{id}', [TaskController::class, 'update']);
        Route::delete('tasks/{id}', [TaskController::class, 'destroy']);


        // User Tasks CRUD
        // Route::apiResource('/v1/status', UserTaskController::class);
        Route::get('user_tasks', [UserTaskController::class, 'index']);
        Route::post('user_tasks', [UserTaskController::class, 'store']);
        Route::patch('user_tasks/{id}', [UserTaskController::class, 'update']);
        Route::delete('user_tasks/{id}', [UserTaskController::class, 'destroy']);
    });
});
