<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $posts = BlogPost::all();
    if ($posts->count() === 0) {
      $this->command->info(
        'There is no blog posts, so no comments can be generated.'
      );
      return;
    }
    $commentCount = (int) $this->command->ask(
      'How many comments wold you like to generate ?',
      1500
    );
    Comment::factory()
      ->count($commentCount)
      ->make()
      ->each(function ($comment) use ($posts) {
        $comment->blog_post_id = $posts->random()->id;
        $comment->save();
      });
  }
}
