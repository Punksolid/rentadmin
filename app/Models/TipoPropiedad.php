<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPropiedad extends Model
{
    use SoftDeletes;
    const STATUS_INACTIVE = 0;
    protected $table = 'tipo_propiedad';

    protected $primaryKey = 'id_tipo_propiedad';

    protected $fillable = [
        'tipo_propiedad', 'estatus'
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];

    public function scopeActive($query)
    {
        return $query->where('estatus', '<>', self::STATUS_INACTIVE);
    }
}
