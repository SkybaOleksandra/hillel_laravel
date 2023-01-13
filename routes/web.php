<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Oauth\GithubController;
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
Route::get('/oauth/github/callback', GithubController::class)->name('oauth.github.callback');


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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/', [PageController::class, 'index'])->name('admin.panel');
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/{id}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/{id}/delete', [CategoryController::class, 'delete'])->name('admin.categories.destroy');
        Route::get('/trash', [CategoryController::class, 'trash'])->name('admin.categories.trash');
        Route::get('/{id}/restore', [CategoryController::class, 'restore'])->name('admin.categories.restore');
        Route::get('/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('admin.categories.delete');
    });
    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('admin.tags');
        Route::get('/create', [TagController::class, 'create'])->name('admin.tags.create');
        Route::post('/store', [TagController::class, 'store'])->name('admin.tags.store');
        Route::get('/{id}/edit', [TagController::class, 'edit'])->name('admin.tags.edit');
        Route::post('/{id}/update', [TagController::class, 'update'])->name('admin.tags.update');
        Route::get('/{id}/delete', [TagController::class, 'destroy'])->name('admin.tags.destroy');
        Route::get('/trash', [TagController::class, 'trash'])->name('admin.tags.trash');
        Route::get('/{id}/restore', [TagController::class, 'restore'])->name('admin.tags.restore');
        Route::get('/{id}/force-delete', [TagController::class, 'delete'])->name('admin.tags.delete');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [AdminPostController::class, 'index'])->name('admin.posts');
        Route::get('/{id}', [AdminPostController::class, 'show'])->name('admin.posts.show');
        Route::get('/{id}/add-comment', [AdminPostController::class, 'addComment'])->name('admin.posts.comment.add');
        Route::post('/{id}/add-comment', [AdminPostController::class, 'addComment'])->name('admin.posts.comment.add');
        Route::get('/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
        Route::post('/store', [AdminPostController::class, 'store'])->name('admin.posts.store');
        Route::get('/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
        Route::post('/{id}/update', [AdminPostController::class, 'update'])->name('admin.posts.update');
        Route::get('/{id}/delete', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
        Route::get('/trash', [AdminPostController::class, 'trash'])->name('admin.posts.trash');
        Route::get('/{id}/restore', [AdminPostController::class, 'restore'])->name('admin.posts.restore');
        Route::get('/{id}/force-delete', [AdminPostController::class, 'delete'])->name('admin.posts.delete');
    });
});





