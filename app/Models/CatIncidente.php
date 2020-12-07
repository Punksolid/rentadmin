<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatIncidente extends Model
{
    use SoftDeletes;

    protected $table = 'cat_incidentes';

    protected $primaryKey = 'id_cat_incidentes';

    protected $fillable = [
        'id_finca', 'id_usuario_inicio', 'id_usuario_fin', 'fecha_reporte', 'reporto', 'incidente', 'area',
        'asignado', 'tel_asignado', 'fecha_asignacion', 'hora', 'solucion', 'fecha_termino', 'estatus_proceso',
        'observaciones', 'estatus', 'costo', 'pago'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
}
