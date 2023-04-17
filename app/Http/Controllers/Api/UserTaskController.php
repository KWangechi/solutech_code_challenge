<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserTask;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class UserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_tasks = UserTask::all();

        if (!$user_tasks) {
            return response()->json([
                'status' => false,
                'message' => 'User Tasks not found!!!',
                'status_code' => Response::HTTP_NOT_FOUND,
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'User Tasks Found!!!',
                'status_code' => Response::HTTP_FOUND,
                'data' => $user_tasks
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'task_id' => 'required',
                'due_date' => 'required|date',
                'start_time' => 'required|date',
                'end_time' => 'required|date',
                'remarks' => 'required',
                'status_id' => 'required'
            ]);

            $user_tasks = UserTask::create([
                'user_id' => $request->user_id,
                'task_id' => $request->task_id,
                'due_date' => $request->due_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'remarks' => $request->remarks,
                'status_id' => $request->status_id
            ]);

            if (!$user_tasks) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error while creating a new User Task',
                    'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => $user_tasks
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'User Task Created successfully!!!',
                    'status_code' => Response::HTTP_CREATED,
                    'data' => $user_tasks
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_task = UserTask::find($id);

        try {
            if (!$user_task->update($request->all())) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error while updating the user task',
                    'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => $user_task
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'User Task Updated successfully!!',
                    'status_code' => Response::HTTP_OK,
                    'data' => $user_task
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_task = UserTask::find($id);

        try {
            if (!$user_task->delete()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error while deleting the User Task',
                    'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'User Task Deleted successfully!!',
                    'status_code' => Response::HTTP_OK
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
