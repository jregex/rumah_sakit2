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
