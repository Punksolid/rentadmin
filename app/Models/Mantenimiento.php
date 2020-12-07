<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mantenimiento extends Model
{
    use SoftDeletes;

    protected $table = 'mantenimiento';

    protected $primaryKey = 'id_mantenimiento';

    protected $fillable = [
        'id_finca', 'id_usuario', 'id_tipo_mantenimiento', 'descripcion_mantenimiento', 'ubicacion','encargado',
        'tel_encargado','fecha_registro','recurrente','estatus_proceso','observaciones','estatus', 'prox_mantenimiento', 'costo', 'pago'
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];
}
