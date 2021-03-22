<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FechaContrato extends Model
{
    use SoftDeletes;

    protected $table = 'fechas_contrato';

    protected $fillable = [
        'id_contrato',
        'fecha_inicio',
        'fecha_fin',
        'cantidad',
        'anualidad',
        'estatus'];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function contract(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contract::class,'id_contrato', 'id');
    }

}
