<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatArrendador extends Model
{
    use SoftDeletes;

    protected $table = 'cat_arrendador';

    protected $primaryKey = 'id_cat_arrendador';

    protected $fillable = [
        'id_usuario', 'admon', 'nombre', 'apellido_paterno', 'apellido_materno', 'calle', 'colonia', 'numero_ext', 'numero_int',
        'estado', 'ciudad', 'codigo_postal', 'entre_calles', 'calle_facturacion', 'colonia_facturacion', 'numero_ext_facturacion',
        'numero_int_facturacion', 'estado_facturacion', 'ciudad_facturacion', 'codigo_postal_facturacion', 'entre_calles_facturacion',
        'rfc', 'estatus'
        ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];

    public function scopeJoinSubCat($query){
        return $query->join('cat_telefono', 'cat_arrendador.id_cat_arrendador', '=', 'cat_telefono.id_arrendador')
            ->join('cat_email', 'cat_arrendador.id_cat_arrendador', '=', 'cat_email.id_arrendador');
    }

}
