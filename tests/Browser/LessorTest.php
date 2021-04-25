<?php

namespace Tests\Browser;

use App\Models\Lessor;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LessorTest extends DuskTestCase
{
    /**
     *
     * @return void
     */
    public function testDismissRFCFieldInEdit(): void
    {
        $this->browse(function (Browser $browser) {
            $lessor = factory(Lessor::class)->create();

            $browser->loginAs(factory(User::class)->create());
            $browser->visit(route('arrendador.edit', $lessor->id));
            $browser->type('codigo_postal', '80120');
            $browser->assertVisible("input[name='rfc']");

            $browser->uncheck('show_invoice');
            $browser->assertMissing("input[name='rfc']");
            $browser->assertInputValue('nombre', $lessor->nombre);

            $browser->click("button[type='submit']");

            $browser->assertUrlIs(route('arrendador.index'));
        });
    }

    public function testDismissRFCFieldInEditAndDeleteValue(): void
    {
        $this->browse(function (Browser $browser) {
            $lessor = factory(Lessor::class)->create();
            $browser->loginAs(factory(User::class)->create());

            $browser->visit(route('arrendador.edit', $lessor->id));

            $browser->type('codigo_postal', '80120');
            $browser->assertVisible("input[name='rfc']");
            $browser->type('rfc', '');

            $browser->assertInputValue('nombre', $lessor->nombre);

            $browser->scrollTo("button[type='submit']");
            $browser->click("button[type='submit']");

            $browser->assertUrlIs(route('arrendador.index'));
        });
    }

    public function testDeleteAPhoneNumber(): void
    {
        /** @var Lessor $lessor */
        $lessor = factory(Lessor::class)->create();
        $lessor->addPhoneData('11111111', 'not delexting this');
        $lessor->addPhoneData('22222222', 'delete this please');
        $this->browse(function (Browser $browser) use($lessor) {
            $browser->loginAs(factory(User::class)->create())
                ->visit(route('arrendador.edit', $lessor->id));
            $phone_id = $lessor->phones->where('descripcion', '==', 'delete this please')->first()->id_telefono;
            $browser->scrollTo("button[data-phone='$phone_id']");
            $browser->click("button[data-phone='$phone_id']");
            $browser->waitForText('Editar Arrendador');
            $browser->assertUrlIs( route('arrendador.edit', [ $lessor->id ]));
            $this->assertDatabaseMissing('phone_numbers', [
                'telefono' => '22222222',
                'descripcion' => 'delete this'
            ]);
        });
    }
}
