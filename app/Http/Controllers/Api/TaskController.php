<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        if (!$tasks) {
            return response()->json([
                'status' => false,
                'message' => 'Tasks not found!!!',
                'status_code' => Response::HTTP_NOT_FOUND,
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Tasks Found!!!',
                'status_code' => Response::HTTP_FOUND,
                'data' => $tasks
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
                'name' => 'required',
                'description' => 'required',
                'due_date' => 'required|date',
                'status_id' => 'required'
            ]);

            $task = Task::create([
                'name' => $request->name,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'status_id' => $request->status_id
            ]);

            if (!$task) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error while creating a new Task',
                    'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => $task
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Task Created successfully!!!',
                    'status_code' => Response::HTTP_CREATED,
                    'data' => $task
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
        $task = Task::find($id);

        try {
            return response()->json([
                'status' => true,
                'message' => 'Task fetched successfully!',
                'status_code' => Response::HTTP_FOUND,
                'data' => $task
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
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
        $task = Task::find($id);

        try {
            if (!$task->update($request->all())) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error while updating the task',
                    'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => $task
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Task Updated successfully!!',
                    'status_code' => Response::HTTP_OK,
                    'data' => $task
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
        $task = Task::find($id);

        try {
            if (!$task->delete()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error while deleting the task',
                    'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Task Deleted successfully!!',
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
