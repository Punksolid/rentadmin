<?php

namespace Tests\Feature\Lessee;

use App\Models\Lessee;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/** Arrendatario */
class LesseeTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListsOfLesseeWithActiveStatus()
    {
        $this->withoutExceptionHandling();
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create([
            'estatus' => Lessee::STATUS_ACTIVE
        ]);

        $lesseeInactive = factory(Lessee::class)->create([
            'estatus' => Lessee::STATUS_INACTIVE
        ]);
        $phoneNumber = $this->faker->phoneNumber;
        $lessee->addPhoneData($phoneNumber);
        $response = $this->get(route('arrendatario.index'));

        $response->assertStatus(200);
        $response->assertSee($phoneNumber);
        $response->assertSee($lessee->nombre);
        $response->assertDontSee($lesseeInactive->nombre);
    }

    public function testListLesseesWithStatusInactive()
    {
        $this->withoutExceptionHandling();
        /** @var Lessee $lesseeInactive */
        $lesseeInactive = factory(Lessee::class)->create([
            'estatus' => Lessee::STATUS_INACTIVE
        ]);

        $response = $this->get(route('arrendatario.index', ['status' => Lessee::STATUS_INACTIVE]));

        $response->assertStatus(200);
        $response->assertSee($lesseeInactive->nombre);
    }

    public function test_see_lessee_creation_form()
    {
        $call = $this->get(route('arrendatario.create'));

        $call->assertSuccessful();
    }

    public function test_registry_new_lessee()
    {
        $this->withoutExceptionHandling();
        $lessee = factory(Lessee::class)->raw([
            'nombre_fiador' => $this->faker->name,
            'apellido_paterno_fiador' => $this->faker->lastName,
            'apellido_materno_fiador' => $this->faker->lastName,
            'calle_fiador' => $this->faker->streetName,
            'colonia_fiador' => $this->faker->word,
            'numero_ext_fiador' => $this->faker->randomNumber(5),
            'numero_int_fiador' => $this->faker->randomNumber(5),
            'estado_fiador' => $this->faker->state,
            'ciudad_fiador' => $this->faker->city,
            'codigo_postal_fiador' => $this->faker->postcode,
            'entre_calles_fiador' => $this->faker->sentence,
            // work
            'calle_fiador_trabajo' => $this->faker->streetName,
            'colonia_fiador_trabajo' => $this->faker->word,
            'numero_ext_fiador_trabajo' => $this->faker->randomNumber(5),
            'numero_int_fiador_trabajo' => $this->faker->randomNumber(5),
            'estado_fiador_trabajo' => $this->faker->state,
            'ciudad_fiador_trabajo' => $this->faker->city,
            'codigo_postal_fiador_trabajo' => $this->faker->postcode,
            'entre_calles_fiador_trabajo' => $this->faker->sentence,


        ]);
        $call = $this->post(route('arrendatario.store'), $lessee);

        $call->assertRedirect(route('arrendatario.index'));

    }

    public function test_register_lessee_with_minimum_information()
    {
        $this->withoutExceptionHandling();


        $lessee = factory(Lessee::class)->raw([
            'nombre_fiador' => $this->faker->name,
            'apellido_paterno_fiador' => $this->faker->name,
            'apellido_materno_fiador' => $this->faker->name,
            'calle_fiador' => $this->faker->streetName,
            'colonia_fiador' => $this->faker->word,
            'numero_ext_fiador' => $this->faker->lexify('?????'),
            'estado_fiador' => $this->faker->state,
            'ciudad_fiador' => $this->faker->city,
            'codigo_postal_fiador' => $this->faker->postcode,
            'colonia_fiador_trabajo' => $this->faker->word,
            'numero_ext_fiador_trabajo' => $this->faker->word,
            'estado_fiador_trabajo' => $this->faker->state,
            'ciudad_fiador_trabajo' => $this->faker->city,
            'codigo_postal_fiador_trabajo' => $this->faker->postcode
        ]);

        $call = $this->post(route('arrendatario.store'), $lessee);

        $call->assertRedirect(route('arrendatario.index'));
    }

    public function testRegisterLesseeWithoutGuarantor()
    {
        $this->withoutExceptionHandling();

        $lessee = factory(Lessee::class)->raw();

        $call = $this->post(route('arrendatario.store'), $lessee);
        $this->assertDatabaseHas('lessees', [
            'nombre' => $lessee['nombre']
        ]);
        $call->assertRedirect(route('arrendatario.index'));
    }

    public function testLesseeCanHavePhones()
    {
        $phone = 321321321321;
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create();
        $lessee->addPhoneData($phone, 'casa', 1);
//        dd($lessee->toArray());
        $this->assertEquals($phone, $lessee->defaultPhoneNumber()->telefono);
    }

    public function testLesseeCanHaveStatusChangedToInactive()
    {
        $this->withoutExceptionHandling();
        $lessee = factory(Lessee::class)->create(['estatus' => Lessee::STATUS_ACTIVE]);
        $call = $this->patch(
            route('arrendatario.toggle', [$lessee->id]),
            [
            'status' => Lessee::STATUS_INACTIVE
            ]
        );
        $call->assertRedirect(route('arrendatario.index'));
        $lessee->refresh();
        $this->assertEquals(Lessee::STATUS_INACTIVE, $lessee->estatus);
    }
}
