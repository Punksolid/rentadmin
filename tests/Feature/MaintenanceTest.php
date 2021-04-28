<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaintenanceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMaintenanceIndex(): void
    {
        $response = $this->get(route('mantenimiento.index'));

        $response->assertStatus(200);
    }

    public function testShowsCreateForm(): void
    {
        $call = $this->get(route('mantenimiento.create'));

        $call->assertSuccessful();
    }
}
