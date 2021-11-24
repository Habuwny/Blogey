<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
  use RefreshDatabase;
  public function test_when_no_posts()
  {
    $res = $this->get('/posts');
    $res->assertSee('No Posts');
  }
  public function test_when_one_post()
  {
    $post = $this->createPost();

    $res = $this->get('/posts');

    $res->assertSee('New Title');

    $this->assertDatabaseHas('blog_posts', [
      'title' => 'New Title',
      'content' => 'New Post Content',
    ]);
  }
  public function test_when_store_valid()
  {
    $params = [
      'title' => 'valid title',
      'content' => 'At least 10 characters',
    ];
    $this->post('/posts', $params)
      ->assertStatus(302)
      ->assertSessionHas('status');
    $this->assertEquals(session('status'), 'the post is created');
  }
  public function test_when_store_invalid()
  {
    $params = [
      'title' => 'x',
      'content' => 'xxx',
    ];
    $this->post('/posts', $params)
      ->assertStatus(302)
      ->assertSessionHas('errors');
    $msg = session('errors')->getMessages();

    $this->assertEquals(
      $msg['title'][0],
      'The title must be at least 5 characters.'
    );
    $this->assertEquals(
      $msg['content'][0],
      'The content must be at least 10 characters.'
    );
  }
  public function test_update_valid()
  {
    $post = $this->createPost();
    $this->assertDatabaseHas('blog_posts', [
      'title' => 'New Title',
      'content' => 'New Post Content',
    ]);
    $params = [
      'title' => 'a new valid title',
      'content' => 'At least 10 characters',
    ];
    $this->put("/posts/{$post->id}", $params)
      ->assertStatus(302)
      ->assertSessionHas('status');
    $this->assertDatabaseMissing('blog_posts', [
      'title' => 'New Title',
      'content' => 'New Post Content',
    ]);
    $this->assertDatabaseHas('blog_posts', [
      'title' => 'a new valid title',
      'content' => 'At least 10 characters',
    ]);
  }

  public function test_delete_post()
  {
    $post = $this->createPost();
    $this->delete("/posts/{$post->id}")
      ->assertStatus(302)
      ->assertSessionHas('status');
  }

  private function createPost(): BlogPost
  {
    $post = new BlogPost();
    $post->title = 'New Title';
    $post->content = 'New Post Content';
    $post->save();
    return $post;
  }

  public function test_when_post_has_comments()
  {
    $post = $this->createPost();

    Comment::factory()
      ->count(4)
      ->create([
        'blog_post_id' => $post->id,
      ]);
    $res = $this->get('/posts');
  }
}
