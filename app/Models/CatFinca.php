<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatFinca extends Model
{
    use SoftDeletes;

    protected $table = 'cat_fincas';

    protected $primaryKey = 'id_cat_fincas';

    protected $fillable = [
        'id_arrendador',
        'id_tipo_propiedad',
        'id_estados',
        'finca_arrendada',
        'servicio_luz',
        'cta_japac',
        'estatus',
        'descripcion',
        'predial',
        'mantenimiento',
        'recibo',
        'cuota_agua',
        'estatus_renta'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function scopeJoinSubCat($query)
    {
        return $query->join('tipo_propiedad', 'cat_fincas.id_tipo_propiedad', '=', 'tipo_propiedad.id_tipo_propiedad')
            ->join('cat_arrendador', 'cat_fincas.id_arrendador', '=', 'cat_arrendador.id_cat_arrendador');
    }

    /**
     * One property belongs to a lessor
     * @return BelongsTo
     */
    public function lessor()
    {
        return $this->belongsTo(Lessor::class, 'id_arrendador', 'id');
    }

    public function assignLessor(Lessor $lessor): bool
    {
        $this->lessor()->associate($lessor);

        return $this->save();
    }

    public function scopeActive($query)
    {
        return $query->where('estatus', 1);
    }
}
