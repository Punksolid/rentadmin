<?php

namespace Tests\Feature;

use App\Models\Lessee;
use App\Models\Lessor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/** Arrendador */
class LessorTest extends TestCase
{

    use WithFaker;
    use DatabaseTransactions;

    public function testALessorCanBeRegisteredWithoutInvoiceData()
    {
        $this->withoutExceptionHandling();
        $lessor = factory(Lessor::class)->raw();

        $call = $this->call('POST', route('arrendador.store'), $lessor);

        $call->assertRedirect(route('arrendador.index'));
        $this->assertDatabaseHas('lessors', [
            'nombre' => $lessor['nombre']
        ]);
    }

    public function testRegisterBasicLessor()
    {
        $this->withoutExceptionHandling();
        $lessor = factory(Lessor::class)->raw([
            'entre_calles' => ''
        ]);

        $call = $this->call('POST', route('arrendador.store'), $lessor);

        $call->assertRedirect(route('arrendador.index'));
        $this->assertDatabaseHas('lessors', [
            'nombre' => $lessor['nombre']
        ]);

    }

    public function testALessorCanBeRegisteredWithPhoneData()
    {

        $this->withoutExceptionHandling();
        /** @var Lessor $lessor */
        $lessor = factory(Lessor::class)->raw();
        $lessor['phone_number'][] = [
            'telefono' => $this->faker->randomNumber(8),
            'descripcion' => $this->faker->sentence
        ];
        $call = $this->call('POST', route('arrendador.store'), $lessor);

        $call->assertRedirect(route('arrendador.index'));
        $this->assertDatabaseHas('lessors', [
            'nombre' => $lessor['nombre']
        ]);
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

    /** Unit test */
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

    public function testItShowsLessorCreateForm()
    {
        $call = $this->get(route('arrendador.create'));

        $call->assertSuccessful();
    }

    public function testEditFormLoadsSuccessfulWithAllAttachedData()
    {
        $this->withoutExceptionHandling();
        /** @var Lessor $lessor */
        $lessor = factory(Lessor::class)->create();
        $lessor->addPhoneData($this->faker->phoneNumber, 'Telefono Casa');
        $lessor->addEmail($this->faker->email);
        $lessor->addBankAccount(
            $this->faker->word,
            $this->faker->bankAccountNumber,
            $this->faker->bankAccountNumber,
            $this->faker->name
        );

        $call = $this->get(route('arrendador.edit', [
            $lessor->id
        ]));

        $call->assertSuccessful();
    }

    public function testEditFormLoadsSuccessfulWithoutAttachedData()
    {
        $this->withoutExceptionHandling();
        /** @var Lessor $lessor */
        $lessor = factory(Lessor::class)->create();

        $call = $this->get(route('arrendador.edit', [
            $lessor->id
        ]));

        $call->assertSuccessful();
    }

    public function testItCanUpdateLessor()
    {
        $this->withoutExceptionHandling();
        $lessor = factory(Lessor::class)->create();
        $new_lessor = factory(Lessor::class)->raw();
        $call = $this->call('PUT',route('arrendador.update', [$lessor->id]), $new_lessor);

        $call->assertRedirect(route('arrendador.index'));
        $this->assertDatabaseHas('lessors', [
            'nombre' => $new_lessor['nombre']
        ]);

    }
}
