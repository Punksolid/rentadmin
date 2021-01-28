<?php

namespace Tests\Browser;

use App\Models\Property;
use App\Models\TipoPropiedad;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreatePropertyPage;
use Tests\DuskTestCase;

class PropertyTest extends DuskTestCase
{
    use WithFaker;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testItCanSaveANewProperty()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(factory(User::class)->create());
            $property_type = factory(TipoPropiedad::class)->create(['estatus' => 1]);

            $browser->visit(route('finca.create'));

            $browser->type('name', $this->faker->name);
            $browser->type('geolocation', $this->faker->name);
            $browser->click('input[name=fiscal]');
            $browser->select('property_type_id', (string) $property_type->id_tipo_propiedad);
            $browser->type('address', $this->faker->streetName);
            $browser->typeSlowly('mantenimiento', $this->faker->numerify('####'));
            $browser->typeSlowly('water_fee', $this->faker->numerify('####'));
            $browser->typeSlowly('energy_fee', $this->faker->numerify('####'));
            $browser->typeSlowly('water_account_number', $this->faker->numerify('####'));
            $browser->typeSlowly('predial', $this->faker->numerify('################'));

            $browser->scrollTo('button[type=submit]');
            $browser->click('button[type=submit]');

            $browser->assertUrlIs(route('finca.index'));
        });
    }
}
