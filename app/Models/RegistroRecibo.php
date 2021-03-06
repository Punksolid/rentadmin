<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroRecibo extends Model
{
    use SoftDeletes;

    protected $table = 'registro_recibos';

    protected $primaryKey = 'id_registro_recibos';

    protected $fillable = [
        'id_contrato', 'observaciones', 'estatus_pago', 'fecha_pago', 'mes', 'id_usuario', 'total', 'activo',
        'complemento', 'deposito', 'recibo', 'bonificacion'
    ];

    protected $hidden = [
        'updated_at', 'deleted_at'
    ];

    public function scopeJoinContrato($query){
        return $query->join('cat_contratos', 'registro_recibos.id_contrato', '=', 'cat_contratos.id_contratos')
                     ->join('cat_fincas', 'cat_contratos.id_finca', '=', 'properties.id')
                     ->join('cat_arrendatario', 'cat_contratos.id_arrendatario', '=', 'lessees.id')
                     ->join('lessor', 'cat_contratos.id_arrendador', '=', 'lessors.id_cat_arrendador')
                     ->join('usuarios', 'registro_recibos.id_usuario', '=', 'usuarios.id_usuarios');
    }
}
