<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowListsOfTickets()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('tickets.index'));

        $response->assertStatus(200);
    }
}
