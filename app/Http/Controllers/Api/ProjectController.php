<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categoryId = $request->query('category');

        $query = Project::with('category', 'tags');


        if ($categoryId) {
            $query = $query->where('category_id', $categoryId);
        }

        $projects = $query->paginate(60);



        return response()->json([
            'success'   => true,
            'results'   => $projects,
        ]);
    }


}