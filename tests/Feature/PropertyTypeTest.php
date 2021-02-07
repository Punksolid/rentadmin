<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testItCanSeeListOfPropertyTypes()
    {
        $response = $this->get(route('tipo-propiedad.index'));

        $response->assertStatus(200);
    }
}
