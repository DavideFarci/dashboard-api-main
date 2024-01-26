<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hashtag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HashtagController extends Controller
{
    private $validations = [

        'tag' => 'required|string|min:2|max:50',
    ];

    public function index()
    {
        $hashtags = Hashtag::paginate(100);

        return view('admin.hashtags.index', compact('hashtags'));
    }


    public function create()
    {
        return view('admin.hashtags.create');
    }


    public function store(Request $request)
    {
        $request->validate($this->validations);

        $data = $request->all();

        $newhashtag = new hashtag();

        $newhashtag->tag          = $data['tag'];

        $newhashtag->save();


        return redirect()->route('admin.hashtags.index', ['hashtag']);
    }



    public function edit(hashtag $hashtag)
    {
        return view('admin.hashtags.edit', compact('hashtag'));
    }

    public function update(Request $request, hashtag $hashtag)
    {


        $data = $request->all();


        $hashtag->tag          = $data['tag'];

        $hashtag->update();


        return to_route('admin.hashtags.index', ['hashtag' => $hashtag]);
    }

    public function destroy(hashtag $hashtag)
    {
        $hashtag->posts()->detach();
        $hashtag->delete();
        return to_route('admin.hashtags.index')->with('delete_success', $hashtag);
    }
}
