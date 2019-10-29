<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProjectRequest;
use App\Project;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Utils;

class ProjectController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['auth' => 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // User cannot view any project if not authenticated
        $this->authorize('viewAny', Project::class);

        // Return index view with projects sorted by recent
        return view('projects.index', [
            'projects' => Project::latest('id')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // User cannot create any project if not authenticated
        $this->authorize('create', Project::class);

        // Return create view with an empty instance of Project Model to reuse the project form
        return view('projects.create', [
            'project' => new Project()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProjectRequest $request)
    {
        // User cannot store any project on database if not authenticated
        $this->authorize('create', Project::class);

        // Create a new Project instance
        $project = new Project();
        $project->title = $request->title;
        $project->slug = Utils::generateSlug($project->title);
        $project->user_id = Auth::user()->id;

        // Save the object on database
        $project->save();

        // Redirect to show view
        return redirect()->route('projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // User cannot see the project details if he didn't create it
        $this->authorize('view', $project);

        // Return the show view with the corresponding project
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        // User cannot edit any project if he didn't create it
        $this->authorize('update', $project);

        // Return the edit view with the corresponding project
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(SaveProjectRequest $request, Project $project)
    {
        // User cannot update any project from database if he didn't create it
        $this->authorize('update', $project);

        // Update the values
        $project->title = $request->title;
        $project->slug = Utils::generateSlug($project->title);

        // Save changes
        $project->update();

        // Redirect to show view
        return redirect()->route('projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // User cannot delete any project if he didn't create it
        $this->authorize('delete', $project);

        //Remove project from database
        $project->delete();

        // Redirect to projects index view
        return redirect()->route('projects.index')
                        ->with('message', __());
    }
}
