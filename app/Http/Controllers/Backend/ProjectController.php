<?php

namespace App\Http\Controllers\Backend;

use App\Models\Skill;
use App\Models\Projects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function index(){
        $projects=Projects::all();
        return view('projects.index',compact('projects'));
    }

    public function create(){
        $skills=Skill::all();
        //compact es como mandar $skills a vista
        return view('projects.create',compact('skills'));
    }

    public function store(StoreProjectRequest $request){
        if($request->hasFile('image')){
            $image=$request->file('image')->store('projects');

            Projects::create([
                'skill_id'=>$request->skill_id,
                'name'=>$request->name,
                'project_url'=>$request->project_url,
                'image'=>$image
            ]);
            return to_route('projects.index')->with('success','Project created.');
        }
        return back();
    }

    public function edit(Projects $project){
        $skills=Skill::all();
        return view('projects.edit',compact('project','skills'));
    }

    public function update(UpdateProjectRequest $request,Projects $project){
        $image=$project->image;

        if($request->hasFile('image')){
            Storage::delete($project->image);
            $image=$request->file('image')->store('projects');
        }
        $project->update([
            'skill_id'=>$request->skill_id,
            'name'=>$request->name,
            'project_url'=>$request->project_url,
            'image'=>$image
        ]);

        return to_route('projects.index')->with('success','Project update.');
    }

    public function destroy(Projects $project){
        Storage::delete($project->image);
        $project->delete();
        return back()->with('danger','Project deleted.');
    }

}
