<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatFechasMod extends Model
{
    use SoftDeletes;

    protected $table = 'cat_fechas_mod';

    protected $primaryKey = 'id_fechas';

    protected $fillable = [
        'id_usuario', 'fecha_modificacion', 'tabla_modidificada', 'estatus'
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];
}
