<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
  public function test_home_page()
  {
    $response = $this->get('/');

    $response->assertSeeText('Hello Test');
  }
  public function test_contact_page()
  {
    $response = $this->get('/contact');

    $response->assertSeeText('Contact');
  }
}
