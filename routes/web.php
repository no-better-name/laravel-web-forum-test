<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/sections', [SectionController::class, 'index'])->name('section.list');
Route::get('/sections/{id}/posts', [SectionController::class, 'show'])->name('section.post.list');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('/posts', [PostController::class, 'index'])->name('post.list');
Route::get('/comments', [CommentController::class, 'index'])->name('comment.list');
Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');

Route::redirect('/', '/sections');
Route::redirect('/sections/{id}', '/sections/{id}/posts');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
