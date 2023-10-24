<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'posts' => Post::with('category')->latest()->get()
        ];
        return view('admin.posts.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'categories' => Category::get()
        ];
        return view('admin.posts.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'desc'=>'required',
            'price'=>'required',
            'image'=>'image|mimes:jpg,png,bmp,jpeg,webp',
            'category_id'=>'required'
        ]);
        $file = $request->file('image');
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        if (!$file) {
            $namafile = "default.webp";
        } else {
            if (!Storage::exists('/public/posts')) {
                Storage::makeDirectory('public/posts', 0775, true);
            }
            $namafile =  $file->hashName();
            $img = Image::make($file->path());
            $img->resize(1080, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(Storage::path('public/posts/' . $namafile));
        }
        $save=Post::create([
            'title'=>$request->title,
            'slug'=>$slug,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            'desc'=>$request->desc,
            'status'=>'Pending',
            'image'=>$namafile
        ]);
        if($save){
            return redirect()->route('posts.index')->with('success','Data berhasil ditambahkan');
        }else{
            return redirect()->route('posts.index')->with('failed','Data gagal ditambahkan');

        }
    }

    public function show(Post $post)
    {
        $data = [
            'title' => 'Detail Produk',
            'posts' => $post->load('category'),
            'categories'=>Category::get()
        ];

        return view('admin.posts.detail', $data);
    }

    public function edit(Post $post)
    {
        $data = [
            'title' => 'Detail Produk',
            'post' => $post,
            'categories' => Category::all()
        ];

        return view('admin.posts.edit', $data);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required',
            'desc'=>'required',
            'price'=>'required',
            'image'=>'image|mimes:jpg,png,bmp,jpeg,webp'
        ]);
        $file = $request->file('image');
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        if (!$file) {
            $namafile = $post->image;
        } else {
            if (!Storage::exists('/public/posts')) {
                Storage::makeDirectory('public/posts', 0775, true);
            }
            $namafile =  $file->hashName();
            $img = Image::make($file->path());
            $img->resize(1080, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::delete('public/post/' . $post->image);
            $img->save(Storage::path('public/posts/' . $namafile));
        }
        $update=Post::where('id',$post->id)->update([
            'title'=>$request->title,
            'slug'=>$slug,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            'desc'=>$request->desc,
            'status'=>'active',
            'image'=>$namafile
        ]);
        if($update){
            return redirect()->route('posts.index')->with('success','Data berhasil diupdate');
        }else{
            return redirect()->route('posts.index')->with('failed','Data gagal diupdate');

        }
    }

    public function destroy(Post $post)
    {
        $delete = $post->delete();
        if ($delete) {
            Storage::delete('public/post/' . $post->image);
            return redirect()->route('posts.index')->with('success', 'Data Berhasil dihapus');
        } else {
            return redirect()->route('posts.index')->with('failed', 'Data Gagal dihapus');
        }
    }


    public function categories()
    {
        $data = [
            'title' => 'List Categories',
            'categories' => Category::get()
        ];
        return view('admin.posts.categories', $data);
    }

    public function save_category(Request $request)
    {
        $request->validate([
            'category' => 'required'
        ]);
        $save = Category::create([
            'category' => $request->category
        ]);
        if ($save) {
            return redirect()->route('categories.index')->with('success', 'Data was added');
        } else {
            return redirect()->route('categories.index')->with('failed', 'Data was failed to add');
        }
    }
    public function delete_category(Category $category)
    {
        $delete = $category->delete();
        if ($delete) {
            return redirect()->route('categories.index')->with('success', 'Data was deleted');
        } else {
            return redirect()->route('categories.index')->with('failed', 'Data was failed to delete');
        }
    }
}
