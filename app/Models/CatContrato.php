<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatContrato extends Model
{
    use SoftDeletes;

    protected $table = 'cat_contratos';

    protected $primaryKey = 'id_contratos';

    protected $fillable = [ 'id_contratos', 'id_arrendador', 'id_arrendatario', 'id_finca', 'duracion_contrato', 'aumento', 'fecha_inicio',
        'fecha_fin', 'bonificacion', 'deposito', 'estatus'
    ];

    protected $hidden = [ 'created_at','updated_at', 'deleted_at'
    ];

    public function scopeJoinFechas($query){
        return $query->join('cat_arrendador', 'cat_contratos.id_arrendador', '=', 'cat_arrendador.id_cat_arrendador')
            ->join('cat_arrendatario', 'cat_contratos.id_arrendatario', '=', 'cat_arrendatario.id_cat_arrendatario')
            ->join('cat_fincas', 'cat_contratos.id_finca', '=', 'cat_fincas.id_cat_fincas')
            ->join('cat_telefono', 'cat_arrendatario.id_cat_arrendatario', '=', 'cat_telefono.id_arrendatario');
    }
}
