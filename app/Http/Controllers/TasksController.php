<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Http\Resources\TasksResource;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
           $tasks = Tasks::all();
           $response = [
               'status' => 200,
               'message' => 'Success retrieving ALL tasks.',
               'task' => TasksResource::collection($tasks)
           ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 500,
                'message' => 'Error retrieving ALL tasks.'
            ];
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $input = $request->all();
            $tasks = Tasks::create($input);
            $response = [
                'status' => 200,
                'message' => 'Success. A new task is created.',
                'task' => new TasksResource($tasks)
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 500,
                'message' => 'Error. New task cannot be created.' . $th
            ];
        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $tasks = Tasks::findOrFail($id);
            $response = [
                'status' => 200,
                'message' => "Success. Task retrieved by ID: $id",
                'task' => new TasksResource($tasks)
        ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 500,
                'message' => 'Error. No Task found.'
            ];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $input = $request->all();
            $tasks = Tasks::findOrFail($id);
            $tasks->update($input);
            $response = [
                'status' => 200,
                'message' => 'Success! A task has been updated.',
                'task' => new TasksResource($tasks)
        ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 500,
                'message' => 'No task found with ID: ' . $id . '. No task has been updated.'
        ];
        }
        
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $tasks = Tasks::findOrFail($id);
            $tasks->delete();
            $response = [
                'status' => 200,
                'message' => 'Success! A task has been deleted.',
                'task' => new TasksResource($tasks)
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => 500,
                'message' => 'No task found with ID: ' . $id . '. No task has been deleted.',
            ];
        }
        
        return $response;
    }
}
