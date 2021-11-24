<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class ApiController extends Controller
{
    public function index()
    {
        $posts = Post::select('*')->with(['category', 'user'])->get();
        
        return $posts;
    }
}
