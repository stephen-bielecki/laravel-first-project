<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Mail\ProjectCreated;

class ProjectsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $projects = Project::where('author_id', auth()->id())->get();
        // dump($projects);
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project){
        $this->authorize('owns', $project);
        // abort_unless(\Gate::allows('owns', $project), 403);
        return view('projects.show', compact('project'));
    }

    public function create(){
        return view('projects.create');
    }

    public function edit(Project $project){
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project){
        $project->update(request(['title', 'description']));
        return redirect('/projects');
    }

    public function destroy(Project $project){
        $project->delete();
        return redirect('/projects');
    }

    public function store(){
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);

        $attributes['author_id'] = auth()->id();

        $project = Project::create($attributes);
        
        \Mail::to('sbielecki416@gmail.com')->send(
            new ProjectCreated($project)
        );
        
        return redirect('/projects');
    }

}
