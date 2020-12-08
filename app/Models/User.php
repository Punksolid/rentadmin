<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuarios';

    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno', 'email', 'password', 'id_tipo_usuario','estatus'
    ];

    protected $hidden = [
        'password','created_at','updated_at', 'deleted_at'
    ];
}
