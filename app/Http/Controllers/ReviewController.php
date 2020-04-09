<?php

namespace App\Http\Controllers;

use App\review;
use App\Http\Resources\ReviewResource as ReviewRes;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //View all reviews
        $reviews = review::orderBy('id','desc')
         ->select('id','name','url','note')
         ->paginate(6);

        return ReviewRes::collection($reviews);
    }
}
