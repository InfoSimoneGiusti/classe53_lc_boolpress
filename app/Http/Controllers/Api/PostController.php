<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$posts = Post::with(['category'])->get(); //Laravel risolve per noi la relation con category

        $posts = Post::where('title', 'LIKE', 'Antipasto toscano')->paginate(2);

        return response()->json(
            [
                'results' => $posts,
                'success' => true
            ]
        );

    }

}










