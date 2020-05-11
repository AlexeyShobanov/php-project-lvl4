<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomeControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
