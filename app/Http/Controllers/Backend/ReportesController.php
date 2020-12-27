<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lessor;
use App\Models\CatArrendatario;
use App\Models\Property;
use App\Models\RegistroRecibo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ReportesController extends Controller
{
    public function index(){
        $arrendador = Lessor::all();
        $arrendatario = CatArrendatario::all();
        $finca = Property::all();

        return view('reportes.index', ["arrendador" => $arrendador, 'arrendatario' => $arrendatario, 'finca' => $finca]);
    }

    public function generarReporte(Request $request){
        File::deleteDirectory(public_path('pdf'));
        File::makeDirectory(public_path('pdf'));

        $data = $request->all();
        if ($data['fechauno'] == null){
            $filtros['fechauno'] = null;
        }else {
            $filtros['fechauno'] = str_replace('-', '/', Carbon::createFromFormat('Y-m-d', $data['fechauno'])->format('d-m-Y'));
        }
        if ($data['fechados'] == null){
            $filtros['fechados'] = null;
        }else {
            $filtros['fechados'] = str_replace('-', '/', Carbon::createFromFormat('Y-m-d', $data['fechados'])->format('d-m-Y'));
        }
        if ($data['pendiente'] == 'true'){
            $filtros['estatus_pago'] = 'Pendiente';
        }
        if ($data['pagado'] == 'true'){
            $filtros['estatus_pago'] = 'Pagado';
        }
        if ($data['todos'] == 'true'){
            $filtros['estatus_pago'] = 'Todos';
        }
        if ($data['arrendador'] != null){
            $arrendador = Lessor::findOrFail($data['arrendador']);
            $filtros['arrendador'] = $arrendador->nombre.' '.$arrendador->apellido_paterno.' '.$arrendador->apellido_materno;
        }
        if ($data['propiedad'] != null){
            $inmueble = Property::findOrFail($data['propiedad']);
            $filtros['propiedad'] = $inmueble->finca_arrendada;
        }
        if ($data['arrendatario'] != null){
            $arrendatario = CatArrendatario::findOrFail($data['arrendatario']);
            $filtros['arrendatario'] = $arrendatario->nombre.' '.$arrendatario->apellido_paterno.' '.$arrendatario->apellido_materno;
        }

        $registro = RegistroRecibo::select('cat_fincas.finca_arrendada', 'estatus_pago', 'registro_recibos.mes AS mes_recibo', 'usuarios.nombre AS nombre', 'fecha_pago',
            'cat_contratos.id_contratos', 'registro_recibos.total', 'cat_contratos.id_arrendador', 'cat_contratos.id_finca',
            'cat_contratos.id_arrendatario', DB::raw('DATE_FORMAT(registro_recibos.created_at, "%Y-%m-%d") as date'));
        if ($data['pendiente'] == 'true'){
            $registro->where('estatus_pago', 0);
        }
        if ($data['pagado'] == 'true'){
            $registro->where('estatus_pago', 1);
        }
        if ($data['arrendatario'] != null){
            $registro->where('cat_contratos.id_arrendatario', $data['arrendatario']);
        }
        if ($data['arrendador'] != null){
            $registro->where('cat_contratos.id_arrendador', $data['arrendador']);
        }
        if ($data['propiedad'] != null){
            $registro->where('cat_contratos.id_finca', $data['propiedad']);
        }
        if ($data['fechauno'] == null && $data['fechados'] != null){
            $registro->where(DB::raw('DATE_FORMAT(registro_recibos.created_at, "%Y-%m-%d")'), '<=', $data['fechados']);
        }
        if ($data['fechauno'] != null && $data['fechados'] == null){
            $registro->where(DB::raw('DATE_FORMAT(registro_recibos.created_at, "%Y-%m-%d")'), '>=', $data['fechauno']);
        }
        if ($data['fechauno'] != null && $data['fechados'] != null){
            $registro->where(DB::raw('DATE_FORMAT(registro_recibos.created_at, "%Y-%m-%d")'), '<=', $data['fechados'])->where(DB::raw('DATE_FORMAT(registro_recibos.created_at, "%Y-%m-%d")'), '>=', $data['fechauno']);
        }

        $registro = $registro->joinContrato()->orderBy('estatus_pago', 'asc')->get();

        $view = View::make('pdf.reporte', ['filtros' => $filtros, 'registro' => $registro])->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'landscape');
        $pdf->loadHTML($view);
        $dompdf = $pdf->output();
        $nombre = base64_encode($dompdf);

        return response()->json($nombre, 200);
    }
}
