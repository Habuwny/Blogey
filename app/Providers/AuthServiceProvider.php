<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Policies\BlogPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    BlogPost::class => BlogPostPolicy::class,
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();
    Gate::define('home.secret', function ($user) {
      return $user->is_admin;
    });
    //    Gate::define('posts-update', [BlogPostPolicy::class, 'update']);
    //    Gate::define('posts-delete', [BlogPostPolicy::class, 'delete']);

    //    Gate::resource('posts', BlogPostPolicy::class);

    //    Gate::before(function ($user, $ability) {
    //      if ($user->is_admin && in_array($ability, ['posts-update'])) {
    //        return true;
    //      }
    //    });
    //    Gate::after(function ($user, $ability, $res) {
    //      if ($user->is_admin) {
    //        return true;
    //      }
    //    });
  }
}
