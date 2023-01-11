<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'tags', 'category'])->get();
        return view('admin/posts/list-posts', compact('posts'));
    }

    public function show($id)
    {
        /*$post=Post::find($id);
        $comments=Comment::all();
        return view('admin/posts/show', compact('post', 'comments'));*/

        $posts = Post::with(['user', 'tags', 'category', 'comments'])->where('id', $id)->get();
        return view('admin/posts/show', compact('posts'));
    }

    public function create() {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        return view('admin/posts/create-post', compact('post', 'categories', 'tags', 'users'));
    }

    public function store(Request $request) {
        $request->validate(
            [
                'title'=>['required', 'min:3','unique:posts,title',],
                'slug'=>['required', 'min:3',],
                'body'=>['required', 'min:3',],
                'user_id'=>['required', 'exists:users,id'],
                'category_id'=>['required', 'exists:categories,id'],
                'tags'=>['exists:tags,id'],
            ]);
        $post=Post::create($request->all());
        $post->tags()->attach($request->tags);
        return redirect()->route('admin.posts');
    }


    public function edit($id) {
        $post=Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        return view('admin/posts/update-post', compact('post', 'categories', 'tags', 'users'));
    }

    public function update(Request $request, $id) {
        $post=Post::find($id);
        $request->validate(
            [
                'title'=>['required', 'min:3', Rule::unique('posts', 'title')->ignore($post->id)],
                'slug'=>['required', 'min:3',],
                'body'=>['required', 'min:3',],
                'user_id'=>['required', 'exists:users,id'],
                'category_id'=>['required', 'exists:categories,id'],
                'tags'=>['exists:tags,id'],
            ]);
        $post->update($request->all());
        $post->tags()->sync($request->tags);
        return redirect()->route('admin.posts');

    }

    public function destroy($id) {
        $post=Post::find($id);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts');
    }

    public function trash() {
        $posts=Post::onlyTrashed()->with(['user', 'tags', 'category'])->get();
        return view('admin/posts/trash', compact('posts'));
    }

    public function restore($id) {
        Post::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.posts');
    }

    public function delete($id) {
        Post::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.posts');
    }

    public function addComment(Request $request, $id) {
        $request->validate(
            [
                'body'=>['required', 'min:3',],
            ]);
        $comment = new Comment();
        $comment->body = $request->input('body');
        Post::find($id)->comments()->save($comment);

        return redirect()->route('admin.posts.show', ['id'=>$id]);
    }
}
