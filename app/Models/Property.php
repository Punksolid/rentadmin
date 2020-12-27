<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class Property
 * @property integer $lessor_id
 * @package App\Models
 */
class Property extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $table = 'properties';

    protected $fillable = [
//        'lessor_id',
        'property_type_id',
        'state_id',
        'name',
        'energy_fee',
        'water_account_number',
        'estatus',
        'address',
        'predial',
        'maintenance',
        'recibo',
        'water_fee',
        'estatus_renta',
        'geolocation'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

//    public function scopeJoinSubCat($query)
//    {
//        return $query->join('tipo_propiedad', 'cat_fincas.id_tipo_propiedad', '=', 'tipo_propiedad.id_tipo_propiedad')
//            ->join('cat_arrendador', 'cat_fincas.id_arrendador', '=', 'cat_arrendador.id_cat_arrendador');
//    }

    /**
     * One property belongs to a lessor
     * @return BelongsTo
     */
    public function lessor()
    {
        return $this->belongsTo(Lessor::class, 'lessor_id', 'id');
    }

    public function assignLessor(Lessor $lessor): bool
    {
        $this->lessor()->associate($lessor);

        return $this->save();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
}
