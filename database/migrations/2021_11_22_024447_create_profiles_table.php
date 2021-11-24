<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
  public function up()
  {
    Schema::create('profiles', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('author_id')->unique();
      $table->timestamps();

      $table
        ->foreign('author_id')
        ->references('id')
        ->on('authors');
    });
  }
  public function down()
  {
    Schema::dropIfExists('profiles');
  }
}
