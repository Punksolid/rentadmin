<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatArrendatario extends Model implements Phoneable
{
    use SoftDeletes;
    use HasPhones;
    protected $table = 'cat_arrendatario';

    protected $primaryKey = 'id_cat_arrendatario';

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
        return $query->join('cat_telefono', 'cat_arrendatario.id_cat_arrendatario', '=', 'cat_telefono.id_arrendatario')
            ->join('cat_email', 'cat_arrendatario.id_cat_arrendatario', '=', 'cat_email.id_arrendatario');
    }

    public function phones()
    {
//        dump($this->id);
        return $this->morphMany(CatTelefono::class, 'phoneable')
            ->orWhere('id_arrendatario', $this->id_cat_arrendatario);
//        return $this->hasMany(CatTelefono::class, 'id_arrendatario')
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
