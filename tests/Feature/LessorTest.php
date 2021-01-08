<?php

namespace Tests\Feature;

use App\Models\Lessee;
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

    public function testListsLessorsActiveByDefault()
    {
        $lessor_active = factory(Lessor::class)->create(['estatus' => Lessor::ACTIVE_STATUS]);
        $lessor_inactive = factory(Lessor::class)->create(['estatus' => Lessor::INACTIVE_STATUS]);

        $call = $this->get(route('arrendador.index'));

        $call->assertSuccessful();
        $call->assertSee($lessor_active->nombre);
        $call->assertSee('Arrendadores Inactivos');
        $call->assertDontSee($lessor_inactive->nombre);
    }

    public function testCanHavePhones()
    {
        /** @var Lessor $lessor */
        $lessor = factory(Lessor::class)->create();
        $lessor->addPhoneData('789456123', 'casa', 1);

        $this->assertEquals('789456123', $lessor->defaultPhoneNumber->telefono);
    }

    public function testListInactiveLessors()
    {
        $lessor_inactive = factory(Lessor::class)->create(['estatus' => Lessor::INACTIVE_STATUS]);

        $call = $this->get(route('arrendador.index', ['status' => Lessor::INACTIVE_STATUS]));

        $call->assertSee($lessor_inactive->nombre);
    }
}
