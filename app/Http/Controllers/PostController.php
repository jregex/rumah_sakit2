<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //
    }
    public function categories()
    {
        $data = [
            'title' => 'List Categories',
            'var' => 'category',
            'categories' => Category::get()
        ];
        return view('admin.posts.categories', $data);
    }
}
