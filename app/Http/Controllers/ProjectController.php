<?php

namespace App\Http\Controllers;

use App\project;
use App\Http\Resources\ProjectResource as ProjectRes;
use Illuminate\Http\Request;

//storage library
use Illuminate\Support\Facades\Storage;

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


    public function addProject(Request $request)
    {
        // Validate the requests...
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'picture' => 'required|image',
            'url' => 'required|string|max:1500',
        ]);

        // get requests...
        $name = $request->input('name');
        $url = $request->input('url');

             //.................compression algorithm...............//
  
             if($request->hasfile('picture')){
     
             //get filename with extension
             $filenamewithextension = $request->file('picture')->getClientOriginalName();
     
             //get filename without extension
             $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
     
             //get file extension
             $extension = $request->file('picture')->getClientOriginalExtension();
     
             //filename to store
             $filenametostore = $filename.'_'.time().'.'.$extension;
     
                 $request->file('picture')->storeAs('public/project', $filenametostore);
         
               
         }else{
             $filenametostore = 'noimage.jpg';
         }
     
         //.................compression algorithm...............//

        $save = new project;

        $save->name = $name;
        $save->url = $url;
        $save->image_name = $filenametostore;

        $save->save();

        return redirect()->route('home')->with('added', 'Successful!');
        
    }


     //Not API
     public function getProjects()
     {
         $res =project::orderby('id','desc')->select('id','name','url')->get();
         return view('home')->with('res',$res);
     }
 
 
 
     /** NOT API
      * Delete the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function deleteProject($id)
     {
         //View one project post
         $del = project::findorfail($id);
                                    
        $del->delete();
 
        if($del->image_name != 'noimage.jpg'){
         //delete image file
         Storage::delete('public/project/'.$del->image_name);
     }
 
         return redirect()->route('home')->with('deleted2', 'Successful!');
 
     }

}
