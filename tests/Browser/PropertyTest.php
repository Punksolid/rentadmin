<?php

namespace Tests\Browser;

use App\Models\Lessor;
use App\Models\Property;
use App\Models\TipoPropiedad;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreatePropertyPage;
use Tests\DuskTestCase;
use Throwable;

class PropertyTest extends DuskTestCase
{
    use WithFaker;

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws Throwable
     */
    public function testItCanSaveANewProperty(): void
    {
        $this->browse(function (Browser $browser){
            $browser->pause(100);

            $property_type = factory(TipoPropiedad::class)->create(['estatus' => 1]);
            $lessor = factory(Lessor::class)->create(['estatus' => true]);
            $browser->loginAs(factory(User::class)->create())
                ->visit(route('finca.create'))
                ->on(new CreatePropertyPage())
                ->assertSee('Nuevo Inmueble');

            $browser->pause(100);

            $browser->type('name', $this->faker->name);
            $browser->type('geolocation', $this->faker->name);
            $browser->pause(100);
            $browser->selectLessor($lessor->id);
//            $browser->scrollTo('input[name=fiscal]');
//            $browser->click('input[name=fiscal]');
            $browser->pause(200);
            $browser->radio('fiscal', Property::RECIBO_STRING_NO_FISCAL_VALUE);

            $browser->select('property_type_id', (string) $property_type->id_tipo_propiedad);

//            $browser->click('#search_lessor');
//            $browser->pause(400);
//            $browser->waitFor('#modal-arrendador', 10);
//            $browser->click('.item');
//            $browser->waitFor('input[name=address]', 10);
//            $browser->pause(5500);

            $browser->type('address', $this->faker->streetName);
            $browser->typeSlowly('maintenance', $this->faker->numerify('####'));
            $browser->typeSlowly('water_fee', $this->faker->numerify('####'));
            $browser->typeSlowly('energy_fee', $this->faker->numerify('####'));
            $browser->typeSlowly('water_account_number', $this->faker->numerify('####'));
            $browser->typeSlowly('predial', $this->faker->numerify('##################'));

            $browser->scrollTo('button[type=submit]');
            $browser->click('button[type=submit]');

            $browser->assertUrlIs(route('finca.index'));
        });
    }

    public function testItCanShowAFormOfEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(factory(User::class)->create());
            $property = factory(Property::class)->create(['recibo' => Property::RECIBO_STRING_FISCAL_VALUE]);
            $property_type = factory(TipoPropiedad::class)->create(['estatus' => 1]);

            $browser->visit(route('finca.edit', [$property->id]));

            $browser->assertInputValue('name', $property->name);
            $browser->assertInputValue('energy_fee', $property->energy_fee);
            $browser->assertInputValue('water_account_number', $property->water_account_number);
            $predial_code = $this->faker->numerify('##################');
            $browser->typeSlowly('predial', $predial_code);
            $browser->assertInputValue('predial', rtrim(chunk_split($predial_code, 3, ' ')));
//            $browser->assertInputValue('address', $property->address); // format detail difference
//            $browser->assertInputValue('predial', $property->predial); // format detail difference
//            $browser->assertInputValue('maintenance', $property->maintenance); // format detail
            // recibo
            $browser->pause(200);
            $browser->assertRadioSelected('input[name="fiscal"]',Property::RECIBO_STRING_FISCAL_VALUE);
            $browser->scrollTo('button[type=submit]');
            $this->assertEquals($property->water_fee, str_replace('.','', $browser->value('input[name=water_fee]')));
            $browser->assertInputValue('geolocation', $property->geolocation);

            $browser->scrollTo('button[type=submit]');
            $browser->click('button[type=submit]');

            $browser->assertUrlIs(route('finca.index'));
        });
    }
}
