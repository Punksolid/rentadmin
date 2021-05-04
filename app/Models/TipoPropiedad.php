<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPropiedad extends Model
{
    use SoftDeletes;
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;

    protected $table = 'tipo_propiedad';

    /**
     * @deprecated Leave default id
     */
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
