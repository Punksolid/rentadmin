<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LiquidationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLiquidationIndexCanBeSeen()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('liquidaciones.index'));

        $response->assertStatus(200);
    }
}
