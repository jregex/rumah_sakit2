<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function list_post()
    {
        $posts = Post::with('category')->get();
        return response()->json(['status'=>400,'data'=>$posts]);
    }
}
