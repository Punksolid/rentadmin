<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MoveUsuariosTableToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $usuarios = DB::table('usuarios')->get();
//        dd($usuarios);
        foreach ($usuarios as $usuario) {
            if (User::whereEmail($usuario->email)->exists()) {
                continue;
            }
            $user = new User();
            $user->name = $usuario->nombre;
            $user->email = $usuario->email;
            $user->password = $usuario->password;
            if ($user->save()) {
                DB::table('usuarios')
                    ->where('id_usuarios', $usuario->id_usuarios)
                    ->delete();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
