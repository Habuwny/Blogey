<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    if ($this->command->confirm('Do you want To refresh the database?')) {
      $this->command->call('migrate:refresh');
      $this->command->info('Database was refreshed');
    }
    $this->call([
      UserTableSeeder::class,
      BlogPostTableSeeder::class,
      CommentsTableSeeder::class,
    ]);
  }
}
