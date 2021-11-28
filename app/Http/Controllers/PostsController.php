<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
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

    $mostCommented = Cache::tags(['blog-post'])->remember(
      'mostCommented',
      60,
      function () {
        return BlogPost::mostCommented()
          ->take(5)
          ->get();
      }
    );
    $mostActive = Cache::remember('mostActive', 60, function () {
      return User::withMostBlogPosts()
        ->take(5)
        ->get();
    });
    $mosActiveLastMonth = Cache::remember(
      'mosActiveLastMonth',
      60,
      function () {
        return User::withMostBlogPostsLastMonth()
          ->take(5)
          ->get();
      }
    );

    return view('posts.index', [
      'posts' => BlogPost::latest()
        ->withCount('comments')
        ->with('user')
        ->get(),
      'mostCommented' => $mostCommented,
      'mostActive' => $mostActive,
      'mosActiveLastMonth' => $mosActiveLastMonth,
    ]);
  }

  public function show($id)
  {
    $blogPost = Cache::tags(['blog-post'])->remember(
      "blog-post-{$id}",
      60,
      function () use ($id) {
        return BlogPost::with('comments')->findOrFail($id);
      }
    );
    $sessionId = session()->getId();
    $counterKey = "blog-post-{$id}-counter";
    $usersKey = "blog-post-{$id}-users";

    $users = Cache::tags(['blog-post'])->get($usersKey, []);
    $usersUpdate = [];
    $difference = 0;
    $now = now();

    foreach ($users as $session => $lastVisit) {
      if ($now->diffInMinutes($lastVisit)) {
        $difference--;
      } else {
        $usersUpdate[$session] = $lastVisit;
      }
    }
    if (
      !array_key_exists($sessionId, $users) ||
      $now->diffInMinutes($users[$sessionId]) >= 1
    ) {
      $difference++;
    }
    $usersUpdate[$sessionId] = $now;
    Cache::tags(['blog-post'])->forever($usersKey, $usersUpdate);

    if (!Cache::tags(['blog-post'])->has($counterKey)) {
      Cache::tags(['blog-post'])->forever($counterKey, 1);
    } else {
      Cache::tags(['blog-post'])->increment($counterKey, $difference);
    }

    $counter = Cache::tags(['blog-post'])->get($counterKey);
    return view('posts.show', [
      'post' => $blogPost,
      'counter' => $counter,
    ]);
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
