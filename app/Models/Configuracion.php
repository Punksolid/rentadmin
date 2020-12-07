<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';

    protected $primaryKey = 'id_configuracion';

    protected $fillable = [ 'nombre', 'cantidad', 'estatus' ];

    protected $hidden = [ 'created_at', 'updated_at' ];
}
