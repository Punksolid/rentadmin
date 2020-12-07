<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(SubCatEstadosSeeder::class);
        $this->call(TipoUsuarioSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(ConfiguracionSeeder::class);
    }
}
