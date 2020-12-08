<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CatArrendador;
use App\Models\CatArrendatario;
use App\Models\CatFinca;
use Illuminate\Http\Request;

class ControPagoController extends Controller
{
    public function index()
    {
        $arrendador = CatArrendador::orderBy('apellido_paterno', 'asc')->get();
        $arrendatario = CatArrendatario::orderBy('apellido_paterno', 'asc')->get();
        $finca = CatFinca::all();
        return view('recibos.control', ["arrendador" => $arrendador, 'arrendatario' => $arrendatario, 'finca' => $finca]);
    }
}
