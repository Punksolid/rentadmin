<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatTelefono extends Model
{
    use SoftDeletes;

    public const ACTIVE_STATUS = 1;
    public const INACTIVE_STATUS = 0;

    protected $table = 'phone_numbers';

    protected $primaryKey = 'id_telefono';

    protected $fillable = [
        'id_arrendador',
        'id_arrendatario',
        'id_fiador',
        'telefono',
        'estatus',
        'descripcion'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    #Relationship
    public function phoneable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('estatus',1);
    }
}
