<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index() {
        $tags=Tag::all();
        return view('admin/tags/list-tags', compact('tags'));
    }

    public function create() {
        $tag = new Tag();
        return view('admin/tags/create-tag', compact('tag'));
    }

    public function store(Request $request) {
        $request->validate(
            [
                'title'=>['required', 'min:3','unique:tags,title',],
                'slug'=>['required', 'min:3',],
            ]);
        Tag::create($request->all());
        return redirect()->route('admin.tags');
    }


    public function edit($id) {
        $tag=Tag::find($id);
        return view('admin/tags/update-tag', compact('tag'));
    }

    public function update(Request $request, $id) {
        $tag=Tag::find($id);
        $request->validate(
            [
                'title'=>['required', 'min:3', Rule::unique('tags', 'title')->ignore($tag->id)],
                'slug'=>['required', 'min:3',],
            ]);
        $tag->update($request->all());
        return redirect()->route('admin.tags');
    }

    public function destroy($id) {
        $tag=Tag::find($id);
        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('admin.tags');
    }

    public function trash() {
        $tags=Tag::onlyTrashed()->get();
        return view('admin/tags/trash', compact('tags'));
    }

    public function restore($id) {
        Tag::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.tags');
    }

    public function delete($id) {
        Tag::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.tags.trash');
    }
}
