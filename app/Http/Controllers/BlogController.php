<?php

namespace App\Http\Controllers;

use App\blog;
use App\Http\Resources\blogResource as BlogRes;
use Illuminate\Http\Request;

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
        $posts = blogs::orderBy('id','desc')
         ->select('id','title','title_slug','image_name','description')
         ->paginate(6);

        return BlogRes::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Validate the requests...
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:blogs',
            //'state' => 'required|string|max:12',
        ]);

        // get requests...
        $name = $request->input('name');
        $email = $request->input('email');
       // $state = $request->input('state');

        $save = new blogs;

        $save->name = $name;
        $save->email = $email;
        $save->state = 'active';

        $save->save();

        return 1;
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$slug)
    {
        //View one blog post
        $post = blog::findorfail($id);
                                   
        return new BlogRes($post);
    }

}
