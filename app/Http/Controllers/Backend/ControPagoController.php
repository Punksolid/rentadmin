<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lessor;


use App\Models\CatArrendatario;



use App\Models\Property;
use Illuminate\Http\Request;

class ControPagoController extends Controller
{
    public function index()
    {
        $arrendador = Lessor::orderBy('apellido_paterno', 'asc')->get();
        $arrendatario = CatArrendatario::orderBy('apellido_paterno', 'asc')->get();
        $finca = Property::all();
        return view('recibos.control', ["arrendador" => $arrendador, 'arrendatario' => $arrendatario, 'finca' => $finca]);
    }
}
