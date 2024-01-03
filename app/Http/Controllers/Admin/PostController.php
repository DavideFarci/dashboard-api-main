<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Hashtag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $validations = [
        'title'          => 'required|string|min:3|max:100',

    ];

    public function index()
    {
        $posts = Post::paginate(25);

        return view('admin.posts.index', compact('posts'));
    }
    
    
    public function create()
    {

        $hashtags       = Hashtag::all();
        return view('admin.posts.create', compact( 'hashtags') );
    }


    public function store(Request $request)
    {
        
        $request->validate($this->validations);
    
        $data = $request->all();

        $newpost = new Post();
    
        if (isset($data['image'])) {
            $imagePath = Storage::put('public/uploads', $data['image']);
            $newpost->image = $imagePath;
        } 

        
        $newpost->title         = $data['title'];
        $newpost->description   = $data['description'];
        $newpost->link   = $data['link'];
        $newpost->save();
        
        $newpost->hashtags()->sync($data['tags'] ?? []);
        
		return redirect()->route('admin.posts.index', ['post']);
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }
    


    public function edit($id)
    {
        
        $post = Post::where('id', $id)->firstOrFail();

        $hashtags       = Hashtag::all();
        return view('admin.posts.edit', compact('post', 'hashtags'));
    }




    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->firstOrFail();

        // validare i dati del form
        $request->validate($this->validations);

        $data = $request->all();

        if (isset($data['image'])) {
            // salvare l'immagine nuova
            $imagePath = Storage::put('uploads', $data['image']);

            // eliminare l'immagine vecchia
            if ($post->image) {
                Storage::delete($post->image);
            }

            // aggiormare il valore nella colonna con l'indirizzo dell'immagine nuova
            $post->image = $imagePath;
        }


        // aggiornare i dati nel db se validi
        $post->title         = $data['title'];
        $post->description   = $data['description'];  
        $post->link   = $data['link'];  
        $post->update();

        // associare i hashtag
        $post->hashtags()->sync($data['tags'] ?? []);

        // ridirezionare su una rotta di tipo get
        return to_route('admin.posts.show', ['post' => $post]);
    }

  
    public function destroy($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        $post->hashtags()->detach();
        $post->delete();
        return to_route('admin.posts.index')->with('delete_success', $post);
    }


    
    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->restore();

        $post = Post::find($id);

        return to_route('admin.posts.index')->with('restore_success', $post);
    }

    
    public function trashed()
    {
        $trashedposts = Post::onlyTrashed()->paginate(10); 

        

        return view('admin.posts.trashed', compact('trashedposts'));
    }
    public function hardDelete($id)
    {
        $post = Post::withTrashed()->find($id);
        $post->forceDelete();

        return to_route('admin.posts.trashed')->with('delete_success', $post);
    
    }
}
