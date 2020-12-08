<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nombre' => 'Administrador',
            'id_tipo_usuario' => '1',
            'email' => 'admin@diazmezayasociados.com',
            'password' => bcrypt('Diaz1234'),
        ]);
    }
}
