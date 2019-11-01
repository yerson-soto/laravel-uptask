<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }

    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
       if ($request->ajax()) {
            // Cannot get any task if not authenticated
            $this->authorize('viewAny', Task::class);

            // Get the route project
            $projectSlug = Utils::getRouteParam('project');
            $project = Project::where('slug', $projectSlug)->first();

            // Return the project tasks
            return $project->tasks;

            // return view('task-test', compact('project'));
       } else {
           $this->authorize('viewAny', $request);
       }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Cannot create a task if not authenticated
        $this->authorize('create', Task::class);

        $validation = Validator::make($request->all(), [
            'name' => [
                'required',
                'unique:tasks'
            ]
        ], [
            'name.required' => __('Add a name to your task'),
            'name.unique' => __('A task with this name already exists')
        ]);

        if ($validation->fails()) {
            return [
                'status' => 'error',
                'message' => $validation->errors()->first()
            ];
        }

        // Get the route project
        $projectSlug = Utils::getRouteParam('project');
        $project = Project::where('slug', $projectSlug)->first();

        // New task object
        $task = new Task();
        $task->name = $request->name;
        $task->project_id = $project->id;
        $task->save();

        return [
            'status' => 'success',
            'data' => $task
        ];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // User cannot update any task if didn't create the project the task belongs
        $this->authorize('update', $task);

        switch ($request->attribute) {
            case 'name':
                $validation = Validator::make($request->all(), [
                    'name' => [
                        'required',
                        Rule::unique('tasks')->ignore($task->id)
                    ]
                ], [
                    'name.required' => __('Add a name to your task'),
                    'name.unique' => __('A task with this name already exists')
                ]);

                if ($validation->fails()) {
                    return [
                        'status' => 'error',
                        'message' => $validation->errors()->first()
                    ];
                }

                $task->name = $request->name;
                break;
            case 'is_completed':
                $task->is_completed = $request->is_completed;
                break;
        }

        $task->update();

        return [
            'status' => 'success',
            'data' => $task
        ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
    {
        // User cannot delete any task if didn't create the project the task belongs
        $this->authorize('delete', $task);

        $task->delete();

        return $task;
    }

}
