<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\Lessor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertiesTest extends TestCase
{
//    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPropertiesPageCanBeSeen()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('finca.index'));

        $response->assertStatus(200);
    }

    public function testLessorOfAPropertyIsShown()
    {
        /** @var Property $property */
        $property = factory(Property::class)->create([
            'status' => 1
        ]);
        $lessor = factory(Lessor::class)->create(['estatus' => Lessor::ACTIVE_STATUS]);
        $property->assignLessor($lessor);
        $call = $this->get(route('finca.index'));

        $call->assertSee($lessor->nombre);
    }

    /**
     * @issue #1
     */
    public function testShowOnlyPropertiesOfActiveLessors()
    {
        /** @var Property $property */
        $property = factory(Property::class)->create(['status' => 1]);
        $lessor_active = factory(Lessor::class)->create([
            'estatus' => Lessor::ACTIVE_STATUS
        ]);
        $property->assignLessor($lessor_active);

        /** @var Property $property_from_inactive_lessor */
        $property_from_inactive_lessor = factory(Property::class)->create(['status' => 1]);
        $lessor_inactive = factory(Lessor::class)->create([
            'estatus' => Lessor::INACTIVE_STATUS
        ]);
        $property_from_inactive_lessor->assignLessor($lessor_inactive);

        $call = $this->get(route('finca.index'));
        $call->assertSee($property->name);
        $call->assertDontSee($property_from_inactive_lessor->name);
    }

    public function testShowOnlyActiveProperties()
    {
        $active_lessor = factory(Lessor::class)->create(['estatus' => Lessor::ACTIVE_STATUS]);
        $active_property = factory(Property::class)->create(['status' => true]);
        $active_property->assignLessor($active_lessor);
        $inactive_property = factory(Property::class)->create(['status' => false]);
        $inactive_property->assignLessor($active_lessor);

        $call = $this->get(route('finca.index'));

        $call->assertSee($active_property->name);
        $call->assertDontSee($inactive_property->name);
    }

    public function testSeeRegistryPropertyForm()
    {
        $this->withoutExceptionHandling();
        $inactive_lessor = factory(Lessor::class)->create(['estatus' => Lessor::INACTIVE_STATUS]);
        $active_lessor = factory(Lessor::class)->create(['estatus' => Lessor::ACTIVE_STATUS]);
        $call = $this->get(route('finca.create'));

        $call->assertSuccessful()
            ->assertSee('Direccion');

        $call->assertViewHas('arrendador', function ($lessors) use($active_lessor) {
            return $lessors->contains($active_lessor);
        });
        $call->assertViewHas('arrendador', function ($lessors) use($inactive_lessor) {
            return !$lessors->contains($inactive_lessor);
        });

        $call->assertSee('name="name"', false);
        $call->assertSee('name="lessor_id"', false);
        $call->assertSee('name="address"', false);
        $call->assertSee('name="nofiscal"', false);
        $call->assertSee('name="water_fee"', false);
        $call->assertSee('name="water_account_number"', false);
        $call->assertSee('name="energy_fee"', false);
        $call->assertSee('name="energy_fee"', false);
        $call->assertSee('name="geolocation"', false);
    }

    public function test_registry_new_property()
    {
        $this->withoutExceptionHandling();
        $property_form = factory(Property::class)->raw();

        $call = $this->post(route('finca.store'), $property_form);
        $call->assertRedirect();
        $this->assertDatabaseHas('properties', [
            'name' => $property_form['name'],
            'water_fee' => $property_form['water_fee'],
        ]);
        $this->assertDatabaseHas('properties', [
            'maintenance' => $property_form['maintenance'],
            'geolocation' => $property_form['geolocation']
        ]);
    }
    public function testItShowsEditForm()
    {
        $property = factory(Property::class)->create();

        $call = $this->get(route('finca.edit', ['finca' => $property->id]));

        $call->assertSuccessful();
    }

    public function test_edit_existing_property()
    {
        $this->withoutExceptionHandling();
        /** @var Property $property_old */
        $property_old = factory(Property::class)->create(['rented' => null]);

        $this->assertFalse($property_old->fresh()->rented);
        $new_property_form = factory(Property::class)->raw(['rented' => now()]);

        $call = $this->call('PATCH', route('finca.update',[$property_old->id]), $new_property_form);

        $call->assertRedirect(route('finca.index'));

        $this->assertTrue($property_old->fresh()->rented);
        $this->assertDatabaseHas(
            'properties', [
                'name' => $new_property_form['name'],
                'geolocation' => $new_property_form['geolocation'],
            ]
        );
        $this->assertDatabaseHas(
            'properties', [
                'water_fee' => $new_property_form['water_fee'],
            ]
        );
        $this->assertDatabaseHas(
            'properties', [
                'maintenance' => $new_property_form['maintenance']
            ]
        );
        $this->assertDatabaseMissing('properties', [
            'name' => $property_old->name,
            'water_fee' => $property_old->water_fee,
            'maintenance' => $property_old->maintenance
        ]);
    }

    public function testChangeStatusToProperty()
    {
        $property = factory(Property::class)->create([
            'status' => true
        ]);
        $call = $this->patch(route('finca.patch',$property->id), [
            'status' => false
        ]);

        $call->assertRedirect();
        $this->assertDatabaseHas('properties', [
            'name' => $property->name,
            'status' => false
        ]);
    }
}
