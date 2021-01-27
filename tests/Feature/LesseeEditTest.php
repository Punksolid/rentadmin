<?php

namespace Tests\Feature;

use App\Models\Lessee;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LesseeEditTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_see_lessee_edit_form_with_one_phone_and_email()
    {
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create();

        $lessee->addPhoneData($this->faker->phoneNumber, 'Whatever');
        $lessee->addEmail($this->faker->email);

        $call = $this->get(route('arrendatario.edit', [$lessee->id]));

        $call->assertSuccessful();
        $call->assertSee($lessee->nombre);
    }

    public function test_see_minimum_lessee_edit_form()
    {
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create();
        $call = $this->get(route('arrendatario.edit', [$lessee->id]));

        $call->assertSuccessful();
    }

    public function testItCanSeeEditFormWithoutGuarantor()
    {
        $this->withoutExceptionHandling();
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create(['id_fiador' => null]);
        $call = $this->get(route('arrendatario.edit', [$lessee->id]));

        $call->assertSuccessful();
    }

    public function testItCanUpdateWithoutHavingGuarantorAndNotAddingOne()
    {
        $this->withoutExceptionHandling();
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create(['id_fiador' => null]);
        $form_lessee = factory(Lessee::class)->raw(['id_fiador' => null]);
        $call = $this->put(route('arrendatario.update', [$lessee->id]),
            $form_lessee
        );

        $call->assertRedirect(route('arrendatario.index'));
        $this->assertDatabaseHas('lessees', [
            'nombre' => $form_lessee['nombre']
        ]);
    }

    public function test_update_without_phones()
    {
        $this->withoutExceptionHandling();
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create();
        $new_lessee = factory(Lessee::class)->raw();
        $new_lessee['nombre_fiador'] = $this->faker->name;
        $new_lessee['apellido_paterno_fiador'] = $this->faker->name;
        $new_lessee['apellido_materno_fiador'] = $this->faker->name;
        $new_lessee['calle_fiador'] = $this->faker->name;
        $new_lessee['colonia_fiador'] = $this->faker->name;
        $new_lessee['numero_ext_fiador'] = $this->faker->numerify('####');
        $new_lessee['numero_int_fiador'] = $this->faker->numerify('####');
        $new_lessee['estado_fiador'] = $this->faker->numerify('####');
        $new_lessee['ciudad_fiador'] = $this->faker->numerify('####');
        $new_lessee['codigo_postal_fiador'] = $this->faker->numerify('####');
        $new_lessee['entre_calles_fiador'] = $this->faker->numerify('####');

        $new_lessee['calle_fiador_trabajo'] = $this->faker->name;
        $new_lessee['colonia_fiador_trabajo'] = $this->faker->name;
        $new_lessee['numero_ext_fiador_trabajo'] = $this->faker->numerify('####');
        $new_lessee['numero_int_fiador_trabajo'] = $this->faker->numerify('####');
        $new_lessee['estado_fiador_trabajo'] = $this->faker->numerify('####');
        $new_lessee['ciudad_fiador_trabajo'] = $this->faker->numerify('####');
        $new_lessee['codigo_postal_fiador_trabajo'] = $this->faker->numerify('####');
        $new_lessee['entre_calles_fiador_trabajo'] = $this->faker->numerify('####');


        $call = $this->put(
            route('arrendatario.update', [$lessee->id]),
            $new_lessee
        );

        $call->assertRedirect(route('arrendatario.index'));
        $this->assertDatabaseHas('lessees', [
            'nombre' => $new_lessee['nombre']
        ]);
    }
}
