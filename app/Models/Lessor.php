<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CatTelefono as PhoneNumber;

/**
 * Class Lessor aka ARRENDADOR
 * @package App\Models
 */
class Lessor extends Model implements Phoneable
{
    use SoftDeletes;
    use HasPhones;

    const ACTIVE_STATUS = 1;
    const INACTIVE_STATUS = 0;

    protected $fillable = [
        'admon',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'calle',
        'colonia',
        'numero_ext',
        'numero_int',
        'estado',
        'ciudad',
        'codigo_postal',
        'entre_calles',
        'calle_facturacion',
        'colonia_facturacion',
        'numero_ext_facturacion',
        'numero_int_facturacion',
        'estado_facturacion',
        'ciudad_facturacion',
        'codigo_postal_facturacion',
        'entre_calles_facturacion',
        'rfc',
        'estatus'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function scopeJoinSubCat($query)
    {
        return $query->join('cat_telefono', 'cat_arrendador.id_cat_arrendador', '=', 'cat_telefono.id_arrendador')
            ->join('cat_email', 'cat_arrendador.id_cat_arrendador', '=', 'cat_email.id_arrendador');
    }

    public function emails()
    {
        return $this->hasMany(CatEmail::class,'id_arrendador');
    }

    public function defaultEmail()
    {
        return $this->emails()->first();
    }

    public function phones()
    {
        return $this->morphMany(CatTelefono::class, 'phoneable')
            ->orWhere('id_arrendador',$this->id);
    }
}
