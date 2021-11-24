<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//
//Route::get('/posts', function () use ($posts) {
//  //  dd(request()->all());
//  return view('posts.index', ['posts' => $posts]);
//})->name('posts.index');
//Route::get('/posts/{id}', function ($id) use ($posts) {
//  abort_if(!isset($posts[$id]), 404);
//
//  return view('posts.show', ['post' => $posts[$id]]);
//})->name('posts.show');
//
//Route::get('/recent-posts/{ago?}', function ($ago = 9) {
//  return $ago . 'ago';
//})
//  ->name('home.ago')
//  ->middleware('auth');
//
//Route::prefix('/fun')
//  ->name('fun.')
//  ->group(function () use ($posts) {
//    Route::get('response', function () use ($posts) {
//      return response(collect([$posts]), 201)
//        ->header('Content-Type', 'application/json')
//        ->cookie('MY_COOKIE', 'AHMED HABUWNY', 360);
//    });
//    Route::get('redi', function () {
//      return redirect('contact');
//    });
//    Route::get('named', function () {
//      return redirect()->route('posts.show', ['id' => 1]);
//    });
//    Route::get('away', function () {
//      return redirect()->away('https://google.com/good');
//    });
//    Route::get('download', function () {
//      return response()->download(public_path('/planet.png'), 'your_img.png');
//    });
//  });
//
//Route::get('/single', [AboutController::class]);
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::resource('posts', PostsController::class);
Auth::routes();
