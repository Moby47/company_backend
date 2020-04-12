<?php

namespace App\Http\Controllers;

use App\project;
use App\blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $res =project::orderby('id','desc')->select('id','name','url')->get();
        $result =blog::orderby('id','desc')->paginate(6);
        return view('home')->with('result',$result)->with('res',$res);
    }
}
