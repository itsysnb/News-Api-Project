<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'v1',
    'prefix' => 'v1',
    'as' => 'v1.'
], function (){
    // Sanctum routes
    Route::post('register', [\App\Http\Controllers\Api\v1\Auth\SanctumController::class, 'register'])->name('auth.register');
    Route::post('login', [\App\Http\Controllers\Api\v1\Auth\SanctumController::class, 'login'])->name('auth.login');
});

Route::group([
    'middleware' => 'auth:sanctum',
    'namespace' => 'v1',
    'prefix' => 'v1',
    'as' => 'v1.'
],function (){
    Route::post('logout', [\App\Http\Controllers\Api\v1\Auth\SanctumController::class, 'logout'])->name('auth.logout');
    // admin routes
    Route::group([
        'middleware' => 'admin',
        ], function (){
        // category routes
        Route::get('categories', [\App\Http\Controllers\Api\v1\Admin\CategoryController::class, 'index'])->name('category.index');
        Route::post('categories', [\App\Http\Controllers\Api\v1\Admin\CategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{category}', [\App\Http\Controllers\Api\v1\Admin\CategoryController::class, 'show'])->name('categories.show');
        Route::patch('categories/{category}', [\App\Http\Controllers\Api\v1\Admin\CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [\App\Http\Controllers\Api\v1\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
        // post routes
        Route::get('posts', [\App\Http\Controllers\Api\v1\Admin\PostController::class, 'index'])->name('posts.index');
        Route::post('posts', [\App\Http\Controllers\Api\v1\Admin\PostController::class, 'store'])->name('posts.store');
        Route::get('posts/{post}', [\App\Http\Controllers\Api\v1\Admin\PostController::class , 'show'])->name('posts.show');
        Route::patch('posts/{post}', [\App\Http\Controllers\Api\v1\Admin\PostController::class, 'update'])->name('posts.update');
        Route::delete('posts/{post}', [\App\Http\Controllers\Api\v1\Admin\PostController::class, 'destroy'])->name('posts.destroy');
        // comment routes
        Route::post('posts/{post}/comment', [\App\Http\Controllers\Api\v1\Admin\CommentController::class, 'store'])->name('comments.store');
        Route::get('posts/{post}/comment', [\App\Http\Controllers\Api\v1\Admin\CommentController::class, 'show'])->name('comment.show');
    });
});
