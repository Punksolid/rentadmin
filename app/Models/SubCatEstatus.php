<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCatEstatus extends Model
{
    use SoftDeletes;

    protected $table = 'sub_cat_estados';

    protected $primaryKey = 'id_sub_cat_estados';

    protected $fillable = [
        'estados', 'estatus'
    ];

    protected $hidden = [
        'created_at','updated_at', 'deleted_at'
    ];
}
