<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatTelefono extends Model
{
    use SoftDeletes;

    protected $table = 'cat_telefono';

    protected $primaryKey = 'id_telefono';

    protected $fillable = [
        'id_arrendador', 'id_arrendatario', 'id_fiador', 'telefono', 'estatus', 'descripcion'
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];
}
