<?php

namespace Tests\Browser;

use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersTest extends DuskTestCase
{
    use WithFaker;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegisterNewUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(factory(User::class)->create());
            $browser->visit(route('usuarios.create'));

            $browser->type('input[name=nombre]', $this->faker->name);
            $browser->type('input[name=apellido_paterno]', $this->faker->lastName);
            $browser->type('input[name=apellido_materno]', $this->faker->lastName);
            $browser->type('input[name=email]', $this->faker->email);
            $browser->type('input[name=password]', $this->faker->password);
            $this->selectUserType($browser);

            $browser->click('button[type=submit]');

            $browser->assertRouteIs('usuarios.index');
        });
    }

    public function selectUserType(Browser $browser)
    {
        $browser->click('#modal_user_type');
        $browser->pause(600);
        $browser->click("#tipo_usuario");

        $browser->waitUntilMissingText('Seleccione el Tipo de Usuario',10);
    }
}
