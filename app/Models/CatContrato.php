<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatContrato extends Model
{
    use SoftDeletes;

    protected $table = 'cat_contratos';

    protected $primaryKey = 'id_contratos';

    protected $fillable = [
        'id_arrendador',
        'id_arrendatario',
        'id_finca',
        'duracion_contrato',
//        'aumento',
//        'fecha_inicio',
//        'fecha_fin',
        'bonificacion',
        'deposito',
        'estatus'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'
    ];

    public function scopeJoinFechas($query)
    {
        return $query->join('lessors', 'cat_contratos.id_arrendador', '=', 'lessors.id')
            ->join('lessees', 'cat_contratos.id_arrendatario', '=', 'lessees.id')
            ->join('properties', 'cat_contratos.id_finca', '=', 'properties.id')
            ->join('phone_numbers', 'lessees.id', '=', 'phone_numbers.id_arrendatario');
    }
}
