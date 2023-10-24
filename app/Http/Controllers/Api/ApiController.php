<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Post;
use App\Models\User;
use Validator;

class ApiController extends BaseController
{
    public function index()
    {
        $users = Post::latest()->get()->map(function ($post) {
            return [
                'title' => $post->title,
                'desc' => $post->desc,
		'price'=>number_format($post->price),
                'image' => asset('storage/posts/' . $post->image),
                'created' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d F Y')
            ];
        });
        return $this->sendResponse($users, "List Produk");
    }
    public function list_post()
    {
        $posts = Post::with('category')->get();
        return response()->json(['status' => 400, 'data' => $posts]);
    }
    public function list_users()
    {
        $users = User::get()->map(function ($user) {
            return [
                'nama' => $user->name,
                'email' => $user->email,
                'terbuat' => $user->created_at->diffForHumans()
            ];
        });
        return response()->json(['data' => $users, 'message' => 'ok', 'status' => 200]);
    }
}
