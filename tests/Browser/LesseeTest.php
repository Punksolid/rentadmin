<?php

namespace Tests\Browser;

use App\Models\Lessee;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LesseeTest extends DuskTestCase
{
    use WithFaker;
    /**
     * A Dusk test example.
     * @issue 36 Al guardar un arrendatario no se guarda el Teléfono ni correo en la pantalla Arrendatario
     * @return void
     */
    public function testGuardarArrendatarioWithTelefonoAndEmail()
    {

        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->raw();
        $email = $this->faker->email;
        $phone = $this->faker->numerify('##########');

        $this->browse(function (Browser $browser) use ($lessee, $email, $phone){
            $browser->loginAs(User::find(1));
            $browser->visit(route('arrendatario.create'));

            $browser->type('nombre', $lessee['nombre']);
            $browser->type('apellido_paterno', $lessee['apellido_paterno']);
            $browser->type('apellido_materno', $lessee['apellido_materno']);
            $browser->typeSlowly('phone_number[0][telefono]', $phone);
            $browser->type('email[]', $email);
            $browser->type('calle' , $lessee['calle']);
            $browser->type('colonia' , $lessee['colonia']);
            $browser->type('numero_ext' , $lessee['numero_ext']);
            $browser->type('estado' , $lessee['estado']);
            $browser->type('ciudad' , $lessee['ciudad']);
            $browser->type('codigo_postal' , $lessee['codigo_postal']);
            #Trabajo
            $browser->type('calle_trabajo' , $this->faker->streetName);
            $browser->type('colonia_trabajo' , $lessee['colonia_trabajo']);
            $browser->type('numero_ext_trabajo' , $lessee['numero_ext_trabajo']);
            $browser->type('estado_trabajo' , $lessee['estado_trabajo']);
            $browser->type('ciudad_trabajo' , $lessee['ciudad_trabajo']);
            $browser->type('codigo_postal_trabajo' , $lessee['codigo_postal_trabajo']);
            $browser->type('puesto' , $lessee['puesto']);

            $browser->scrollTo('#submit');
            $browser->press('Guardar');

            $browser->assertSee($email);
        });

        $phone = substr_replace($phone, '(', 0, 0);
        $phone = substr_replace($phone, ')', 4, 0);
        $phone = substr_replace($phone, ' ', 5, 0);
        $phone = substr_replace($phone, ' ', 9, 0);

        $lessee = Lessee::where('nombre', $lessee['nombre'])->first();
        $this->assertEquals($email, $lessee->defaultEmail()->email);
        $this->assertEquals($phone, $lessee->defaultPhoneNumber()->telefono);
    }


}
