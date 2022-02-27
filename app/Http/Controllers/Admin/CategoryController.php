<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index () {
        // dd('sono la index delle categorie');

        $categories = Category::all();

        $data = [
            'categories' => $categories
        ];

        return view('admin.categories.index', $data);

    }

    public function show ($slug) {
        // dd($slug);
        $category = Category::where('slug', '=', $slug)->first();
        $posts = $category->posts;

        // dd($posts);

        if(!$category) {
            abort('404');
        }

        $data = [
            'category' => $category,
            'posts' => $posts
        ];

        return view('admin.categories.show', $data);
    }
}
