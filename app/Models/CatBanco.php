<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatBanco extends Model
{
    use SoftDeletes;

    protected $table = 'cat_banco';

    protected $primaryKey = 'id_banco';

    protected $fillable = [
        'id_arrendador',
        'banco',
        'cuenta',
        'clabe',
        'estatus',
        'nombre_titular'
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];
}
