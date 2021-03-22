<?php

namespace Tests\Browser;

use App\Models\Lessee;
use App\Models\Lessor;
use App\Models\Property;
use App\Models\User;
use Doctrine\DBAL\Cache\CacheException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
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
            // Contract dates
            $this->fillInputDate($browser,'periods[0][fecha_inicio]', now());
            $this->fillInputDate($browser,'periods[0][fecha_fin]', now()->addMonth());
            $browser->typeSlowly('input[name=\'periods[0][cantidad]\']', random_int(1000,1210));

            $browser->pause(500);
            $browser->screenshot('after');
            $browser->screenshot('test');
            $browser->type('@bonus',10);
            $browser->type('@deposit',5000);
            $browser->click('@submit');

            $browser->assertRouteIs('contrato.index');
            $browser->assertSee('Catalogo de Contratos');
        });
    }

    /**
     * @param Browser $browser
     * @param $input_name
     * @param Carbon $date
     */
    private function fillInputDate(Browser $browser, $input_name, Carbon $date): void
    {
        $browser->keys("input[name='$input_name']", $date->format('Y'));
        $browser->keys("input[name='$input_name']", $date->format('m'));
        $browser->keys("input[name='$input_name']", $date->format('d'));
    }
}
