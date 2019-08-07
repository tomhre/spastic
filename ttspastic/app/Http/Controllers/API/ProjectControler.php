<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\projects\Project;

class ProjectController extends Controller
{

    public function index()
    {
        return Project::all();
    }
    
    public function store(Request $request)
    {
        return Project::create($request->validated());
    }
}