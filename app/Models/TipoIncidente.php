<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoIncidente extends Model
{
    use SoftDeletes;

    protected $table = 'tipo_incidente';

    protected $primaryKey = 'id_tipo_incidente';

    protected $fillable = [
        'tipo_incidente', 'estatus',
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];
}
