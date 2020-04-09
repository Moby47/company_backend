<?php

namespace App\Http\Controllers;

use App\project;
use App\Http\Resources\ProjectResource as ProjectRes;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //View all projects
        $projects = project::orderBy('id','desc')
         ->select('id','name','url','image_name')
         ->paginate(6);

        return ProjectRes::collection($projects);
    }

    public function project_count()
    {
        //counts projects
       return  $projects = project::all()->count();
    }
}
