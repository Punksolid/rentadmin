<?php

namespace Tests\Feature;

use App\Models\Lessor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessorTest extends TestCase
{

    public function testALessorCanBeRegisteredWithoutInvoiceData()
    {
        $lessor = factory(Lessor::class)->raw();

        $call = $this->call('POST', route('arrendador.store'), $lessor);

        $call->assertRedirect(route('arrendador.index'));
    }

    public function testIndexLessorPageWorks()
    {
        $call = $this->get(route('arrendador.index'));

        $call->assertSuccessful();
    }
}
