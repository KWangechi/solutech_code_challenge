<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();

        if (!$statuses) {
            return response()->json([
                'status' => false,
                'message' => 'Statuses not found!!!',
                'status_code' => HttpFoundationResponse::HTTP_NOT_FOUND,
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Statuses Found!!!',
                'status_code' => HttpFoundationResponse::HTTP_FOUND,
                'data' => $statuses
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
                'name' => 'required'
            ]);

            $status = Status::create([
                'name' => $request->name
            ]);

            if (!$status) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error while creating a new Status',
                    'status_code' => HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => $status
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Status creation successful!!!',
                    'status_code' => HttpFoundationResponse::HTTP_CREATED,
                    'data' => $status
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * Display the specified resource.
     * @param {string} $id
     */
    public function show(string $id)
    {
        $status = Status::find($id);

        try {
            return response()->json([
                'status' => true,
                'message' => 'Status fetched successfully!',
                'status_code' => HttpFoundationResponse::HTTP_FOUND,
                'data' => $status
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR
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
        $status = Status::find($id);

        try {
            $request->validate([
                'name'
            ]);

            if (!$status->update($request->all())) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error while updating the status',
                    'status_code' => HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => $status
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Status Updated successfully!!',
                    'status_code' => HttpFoundationResponse::HTTP_OK,
                    'data' => $status
                ]);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Status::find($id);

        try {
            if (!$status->delete()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error while deleting the status',
                    'status_code' => HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Status Deleted successfully!!',
                    'status_code' => HttpFoundationResponse::HTTP_OK
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'status_code' => HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }

    }
}
