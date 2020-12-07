<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUsuario extends Model
{
    use SoftDeletes;

    protected $table = 'tipo_usuario';

    protected $primaryKey = 'id_tipo_usuario';

    protected $fillable = [
        'nombre','estatus'
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];
}
