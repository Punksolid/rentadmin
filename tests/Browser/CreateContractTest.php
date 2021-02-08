<?php

namespace Tests\Browser;

use App\Models\Lessee;
use App\Models\Lessor;
use App\Models\Property;
use App\Models\User;
use Doctrine\DBAL\Cache\CacheException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreateContractPage;
use Tests\DuskTestCase;

class CreateContractTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegisterNewContract()
    {
        $this->browse(function (Browser $browser) {

            $property = factory(Property::class)->create([
                'rented' => null,
                'status' => Property::STATUS_ACTIVE
            ]);

            $lessee = factory(Lessee::class)->create();

            $browser->loginAs(factory(User::class)->create())
                ->visit(route('contrato.create'))
                ->on(new CreateContractPage())
                ->assertSee('Nuevo Contrato');

            $browser->selectLessor($property->lessor->id);
            $browser->selectProperty($property->id);
            $browser->selectLessee($lessee->id);
            $browser->typeSlowly('@years',1);
            $browser->type('@bonus',10);
            $browser->type('@deposit',5000);

            $browser->click('@submit');

            $browser->assertRouteIs('contrato.index');
        });
    }
}
