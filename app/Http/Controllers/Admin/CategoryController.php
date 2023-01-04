<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index() {
        $categories=Category::all();
        return view('admin/categories/list-categories', compact('categories'));
    }

    public function create() {
        $category = new Category();
        return view('admin/categories/create-category', compact('category'));
    }

    public function store(Request $request) {
        $request->validate(
            [
                'title'=>['required', 'min:3','unique:categories,title',],
                'slug'=>['required', 'min:3',],
            ]);
        Category::create($request->all());
        return redirect()->route('admin.categories');
    }


    public function edit($id) {
        $category=Category::find($id);
        return view('admin/categories/update-category', compact('category'));
    }

    public function update(Request $request, $id) {
        $category=Category::find($id);
        $request->validate(
            [
                'title'=>['required', 'min:3', Rule::unique('categories', 'title')->ignore($category->id)],
                'slug'=>['required', 'min:3',],
            ]);
        $category->update($request->all());
        return redirect()->route('admin.categories');
    }

    public function destroy($id) {
        $category=Category::find($id);
        if(Post::where('category_id', $id)->first()) {
            $categories=Category::all();
            $messageError=true;
            return view('admin/categories/list-categories', compact('categories','messageError'));
        } else {
            $category->delete();
            return redirect()->route('admin.categories');
        }
    }

    public function trash() {
        $categories=Category::onlyTrashed()->get();
        return view('admin/categories/trash', compact('categories'));
    }

    public function restore($id) {
        Category::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.categories');
    }

    public function delete($id) {
        Category::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.categories.trash');
    }
}
