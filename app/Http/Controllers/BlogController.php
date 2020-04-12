<?php

namespace App\Http\Controllers;

use App\blog;
use App\Http\Resources\BlogResource as BlogRes;
use Illuminate\Http\Request;
//storage library
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //View all blog posts
        $posts = blog::orderBy('id','desc')
         ->select('id','title','title_slug','image_name','description','created_at')
         ->paginate(6);

        return BlogRes::collection($posts);
    }

    /** NOt API
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_post(Request $request)
    {
        // Validate the requests...
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image',
            'description' => 'required|string|max:1500',
        ]);

        // get requests...
        $title = $request->input('title');
        $description = $request->input('description');

             //.................compression algorithm...............//
  
             if($request->hasfile('image')){
     
             //get filename with extension
             $filenamewithextension = $request->file('image')->getClientOriginalName();
     
             //get filename without extension
             $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
     
             //get file extension
             $extension = $request->file('image')->getClientOriginalExtension();
     
             //filename to store
             $filenametostore = $filename.'_'.time().'.'.$extension;
     
                 $request->file('image')->storeAs('public/blog', $filenametostore);
         
               
         }else{
             $filenametostore = 'noimage.jpg';
         }
     
         //.................compression algorithm...............//

        $save = new blog;

        $save->title = $title;
        $save->title_slug = str_slug($title, "-");
        $save->description = $description;
        $save->image_name = $filenametostore;

        $save->save();

        return redirect()->route('home')->with('posted', 'Successful!');
        
    }


    //Not API
    public function getPosts()
    {
        $result =blog::orderby('id','desc')->paginate(6);
        return view('home')->with('result',$result);
    }



    /** NOT API
     * Delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePost($id)
    {
        //View one blog post
        $del = blog::findorfail($id);
                                   
       $del->delete();

       if($del->image_name != 'noimage.jpg'){
        //delete image file
        Storage::delete('public/blog/'.$del->image_name);
    }

        return redirect()->route('home')->with('deleted', 'Successful!');

    }

}
