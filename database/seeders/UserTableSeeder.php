<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $usersCount = max(
      (int) $this->command->ask(
        'How many users wold you like to generate ?',
        50
      ),
      1
    );
    User::factory()
      ->Admin()
      ->create();

    User::factory()
      ->count($usersCount)
      ->create();
    User::factory()
      ->count($usersCount)
      ->create();
  }
}
