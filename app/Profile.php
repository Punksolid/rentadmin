<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'usuarios'; //@todo refactor to profiles

    protected $fillable = [
        'apellido_paterno',
        'apellido_materno',
        'id_tipo_usuario',
        'nombre',
        'email',
        'password' // @todo Refactor Delete the needed for this field
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
