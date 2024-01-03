<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with('hashtags')->paginate(100);

        return response()->json([
            'success' => true,
            'results' => $posts,
        ]);
    }
}
