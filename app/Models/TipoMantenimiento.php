<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoMantenimiento extends Model
{
    use SoftDeletes;

    protected $table = 'tipo_mantenimiento';

    protected $primaryKey = 'id_tipo_mantenimiento';

    protected $fillable = [
        'tipo_mantenimiento', 'estatus',
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];
}
