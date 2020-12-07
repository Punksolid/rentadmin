<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatEmail extends Model
{
    use SoftDeletes;

    protected $table = 'cat_email';

    protected $primaryKey = 'id_email';

    protected $fillable = [
        'id_arrendador', 'id_arrendatario', 'email', 'estatus'
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];
}
