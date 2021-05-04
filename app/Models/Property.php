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
    public const RECIBO_STRING_FISCAL_VALUE = 'Fiscal';
    public const RECIBO_STRING_NO_FISCAL_VALUE = 'No Fiscal';
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;


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
        'rented',
        'geolocation'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function getRentedAttribute($value): bool
    {
        return (bool)$value;
    }

    /**
     * One property belongs to a lessor
     * @return BelongsTo
     */
    public function lessor()
    {
        return $this->belongsTo(Lessor::class, 'lessor_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TipoPropiedad::class,'property_type_id');
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

    public function scopeAvailables($query)
    {
        return $query->active()->notRented();
    }

    public function scopeNotRented($query)
    {
        return $query->whereNull('rented');
    }
}
