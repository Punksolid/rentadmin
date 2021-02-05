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
     * A Dusk test example.
     *
     * @return void
     */
    public function testDismissRFCFieldInEdit()
    {
        $this->browse(function (Browser $browser) {
            $lessor = factory(Lessor::class)->create();

            $browser->loginAs(factory(User::class)->create());
            $browser->visit(route('arrendador.edit', $lessor->id));
            $browser->screenshot('formshowed');
            $browser->type('codigo_postal', '80120');
            $browser->assertVisible("input[name='rfc']");
            $browser->screenshot('rfc exists');

            $browser->uncheck('show_invoice');
            $browser->assertMissing("input[name='rfc']");
            $browser->assertInputValue('nombre',$lessor->nombre);

            $browser->click("button[type='submit']");

            $browser->assertUrlIs(route('arrendador.index'));
        });
    }

    public function testDismissRFCFieldInEditAndDeleteValue()
    {
        $this->browse(function (Browser $browser) {
            $lessor = factory(Lessor::class)->create();
            $browser->loginAs(factory(User::class)->create());

            $browser->visit(route('arrendador.edit', $lessor->id));
            $browser->screenshot('formshowed');
            $browser->type('codigo_postal', '80120');
            $browser->assertVisible("input[name='rfc']");
            $browser->type('rfc', '');

            $browser->assertInputValue('nombre',$lessor->nombre);

            $browser->scrollTo("button[type='submit']");
            $browser->click("button[type='submit']");

            $browser->assertUrlIs(route('arrendador.index'));
        });
    }
}
