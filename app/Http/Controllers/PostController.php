<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts/index', compact('posts'));
    }

    public function user($id)
    {
        $user = User::find($id);
        $posts = Post::all()->where('user_id', $id);
        return view('posts/user-posts', compact('user', 'posts'));
    }

    public function category($id)
    {
        $category = Category::find($id);
        $posts = Post::all()->where('category_id', $id);
        return view('posts/category-posts', compact('category', 'posts'));
    }

    public function userCategory($idAuthor, $idCategory)
    {
        $user = User::find($idAuthor);
        $category = Category::find($idCategory);
        $posts=Post::all()->where('category_id', $idCategory)->where('user_id', $idAuthor);
        return view('posts/user-category', compact('posts', 'user', 'category'));
    }
}
