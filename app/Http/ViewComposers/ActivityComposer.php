<?php
namespace App\Http\ViewComposers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer
{
  public function compose(View $view)
  {
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

    $view->with('mostCommented', $mostCommented);
    $view->with('mostActive', $mostActive);
    $view->with('mosActiveLastMonth', $mosActiveLastMonth);
  }
}
