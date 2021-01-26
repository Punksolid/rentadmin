<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaintenanceTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowLists()
    {
        $response = $this->get(route('tipo-mantenimiento.index'));

        $response->assertStatus(200);
    }
}
