<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lessor;


use App\Models\Lessee;



use App\Models\Contract;
use App\Models\Property;
use App\Models\Configuracion;
use App\Models\FechaContrato;
use App\Models\RegistroRecibo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LiquidacionController extends Controller
{
    public function index(){
        $lessors = Lessor::all();
        $comision = Configuracion::findOrFail(4)->cantidad;
        $retiva = Configuracion::findOrFail(2)->cantidad;
        $retisr = Configuracion::findOrFail(3)->cantidad;
        $fecha = Carbon::now()->format('m');
        if ($fecha>=12){
            $uno = $fecha-11;
            $dos = $fecha+11;

        }else{
            $uno = $fecha+1;
            $dos = $fecha-1;
        }
        switch ($fecha){
            case 1: $mes = 'Enero';
                break;
            case 2: $mes = 'Febrero';
                break;
            case 3: $mes = 'Marzo';
                break;
            case 4: $mes = 'Abril';
                break;
            case 5: $mes = 'Mayo';
                break;
            case 6: $mes = 'Junio';
                break;
            case 7: $mes = 'Julio';
                break;
            case 8: $mes = 'Agosto';
                break;
            case 9: $mes = 'Septiembre';
                break;
            case 10: $mes = 'Octubre';
                break;
            case 11: $mes = 'Noviembre';
                break;
            case 12: $mes = 'Diciembre';
                break;
        }
        switch ($uno){
            case 1: $mes_dos = 'Enero';
                break;
            case 2: $mes_dos = 'Febrero';
                break;
            case 3: $mes_dos = 'Marzo';
                break;
            case 4: $mes_dos = 'Abril';
                break;
            case 5: $mes_dos = 'Mayo';
                break;
            case 6: $mes_dos = 'Junio';
                break;
            case 7: $mes_dos = 'Julio';
                break;
            case 8: $mes_dos = 'Agosto';
                break;
            case 9: $mes_dos = 'Septiembre';
                break;
            case 10: $mes_dos = 'Octubre';
                break;
            case 11: $mes_dos = 'Noviembre';
                break;
            case 12: $mes_dos = 'Diciembre';
                break;
        }
        switch ($dos){
            case 1: $mes_tres = 'Enero';
                break;
            case 2: $mes_tres = 'Febrero';
                break;
            case 3: $mes_tres = 'Marzo';
                break;
            case 4: $mes_tres = 'Abril';
                break;
            case 5: $mes_tres = 'Mayo';
                break;
            case 6: $mes_tres = 'Junio';
                break;
            case 7: $mes_tres = 'Julio';
                break;
            case 8: $mes_tres = 'Agosto';
                break;
            case 9: $mes_tres = 'Septiembre';
                break;
            case 10: $mes_tres = 'Octubre';
                break;
            case 11: $mes_tres = 'Noviembre';
                break;
            case 12: $mes_tres = 'Diciembre';
                break;
        }
        if ($uno <10){
            $uno = '0'.$uno;
        }
        if ($dos <10){
            $dos = '0'.$dos;
        }
        return view('liquidaciones.index', [
            'comision' => $comision,
            'retiva' => $retiva,
            'retisr' => $retisr,
            'arrendador' => $lessors,
            "mesuno" => $mes,
            'num_mes_uno' => $fecha,
            "mesdos" => $mes_dos,
            'num_mes_dos' => $uno,
            "mestres" => $mes_tres ??'',
            'num_mes_tres' => $dos
        ]);
    }

    public function getFinca(Request $request){
        $data = $request->all();

        $finca = Property::where('id_arrendador', $data['id_arrendador'])->get();
        $contrato = Contract::all();
        $fechasContrato = FechaContrato::all();
        $arrendatario = Lessee::all();
        $iva = Configuracion::findOrFail(5)->cantidad;
        $recibos = RegistroRecibo::where('deposito', 'true')->get();

        return response()->json(['finca' => $finca, 'contrato' => $contrato, 'ivacon' => $iva, 'fecha' => $fechasContrato, 'arrendatario' => $arrendatario, 'recibos' => $recibos], 200);
    }
}
