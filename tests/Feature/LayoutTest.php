<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LayoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowNotifications(): void
    {

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Novedades');
    }
}
