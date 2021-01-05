<?php

namespace Tests\Feature;

use App\Models\CatArrendatario;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LesseeTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListsOfLessee()
    {
        $this->withoutExceptionHandling();
        /** @var CatArrendatario $lessee */
        $lessee = factory(CatArrendatario::class)->create();
        $phoneNumber = $this->faker->phoneNumber;
        $lessee->addPhoneData($phoneNumber);
        $response = $this->get(route('arrendatario.index'));

        $response->assertStatus(200);
        $response->assertSee($phoneNumber);
    }

    public function test_see_lessee_creation_form()
    {
        $call = $this->get(route('arrendatario.create'));

        $call->assertSuccessful();
    }

    public function test_see_lessee_edit_form()
    {
//        $this->withoutExceptionHandling();
        $this->markTestSkipped('The modal its not correctly implemented');
        $lessee = factory(CatArrendatario::class)->create();

        $call = $this->get(route('arrendatario.edit', [$lessee->id_cat_arrendatario]));

        $call->assertSuccessful();
    }

    public function test_registry_new_lessee()
    {
        $this->withoutExceptionHandling();
        $lessee = factory(CatArrendatario::class)->raw([
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

    public function testLesseeCanHavePhones()
    {
        /** @var CatArrendatario $lessee */
        $lessee = factory(CatArrendatario::class)->create();
        $lessee->addPhoneData('789456123', 'casa', 1);

        $this->assertEquals('789456123', $lessee->defaultPhoneNumber()->telefono);
    }

}
