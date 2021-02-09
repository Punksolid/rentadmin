<?php

namespace Tests\Feature;

use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUsersSecurityModuleCanBeSeen()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('usuarios.index'));

        $response->assertStatus(200);
    }

    public function testRegisterNewUser()
    {
        $this->withoutExceptionHandling();

        $form = [
            'password' => 'password',
            'nombre' => $this->faker->name,
            'email' => $this->faker->email,
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->lastName,
            'id_tipo_usuario' => factory(TipoUsuario::class)->create()->id_tipo_usuario // @todo change to normal id field
        ];

        $call = $this->post(route('usuarios.store'),$form);

        $call->assertRedirect(route('usuarios.index'));

        $this->assertDatabaseHas('users', ['name' => $form['nombre']]);
        $user = User::where('email', $form['email'])->first();

        $this->assertEquals($form['nombre'], $user->name);
        $this->assertEquals($form['apellido_paterno'], $user->profile->apellido_paterno);
        $this->assertEquals($form['apellido_materno'], $user->profile->apellido_materno);
    }
}
