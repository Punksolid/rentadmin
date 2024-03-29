<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/** Guarantor */
class Guarantor extends Model implements Phoneable, HasMedia
{
    use SoftDeletes, HasPhones, InteractsWithMedia;
    public const STATUS_ACTIVE = true;
    public const STATUS_INACTIVE = false;

    protected $fillable = [
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
        'estatus',
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
        'created_at','updated_at', 'deleted_at'
    ];

    public function phones()
    {
        return $this
            ->morphMany(CatTelefono::class, 'phoneable')
            ->orWhere('id_fiador',$this->id);
    }

    public function lessee()
    {
        return $this->belongsTo(Lessee::class, 'id', 'id_fiador');
    }
}
