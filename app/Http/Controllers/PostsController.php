<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->only([
      'create',
      'store',
      'edit',
      'update',
      'destroy',
    ]);
  }

  public function index()
  {
    // DB::connection()->enableQueryLog();

    // $posts = BlogPost::with('comments')->get();

    // foreach ($posts as $post) {
    //     foreach ($post->comments as $comment) {
    //         echo $comment->content;
    //     }
    // }

    // dd(DB::getQueryLog());

    // comments_count

    return view('posts.index', [
      'posts' => BlogPost::latest()
        ->withCount('comments')
        ->get(),
      'mostCommented' => BlogPost::mostCommented()
        ->take(5)
        ->get(),
      'mostActive' => User::withMostBlogPosts()
        ->take(5)
        ->get(),
      'mosActiveLastMonth' => User::withMostBlogPostsLastMonth()
        ->take(5)
        ->get(),
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   *
//   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return view('posts.show', [
      'post' => BlogPost::with('comments')->findOrFail($id),
    ]);
    //     return view('posts.show', [
    //      'post' => BlogPost::with([
    //        'comments' => function ($query) {
    //          return $query->latest();
    //        },
    //      ])->findOrFail($id),
    //    ]);
    //
  }

  public function create()
  {
    //    $this->authorize('posts-create');
    return view('posts.create');
  }

  public function store(StorePost $request)
  {
    $validatedData = $request->validated();
    $validatedData['user_id'] = $request->user()->id;

    $blogPost = BlogPost::create($validatedData);
    $request->session()->flash('status', 'Blog post was created!');

    return redirect()->route('posts.show', ['post' => $blogPost->id]);
  }

  public function edit($id)
  {
    $post = BlogPost::findOrFail($id);
    $this->authorize($post);

    //    if (Gate::denies('update-post', $post)) {
    //      abort(403, 'You are not allowed to edit this post!');
    //    }
    return view('posts.edit', ['post' => $post]);
  }

  public function update(StorePost $request, $id)
  {
    $post = BlogPost::findOrFail($id);

    //    if (Gate::denies('update-post', $post)) {
    //      abort(403, 'You are not allowed to edit this post!');
    //    }
    $this->authorize($post);

    $validatedData = $request->validated();
    $post->fill($validatedData);
    $post->save();
    $request->session()->flash('status', 'Blog post was updated!');

    return redirect()->route('posts.show', ['post' => $post->id]);
  }

  public function destroy(Request $request, $id)
  {
    $post = BlogPost::findOrFail($id);
    //    if (Gate::denies('update-post', $post)) {
    //      abort(403, 'You are not allowed to delete this post!');
    //    }
    $this->authorize($post);
    $post->delete();

    // BlogPost::destroy($id);

    $request->session()->flash('status', 'Blog post was deleted!');
    return redirect()->route('posts.index');
  }
}
