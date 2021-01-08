<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lessor;


use App\Models\Lessee;



use App\Models\CatContrato;
use App\Models\Property;use App\Models\FechaContrato;
use App\Models\RegistroRecibo;
use Carbon\Carbon;
use iio\libmergepdf\Merger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use File;

class RecibosAutomaticosController extends Controller
{
    //Pantalla principal
    public function index(){
        $arrendador = Lessor::orderBy('apellido_paterno', 'asc')->get();
        $arrendatario = Lessee::orderBy('apellido_paterno', 'asc')->get();
        $finca = Property::all();
        $fecha = Carbon::now()->format('m');
        if ($fecha>=12){
            $uno = $fecha-11;
        }else{
            $uno = $fecha+1;
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

        return view('recibos.create', ["arrendador" => $arrendador, "mesuno" => $mes, "mesdos" => $mes_dos, 'arrendatario' => $arrendatario, 'finca' => $finca]);
    }

    public function reciboParcial(Request $request){
        $data = $request->all();
        $arrendador = Lessor::findOrFail($data['id_arrendador']);
        $finca = Property::findOrFail($data['id_finca']);
        $arrendatario = Lessee::findOrFail($data['id_arrendatario']);
        $contrato = CatContrato::where('id_arrendador', $arrendador->id_cat_arrendador)->where('id_finca', $finca->id_cat_fincas)->where('id_arrendatario', $arrendatario->id_cat_arrendatario)->first();

        $cuota = str_replace(['$', ',', '.00'], '', $finca->cuota_agua);
        $mante = str_replace(['$', ',', '.00'], '', $finca->mantenimiento);
        $bonif = str_replace(['$', ',', '.00'], '', $data['bonificacion']);
        $dataTotal = str_replace(['$', ',', '.00'], '', $data['total']);
        $total = ($cuota + $mante + $dataTotal)-$bonif;

        $datos['arrendatario'] = $arrendatario->nombre . ' ' . $arrendatario->apellido_paterno . ' ' . $arrendatario->apellido_materno;
        $datos['finca_arrendada'] = $finca->finca_arrendada;
        $datos['dias'] = $data['dias'];
        $datos['mes'] = strtoupper($data['mes']);
        $datos['mantenimiento'] = $finca->mantenimiento;
        $datos['cuota_agua'] = $finca->cuota_agua;
        $datos['importe'] = $data['total'];
        $datos['bonificacion'] = $data['bonificacion'];
        $datos['total'] = $this->toMoney($total);
        $datos['observacion'] = '';
        $datos['aviso'] = '';

        $registro['id_usuario'] = auth()->user()->getAuthIdentifier();
        $registro['id_contrato'] = $contrato->id_contratos;
        $registro['observaciones'] = null;
        $registro['aviso'] = null;
        $registro['mes'] = $data['mes'];
        $registro['total'] = $this->toMoney($total);
        $registro['bonificacion'] = $data['bonificacion'];
        if ($finca->recibo == 'Fiscal'){
            $registro['recibo'] = 'Fiscal';
        }else{
            $registro['recibo'] = 'No Fiscal';
        }
        $validar = RegistroRecibo::where('id_contrato', $contrato->id_contratos)->where('id_usuario', $registro['id_usuario'])->where('mes', $registro['mes'])->first();
        if (isset($validar)){ }else {
            RegistroRecibo::create($registro);
        }


        $cantidad = strtoupper(CifrasEnLetras::convertirNumeroEnLetras($total)) . " 00/100 M.N";
        $customPaper = array(0, 0, 612, 792);
        $view = View::make('pdf.parcial', ['data' => $datos, "cantidad" => $cantidad])->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper($customPaper);
        $pdf->loadHTML($view);
        $dompdf = $pdf->stream();
        $obj = base64_encode($dompdf);

        return response()->json($obj, 200);

    }

    public function controlImp($id){
        $registro = RegistroRecibo::findOrFail($id);
        $contrato = CatContrato::findOrFail($registro->id_contrato);
        $finca = Property::findOrFail($contrato->id_finca);
        $arrendatario = Lessee::findOrFail($contrato->id_arrendatario);

        if ($registro->deposito == 'true' || $registro->complemento == 'true'){
            if ($registro->deposito == 'true'){
                $total = str_replace(['$', ',', '.00'], '', $registro->total);
                $datos['recibo'] = $finca->recibo;
                $datos['arrendatario'] = $arrendatario->nombre . ' ' . $arrendatario->apellido_paterno . ' ' . $arrendatario->apellido_materno;
                $datos['finca_arrendada'] = $finca->finca_arrendada;
                $datos['mes'] = $registro->mes;
                $datos['total'] = $registro->total;
                $datos['aviso'] = $registro->aviso;
                $datos['deposito'] = 'true';

                $cantidad = strtoupper(CifrasEnLetras::convertirNumeroEnLetras($total)) . " 00/100 M.N";
                $customPaper = array(0, 0, 612, 792);
                $view = View::make('pdf.control', ['data' => $datos, "cantidad" => $cantidad])->render();
                $pdf = App::make('dompdf.wrapper');
                $pdf->setPaper($customPaper);
                $pdf->loadHTML($view);
                $dompdf = $pdf->stream();

                return $dompdf;

            }
            if ($registro->complemento == 'true'){
                $total = str_replace(['$', ',', '.00'], '', $registro->total);
                $datos['recibo'] = $finca->recibo;
                $datos['arrendatario'] = $arrendatario->nombre . ' ' . $arrendatario->apellido_paterno . ' ' . $arrendatario->apellido_materno;
                $datos['finca_arrendada'] = $finca->finca_arrendada;
                $datos['mes'] = $registro->mes;
                $datos['total'] = $registro->total;
                $datos['aviso'] = $registro->aviso;
                $datos['complemento'] = 'true';

                $cantidad = strtoupper(CifrasEnLetras::convertirNumeroEnLetras($total)) . " 00/100 M.N";
                $customPaper = array(0, 0, 612, 792);
                $view = View::make('pdf.control', ['data' => $datos, "cantidad" => $cantidad])->render();
                $pdf = App::make('dompdf.wrapper');
                $pdf->setPaper($customPaper);
                $pdf->loadHTML($view);
                $dompdf = $pdf->stream();

                return $dompdf;

            }

        } else{
            $total = str_replace(['$', ',', '.00'], '', $registro->total);
            $cuota = str_replace(['$', ',', '.00'], '', $finca->cuota_agua);
            $mante = str_replace(['$', ',', '.00'], '', $finca->mantenimiento);
            $bonif = str_replace(['$', ',', '.00'], '', $registro->bonificacion);
            $importe = $total - $cuota - $mante + $bonif;
            $subtotal = $importe - $bonif;

            $datos['recibo'] = $finca->recibo;
            $datos['arrendatario'] = $arrendatario->nombre . ' ' . $arrendatario->apellido_paterno . ' ' . $arrendatario->apellido_materno;
            $datos['finca_arrendada'] = $finca->finca_arrendada;
            $datos['mes'] = $registro->mes;
            $datos['mantenimiento'] = $finca->mantenimiento;
            $datos['cuota_agua'] = $finca->cuota_agua;
            $datos['importe'] = $this->toMoney($importe);
            $datos['bonificacion'] = $registro->bonificacion;
            $datos['subtotal'] = $this->toMoney($subtotal);
            $datos['total'] = $registro->total;
            $datos['observacion'] = $registro->observaciones;
            $datos['aviso'] = $registro->aviso;

            $cantidad = strtoupper(CifrasEnLetras::convertirNumeroEnLetras($total)) . " 00/100 M.N";
            $customPaper = array(0, 0, 612, 792);
            $view = View::make('pdf.invoice', ['data' => $datos, "cantidad" => $cantidad])->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->setPaper($customPaper);
            $pdf->loadHTML($view);
            $dompdf = $pdf->stream();

            return $dompdf;
        }

    }

    //Genera los recibos PDF y crea Registro de Recibo
    public function generar(Request $request)
    {
        $data = $request->all();
        $fecha_inicio = Carbon::create(9999)->format('Y/m/d');
        $fecha_fin = Carbon::create(0000)->format('Y/m/d');
        $hoy = Carbon::now()->format('Y-m-d');

        for ($i = 0; $i <= $data['contador']; $i++) {
            if (isset($data['id_contrato' . $i])) {
                $contrato = CatContrato::findOrFail($data['id_contrato' . $i]);
                $fechas = FechaContrato::where('id_contrato', $data['id_contrato' . $i])->get();
                $arrendatario = Lessee::where('id_cat_arrendatario', $contrato->id_arrendatario)->first();
                $finca = Property::where('id_cat_fincas', $contrato->id_finca)->first();


                foreach ($fechas as $fec) {
                    if ($fecha_inicio >= $fec->fecha_fin && $fec->fecha_fin >= $hoy) {
                        $fecha_inicio = $fec->fecha_fin;
                        $prueba = Carbon::createFromFormat('Y-m-d', $fecha_inicio)->subMonth()->monthName;
                    }
                    if ($fecha_fin <= $fec->fecha_fin){
                        $fecha_fin = $fec->fecha_fin;
                    }
                }

                //Aviso de renovacion
                if (Carbon::createFromFormat('Y-m-d', $fecha_fin)->subMonth()->monthName == Carbon::now()->monthName){
                    $datos['aviso'] = 'El proximo mes finalizará el contrato';
                    $registro['aviso'] = $datos['aviso'];
                }else{
                    $test = true;
                }

                //Aviso de aumento
                if ($hoy <= $fecha_inicio && strtolower($data['mes']) == $prueba && isset($test)) {
                    $datos['aviso'] = "El proximo mes se aumentara la renta";
                    $registro['aviso'] = $datos['aviso'];
                }

                $fechaContrato = FechaContrato::where('fecha_fin', $fecha_inicio)->where('id_contrato', $contrato->id_contratos)->first();

                //Actualizar deposito al completar el año y si no es fiscal imprimir en el mismo
                if (Carbon::createFromFormat('Y-m-d', $fecha_inicio)->monthName == Carbon::now()->monthName && Carbon::now()->monthName == strtolower($data['mes'])) {
                    $fechadif = FechaContrato::where('fecha_fin', $fecha_inicio)->where('id_contrato', $data['id_contrato' . $i])->first();
                    $contratodif = CatContrato::findOrFail($fechadif->id_contrato);
                    $valorUno = str_replace(['$', ',', '.00'], '', $fechadif->cantidad);
                    $valorDos = str_replace(['$', ',', '.00'], '', $contratodif->deposito);
                    $diferencia = $valorUno - $valorDos;
                    $suma = $valorDos + $diferencia;
                    $actual['deposito'] = $this->toMoney($suma);
                    $contratodif->update($actual);
                    $datos['complemento'] = $this->toMoney($diferencia);
                    $datos['cantidad_dif'] = strtoupper(CifrasEnLetras::convertirNumeroEnLetras($diferencia))." 00/100 M.N";
                }

                if ($fechaContrato) {
                    $id_contrato = $contrato->id_contratos;
                    $contar_registro = count(RegistroRecibo::where('id_contrato', $id_contrato)->get());
                    $bonificacion = str_replace(['$', ',', '.00'], '', $contrato->bonificacion);
                    $importe = str_replace(['$', ',', '.00'], '', $fechaContrato->cantidad);
                    $subtotal = $importe - $bonificacion;
                    $mantenimiento = str_replace(['$', ',', '.00'], '', $finca->mantenimiento);
                    $cuota = str_replace(['$', ',', '.00'], '', $finca->cuota_agua);
                    if (isset($datos['complemento']) && $finca->recibo == 'No Fiscal') {
                        $total = $subtotal + $mantenimiento + $cuota + $diferencia;
                    } else {
                        $total = $subtotal + $mantenimiento + $cuota;
                    }

                    if ($contar_registro < 1 ){
                        if ($finca->recibo == 'Fiscal') {
                            $datos['deposito'] = $contrato->deposito;
                            $numero = str_replace(['$', ',', '.00'], '', $contrato->deposito);
                            $datos['deposito_letra'] = strtoupper(CifrasEnLetras::convertirNumeroEnLetras($numero)) . " 00/100 M.N";
                            $datos['deposito_check'] = $this->toMoney($numero);
                        }
                        if ($finca->recibo == 'No Fiscal'){
                            $numero = str_replace(['$', ',', '.00'], '', $contrato->deposito);
                            $total = $total + $numero;
                            $datos['deposito_nel'] = $contrato->deposito;
                        }
                    }

                    $datos['recibo'] = $finca->recibo;
                    $datos['arrendatario'] = $arrendatario->nombre . ' ' . $arrendatario->apellido_paterno . ' ' . $arrendatario->apellido_materno;
                    $datos['finca_arrendada'] = $finca->finca_arrendada;
                    $datos['mes'] = $data['mes'];
                    $datos['mantenimiento'] = $finca->mantenimiento;
                    $datos['cuota_agua'] = $finca->cuota_agua;
                    $datos['importe'] = $this->toMoney($fechaContrato->cantidad);
                    $datos['bonificacion'] = $contrato->bonificacion;
                    $datos['subtotal'] = $this->toMoney($subtotal);
                    $datos['total'] = $this->toMoney($total);
                    $datos['observacion'] = $data['contrato_observacion' . $i];

                    $fecha_inicio = Carbon::create(9999)->format('Y/m/d');

                    $cantidad = strtoupper(CifrasEnLetras::convertirNumeroEnLetras($total)) . " 00/100 M.N";
                    $customPaper = array(0, 0, 612, 792);
                    $view = View::make('pdf.invoice', ['data' => $datos, "cantidad" => $cantidad])->render();
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->setPaper($customPaper);
                    $pdf->loadHTML($view);
                    $pdf->save(storage_path('app/public/').$i.'.pdf');
                    $obj[$i] = storage_path('app/public/').$i.'.pdf';

                    $user = auth()->user();
                    if (isset($datos['deposito_nel'])){
                        $registro['deposito'] = $datos['deposito_nel'];
                    }
                    if (isset($datos['complemento'])){
                        $registro['complemento'] = $datos['complemento'];
                    }
                    $registro['recibo'] = $finca->recibo;
                    $registro['id_contrato'] = $contrato->id_contratos;
                    $registro['observaciones'] = $datos['observacion'];
                    $registro['mes'] = $datos['mes'];
                    $registro['id_usuario'] = $user->id_usuarios;
                    $registro['total'] = $datos['total'];
                    $registro['bonificacion'] = $datos['bonificacion'];
                    $validar = RegistroRecibo::where('id_contrato', $registro['id_contrato'])->where('id_usuario', $registro['id_usuario'])->where('mes', $registro['mes'])->first();
                    if (isset($validar)){ }else {
                        RegistroRecibo::create($registro);
                    }
                    if ($finca->recibo == 'Fiscal' && isset($datos['deposito_check'])){
                        $deposito['recibo'] = $finca->recibo;
                        $deposito['deposito'] = 'true';
                        $deposito['id_contrato'] = $contrato->id_contratos;
                        $deposito['observaciones'] = 'Recibo por deposito en garantia';
                        $deposito['mes'] = $datos['mes'];
                        $deposito['id_usuario'] = $user->id_usuarios;
                        $deposito['total'] = $datos['deposito_check'];
                        RegistroRecibo::create($deposito);

                    }
                    if ($finca->recibo == 'Fiscal' && isset($datos['complemento'])){
                        $deposito['recibo'] = $finca->recibo;
                        $deposito['complemento'] = 'true';
                        $deposito['id_contrato'] = $contrato->id_contratos;
                        $deposito['observaciones'] = 'Recibo por complemento de deposito';
                        $deposito['mes'] = $datos['mes'];
                        $deposito['id_usuario'] = $user->id_usuarios;
                        $deposito['total'] = $datos['complemento'];
                        RegistroRecibo::create($deposito);

                    }

                }
            }

            $datos['aviso'] = '';
            $registro['aviso'] = $datos['aviso'];
        }

        $combinar = new Merger();
        foreach ($obj as $opdf){
            $combinar->addFile($opdf);

        }
        $file = $combinar->merge();
        $dompdf = base64_encode($file);

        Storage::deleteDirectory('public');
        Storage::makeDirectory('public');
        return response()->json($dompdf, 200);
    }

    //Muestra todos los recibos. Peticion AJAX
    public function registroRecibo(Request $request){
        $data = $request->all();
        $registro = RegistroRecibo::select('cat_fincas.finca_arrendada', 'estatus_pago', 'registro_recibos.mes AS mes_recibo', 'usuarios.nombre AS nombre', 'fecha_pago',
            'cat_contratos.id_contratos', 'registro_recibos.total', 'cat_contratos.id_arrendador', 'cat_contratos.id_finca', 'id_registro_recibos',
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

        return response()->json($registro, 200);
    }

    //Muestra la vista previa de un registro de recibo
    public function vistaRecibo($id){
        $registro = RegistroRecibo::select('cat_arrendador.nombre AS nombre_arrendador', 'cat_arrendador.apellido_paterno AS paterno_arrendador', 'cat_arrendador.apellido_materno AS materno_arrendador',
            'cat_arrendatario.nombre AS nombre_arrendatario', 'cat_arrendatario.apellido_paterno AS paterno_arrendatario', 'cat_arrendatario.apellido_materno AS materno_arrendatario', 'registro_recibos.id_registro_recibos AS id',
            'registro_recibos.mes AS mes', 'cat_fincas.finca_arrendada', 'registro_recibos.estatus_pago', 'observaciones', 'usuarios.nombre AS nombre_usuario', 'registro_recibos.total AS total', 'fecha_pago')
            ->joinContrato()
            ->where('id_registro_recibos', $id)
            ->first();

        return view('recibos.reporte', ['recibo' => $registro]);
    }

    //Actualiza el pago del recibo ya generado. Peticion AJAX
    public function actualizarRecibo(Request $request, $id){
        $data = $request->all();
        if ($data['estatus_pago'] == 'on' || $data['estatus_pago'] == true){
            $data['estatus_pago'] = 1;
        }else{
            $data['estatus_pago'] = 0;
        }
        $recibo = RegistroRecibo::findOrFail($id);
        if ($recibo->activo == 0) {
            $recibo->update($data);
            return response()->json('Se ha actualizado el pago', 200);
        }else{
            return response()->json('Ya se ha pagado este recibo y no se puede cambiar el estado actual del mismo', 401);
        }

    }

    //Muestra el arrendatario en filtro. Peticion AJAX
    public function filtroArrendatario(Request $request){
        $data = $request->all();
        $contrato = CatContrato::where('id_arrendador', $data['id_arrendador'])->where('id_finca', $data['id_propiedad'])->first();
        $fecha = FechaContrato::where('id_contrato', $contrato->id_contratos)->first();
        if (isset($contrato)) {
        $id = $contrato->id_arrendatario;
        $arrendatario = Lessee::findOrFail($id);
        $nombre['nombre'] = $arrendatario->id_cat_arrendatario.'-. '.$arrendatario->nombre.' '.$arrendatario->apellido_paterno.' '.$arrendatario->apellido_materno;
        $nombre['id'] = $id;
        $nombre['importe'] = $this->toMoney($fecha->cantidad);
        $nombre['bonificacion'] = $contrato->bonificacion;
            return response()->json($nombre, 200);
        }else{
            return response()->json('No hay recibo generado', 404);
        }
    }

    //Muestra todos los contratos. Peticion AJAX
    public function contrato($id){
        $contrato = CatContrato::select('cat_contratos.id_contratos', 'cat_arrendatario.nombre', 'cat_arrendatario.apellido_paterno', 'cat_arrendatario.apellido_materno', 'cat_fincas.finca_arrendada')
            ->join('cat_arrendatario', 'id_cat_arrendatario', '=', 'id_arrendatario')
            ->join('cat_fincas', 'id_cat_fincas', '=', 'id_finca')
            ->where('cat_contratos.id_arrendador', $id)
            ->get();
        return response()->json($contrato,200);
    }

    //Le da formato de moneda a numeros enteros.
    public function toMoney($val,$symbol='$',$r=2){
        $n = $val;
        $c = is_float($n) ? 1 : number_format($n,$r);
        $d = '.';
        $t = ',';
        $sign = ($n < 0) ? '-' : '';
        $i = $n=number_format(abs($n),$r);
        $j = (($j = strlen($i)) > 3) ? $j % 3 : 0;
        return  $symbol.$sign .($j ? substr($i,0, $j) : '').preg_replace('/(\d{3})(?=\d)/', "$1" . $t,substr($i,$j)) ;
    }

}
class Nombre{
    private $nombre;

    public function __construct($nombre){
        $this->nombre = $nombre;
    }
    public function getDir(){
        return $this->nombre;
    }
}
