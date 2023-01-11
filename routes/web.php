<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('main');

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/category/{category}', [PostController::class, 'category'])->name('category'); //пости певної категорії
Route::get('/tag/{tag}', [PostController::class, 'tag'])->name('tag'); //пости з певним тегом
Route::get('/author/{author}', [PostController::class, 'user'])->name('author'); //пости певного автора
Route::get('/author/{author}/category/{category}', [PostController::class, 'userCategory'])->name('author.category'); //пости з певним автором та категорією
Route::get('/author/{author}/category/{category}/tag/{tag}', [PostController::class, 'userCategoryTag'])->name('author.category.tag'); //пости з певним автором, категорією та тегами

Route::middleware(['guest'])->group(function () {
    Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'handleLogin'])->name('admin.handle.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/admin', [PageController::class, 'index'])->name('admin.panel');
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/admin/categories/{id}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::get('/admin/categories/{id}/delete', [CategoryController::class, 'delete'])->name('admin.categories.destroy');
    Route::get('/admin/categories/trash', [CategoryController::class, 'trash'])->name('admin.categories.trash');
    Route::get('/admin/categories/{id}/restore', [CategoryController::class, 'restore'])->name('admin.categories.restore');
    Route::get('/admin/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('admin.categories.delete');

    Route::get('/admin/tags', [TagController::class, 'index'])->name('admin.tags');
    Route::get('/admin/tags/create', [TagController::class, 'create'])->name('admin.tags.create');
    Route::post('/admin/tags/store', [TagController::class, 'store'])->name('admin.tags.store');
    Route::get('/admin/tags/{id}/edit', [TagController::class, 'edit'])->name('admin.tags.edit');
    Route::post('/admin/tags/{id}/update', [TagController::class, 'update'])->name('admin.tags.update');
    Route::get('/admin/tags/{id}/delete', [TagController::class, 'destroy'])->name('admin.tags.destroy');
    Route::get('/admin/tags/trash', [TagController::class, 'trash'])->name('admin.tags.trash');
    Route::get('/admin/tags/{id}/restore', [TagController::class, 'restore'])->name('admin.tags.restore');
    Route::get('/admin/tags/{id}/force-delete', [TagController::class, 'delete'])->name('admin.tags.delete');

    Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts');
    Route::get('/admin/posts/{id}', [AdminPostController::class, 'show'])->name('admin.posts.show');
    Route::get('/admin/posts/{id}/add-comment', [AdminPostController::class, 'addComment'])->name('admin.posts.comment.add');
    Route::post('/admin/posts/{id}/add-comment', [AdminPostController::class, 'addComment'])->name('admin.posts.comment.add');
    Route::get('/admin/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts/store', [AdminPostController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/posts/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::post('/admin/posts/{id}/update', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::get('/admin/posts/{id}/delete', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/admin/posts/trash', [AdminPostController::class, 'trash'])->name('admin.posts.trash');
    Route::get('/admin/posts/{id}/restore', [AdminPostController::class, 'restore'])->name('admin.posts.restore');
    Route::get('/admin/posts/{id}/force-delete', [AdminPostController::class, 'delete'])->name('admin.posts.delete');
});





