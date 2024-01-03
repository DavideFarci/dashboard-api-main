<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    private $validations = [
        'name'          => 'required|string|min:2|max:100',

    ];

    public function index()
    {
        $projects = Project::paginate(25);

        return view('admin.projects.index', compact('projects'));
    }
    
    
    public function create()
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.projects.create', compact('categories', 'tags') );
    }


    public function store(Request $request)
    {
        
        $request->validate($this->validations);
    
        $data = $request->all();

        $newProject = new Project();
    
        if (isset($data['image'])) {
            $imagePath = Storage::put('public/uploads', $data['image']);
            $newProject->image = $imagePath;
        } 

        
        $newProject->name          = $data['name'];
        $newProject->price         = $data['price'];
        $newProject->counter       = 0;
        $newProject->slug          = Str::slug($data['name']);
        $newProject->category_id   = $data['category_id'];

        $newProject->save();
        
        $newProject->tags()->sync($data['tags'] ?? []);
        
		return redirect()->route('admin.projects.index', ['project']);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.show', compact('project'));
    }
    


    public function edit($slug)
    {
        
        $project = Project::where('slug', $slug)->firstOrFail();

        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.projects.edit', compact('project', 'categories', 'tags'));
    }


    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        // validare i dati del form
        $request->validate($this->validations);

        $data = $request->all();

        if (isset($data['image'])) {
            // salvare l'immagine nuova
            $imagePath = Storage::put('uploads', $data['image']);

            // eliminare l'immagine vecchia
            if ($project->image) {
                Storage::delete($project->image);
            }

            // aggiormare il valore nella colonna con l'indirizzo dell'immagine nuova
            $project->image = $imagePath;
        }


        // aggiornare i dati nel db se validi
        $project->name          = $data['name'];
        $project->price         = $data['price'];
        $project->counter       = 0;
        $project->category_id   = $data['category_id'];
        $project->update();

        // associare i tag
        $project->tags()->sync($data['tags'] ?? []);

        // ridirezionare su una rotta di tipo get
        return to_route('admin.projects.show', ['project' => $project]);
    }

  
    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        $project->delete();
        return to_route('admin.projects.index')->with('delete_success', $project);
    }


    
    public function restore($id)
    {
        Project::withTrashed()->where('id', $id)->restore();

        $project = Project::find($id);

        return to_route('admin.projects.index')->with('restore_success', $project);
    }

    
    public function trashed()
    {
        $trashedProjects = Project::onlyTrashed()->paginate(10); 

        

        return view('admin.projects.trashed', compact('trashedProjects'));
    }
    public function hardDelete($id)
    {
        $project = Project::withTrashed()->find($id);
        $project->tags()->detach();
        $project->forceDelete();

        return to_route('admin.projects.trashed')->with('delete_success', $project);
    
    }
}
