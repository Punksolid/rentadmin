<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/** Arrendatario */
class Lessee extends Model implements Phoneable, HasMedia
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    use SoftDeletes;
    use HasPhones;
    use InteractsWithMedia;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'id_fiador',
        'puesto',
        'estatus',
        'calle',
        'colonia',
        'numero_ext',
        'numero_int',
        'estado',
        'ciudad',
        'codigo_postal',
        'entre_calles',
        'calle_trabajo',
        'colonia_trabajo',
        'numero_ext_trabajo',
        'numero_int_trabajo',
        'estado_trabajo',
        'ciudad_trabajo',
        'codigo_postal_trabajo',
        'entre_calles_trabajo'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function scopeJoinSubCat($query)
    {
        return $query->join('cat_telefono', 'lessees.id', '=', 'phone_numbers.id_arrendatario')
            ->join('cat_email', 'lessees.id', '=', 'cat_email.id_arrendatario');
    }

    public function scopeActive($query)
    {
        return $query->where('estatus', self::STATUS_ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('estatus', self::STATUS_INACTIVE);
    }

    public function phones()
    {
        return $this->morphMany(CatTelefono::class, 'phoneable')
            ->orWhere('id_arrendatario', $this->id);
    }

    public function defaultPhoneNumber(): ?CatTelefono
    {
        return $this->phones()->first();
    }

    public function emails()
    {
        return $this->hasMany(CatEmail::class,'id_arrendatario');
    }

    public function defaultEmail()
    {
        return $this->emails()->first();
    }

    public function guarantor()
    {
        return $this->belongsTo(CatFiador::class, 'id_fiador', 'id_cat_fiadores');
    }
}
