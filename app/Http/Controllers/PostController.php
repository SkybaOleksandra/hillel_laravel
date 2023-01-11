<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostController
{
    public function index()
    {
        $posts = Post::with(['user', 'tags', 'category'])->get();
        return view('posts/index', compact('posts'));
    }

    public function user($id)
    {
        $posts = Post::with(['tags', 'category', 'user'])->where('user_id', $id)->get();
        return view('posts/index', compact( 'posts'));
    }

    public function category($id)
    {
        $posts = Post::with(['tags', 'user', 'category'])->where('category_id', $id)->get();
        return view('posts/index', compact( 'posts'));
    }

    public function tag($id)
    {
        $posts = Post::with(['tags', 'user', 'category'])->whereHas('tags', function (Builder $post) use ($id) {
            $post->where('tag_id', $id);
        })->get();
        return view('posts/index', compact( 'posts'));
    }

    public function userCategory($idAuthor, $idCategory)
    {
        $posts = Post::with(['tags', 'user', 'category'])->whereHas('user', function (Builder $post) use ($idAuthor, $idCategory) {
            $post->where('user_id', $idAuthor);
            $post->where('category_id', $idCategory);
        })->get();
        return view('posts/index', compact( 'posts'));

    }

    public function userCategoryTag($idAuthor, $idCategory, $idTag)
    {
        $posts = Post::with(['tags', 'user', 'category'])->whereHas('tags', function (Builder $post) use ($idAuthor, $idCategory, $idTag) {
            $post->where('user_id', $idAuthor);
            $post->where('category_id', $idCategory);
            $post->where('tag_id', $idTag);
        })->get();
        return view('posts/index', compact( 'posts'));
    }
}
