<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUsersSecurityModuleCanBeSeen()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('usuarios.index'));

        $response->assertStatus(200);
    }
}
