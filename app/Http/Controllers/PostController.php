<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Admin\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();
        return view('posts/index', compact('posts', 'tags'));
    }

    public function user($id)
    {
        $tags = Tag::all();
        $user = User::find($id);
        $posts = Post::all()->where('user_id', $id);
        return view('posts/index', compact('user', 'posts', 'tags'));
    }

    public function category($id)
    {
        $tags = Tag::all();
        $category = Category::find($id);
        $posts = Post::all()->where('category_id', $id);
        return view('posts/index', compact('category', 'posts', 'tags'));
    }

    public function tag($id)
    {
        $tags = Tag::all();
        $tag = Tag::find($id);
        $posts = Post::whereHas('tags', function (Builder $post) use ($id) {
            $post->where('tag_id', $id);
        })->get();
        return view('posts/index', compact('tag', 'posts', 'tags'));
    }

    public function userCategory($idAuthor, $idCategory)
    {
        $user = User::find($idAuthor);
        $category = Category::find($idCategory);
        $tags = Tag::all();
        $posts=Post::all()->where('category_id', $idCategory)->where('user_id', $idAuthor);
        return view('posts/index', compact('posts', 'user', 'category', 'tags'));
    }

    public function userCategoryTag($idAuthor, $idCategory, $idTag)
    {
        $tags = Tag::all();
        $user = User::find($idAuthor);
        $category = Category::find($idCategory);
        $tag = Tag::find($idTag);
        $posts=Post::all()->where('category_id', $idCategory)->where('user_id', $idAuthor);
        return view('posts/index', compact('posts', 'user', 'category', 'tag', 'tags'));
    }
}
