<?php

namespace Tests\Feature;

use App\Models\Guarantor;
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

    public function testListLesseesWithStatusInactive(): void
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

    public function test_see_lessee_creation_form(): void
    {
        $call = $this->get(route('arrendatario.create'));

        $call->assertSuccessful();
    }

    public function test_see_lessee_edit_form_with_one_phone_and_email(): void
    {
        $this->withoutExceptionHandling();
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create();
        $lessee->addPhoneData($this->faker->phoneNumber, 'Whatever');
        $lessee->addEmail($this->faker->email);

        $call = $this->get(route('arrendatario.edit', [$lessee->id]));

        $call->assertSuccessful();
    }

    public function test_see_minimum_lessee_edit_form()
    {
        $this->withoutExceptionHandling();
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create();
//        $lessee->addPhoneData($this->faker->phoneNumber, 'Whatever');
//        $lessee->addEmail($this->faker->email);

        $call = $this->get(route('arrendatario.edit', [$lessee->id]));

        $call->assertSuccessful();
    }

    public function test_registry_new_lessee()
    {
        $this->withoutExceptionHandling();
        $lessee = factory(Lessee::class)->raw([
            'guarantor_block' => true,
            'guarantor' => [
                'nombre' => $this->faker->name,
                'apellido_paterno' => $this->faker->lastName,
                'apellido_materno' => $this->faker->lastName,
                'calle' => $this->faker->streetName,
                'colonia' => $this->faker->word,
                'numero_ext' => $this->faker->randomNumber(5),
                'numero_int' => $this->faker->randomNumber(5),
                'estado' => $this->faker->state,
                'ciudad' => $this->faker->city,
                'codigo_postal' => $this->faker->postcode,
                'entre_calles' => $this->faker->address,
                // work
                'calle_trabajo' => $this->faker->streetName,
                'colonia_trabajo' => $this->faker->word,
                'numero_ext_trabajo' => $this->faker->randomNumber(5),
                'numero_int_trabajo' => $this->faker->randomNumber(5),
                'estado_trabajo' => $this->faker->state,
                'ciudad_trabajo' => $this->faker->city,
                'codigo_postal_trabajo' => $this->faker->postcode,
                'entre_calles_trabajo' => $this->faker->address,
            ]
        ]);
        $call = $this->post(route('arrendatario.store'), $lessee);

        $call->assertRedirect(route('arrendatario.index'));
        $this->assertDatabaseHas('guarantors', [
            'nombre' => $lessee['guarantor']['nombre'],
            'apellido_paterno' => $lessee['guarantor']['apellido_paterno'],
            'apellido_materno' => $lessee['guarantor']['apellido_materno'],
        ]);

    }

    /**
     * @dataProvider lesseeFormProvider
     */
    public function test_register_lessee_with_minimum_information($lessee_form): void
    {
        $this->withoutExceptionHandling();

        $call = $this->post(route('arrendatario.store'), $lessee_form);

        $call->assertRedirect(route('arrendatario.index'));

    }

    public function lesseeFormProvider(): array
    {
        $this->createApplication();
        $this->refreshApplication();

        $with_minimum_info = factory(Lessee::class)->raw(['id_fiador' => null]);
        $guarantor = factory(Guarantor::class)->raw();
        $with_guarantor = factory(Lessee::class)->raw([
            'id_fiador' => null,
            'guarantor_block' => 'on',
            'guarantor' => $guarantor
        ]);

        return [
            'minimum_info' => [ $with_minimum_info ],
            'with_guarantor' => [ $with_guarantor ]
        ];
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
