<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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

Route::get('/', [PostController::class, 'index']);
Route::get('/author/{author}', [PostController::class, 'user']);
Route::get('/category/{category}', [PostController::class, 'category']);
Route::get('/author/{author}/category/{category}', [PostController::class, 'userCategory']);
