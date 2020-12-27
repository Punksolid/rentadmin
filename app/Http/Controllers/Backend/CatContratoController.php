<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CatArrendatario;
use App\Models\CatContrato;
use App\Models\Property;
use App\Models\FechaContrato;
use App\Models\Lessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CatContratoController extends Controller
{
    public function index(Request $request){
            $contrato = CatContrato::select('cat_contratos.id_contratos', 'cat_arrendador.nombre AS arrendador_nombre', 'cat_arrendador.apellido_paterno AS arrendador_apellido', 'cat_arrendatario.nombre AS arrendatario_nombre',
                'cat_arrendatario.apellido_paterno AS arrendatario_apellido', 'cat_fincas.finca_arrendada AS propiedad', 'cat_telefono.telefono AS telefono', 'cat_contratos.estatus AS estatus')
                ->joinfechas()
                ->groupBy('id_contratos')
                ->orderBy('id_contratos', 'asc')
                ->paginate(15);
            $this->desactivar();
            return view('contrato.index', ["contrato" => $contrato]);
    }

    public function create(){
        $arrendador = Lessor::orderBy('apellido_paterno', 'asc')->get();;
        $arrendatario = CatArrendatario::orderBy('apellido_paterno', 'asc')->get();;
        $finca = Property::all();
        return view('contrato.create', ["arrendador" => $arrendador, "arrendatario" => $arrendatario, "finca" => $finca]);
    }

    public function store(Request $request){
        $data = $request->all();
        $duracion = $data['duracion_contrato'];
        $contrato = CatContrato::create($data);

         for ($i = 1; $i<=$duracion; $i++){
             $fecha['id_contrato'] = $contrato['id_contratos'];
             $fecha['fecha_inicio'] = $data['fecha_inicio'.$i];
             $fecha['fecha_fin'] = $data['fecha_fin'.$i];
             $fecha['cantidad'] = $data['cantidad'.$i];
             FechaContrato::create($fecha);
         }
         return Redirect::to('contrato');
    }

    public function show($id){
        $co = CatContrato::findOrFail($id);
        return view('contrato.show', ['contrato' => $co]);
    }

    public function edit($id){
        $co = CatContrato::select('cat_contratos.id_contratos', 'cat_arrendador.id_cat_arrendador AS id_arrendador', 'cat_arrendatario.id_cat_arrendatario AS id_arrendatario', 'cat_arrendador.nombre AS arrendador_nombre', 'cat_arrendador.apellido_paterno AS arrendador_apellido',
            'cat_arrendatario.nombre AS arrendatario_nombre', 'cat_arrendatario.apellido_paterno AS arrendatario_apellido', 'cat_contratos.duracion_contrato', 'cat_contratos.bonificacion',
            'cat_contratos.deposito', 'cat_fincas.finca_arrendada AS finca_arrendada', 'cat_fincas.id_cat_fincas AS id_finca')
            ->joinfechas()
            ->findOrFail($id);
        $fe = FechaContrato::where('id_contrato', $id)->get();
        return view('contrato.edit', ['contrato' => $co, 'fechas' => $fe]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $x = $data['duracion_contrato'];
        CatContrato::findOrFail($id)->update($data);
        $contador = FechaContrato::where('id_contrato', $id)->get();
        $num_fechas = count($contador);
        $duracion = ($x-$num_fechas);

        foreach ($contador as $c){
            $id_fechas = $c->id_fechas_contrato;
            $fecha_crear = FechaContrato::findOrFail($id_fechas);
            $crear['fecha_inicio'] = $data['fec_ini'.$id_fechas];
            $crear['fecha_fin'] = $data['fec_fin'.$id_fechas];
            $crear['cantidad'] = $data['canti'.$id_fechas];
            $fecha_crear->update($crear);
        }

        if (isset($data['fecha_inicio1'])){
            for ($i = 1; $i<=$duracion; $i++){
                $fecha['id_contrato'] = $id;
                $fecha['fecha_inicio'] = $data['fecha_inicio'.$i];
                $fecha['fecha_fin'] = $data['fecha_fin'.$i];
                $fecha['cantidad'] = $data['cantidad'.$i];
                FechaContrato::create($fecha);
            }
        }
        return Redirect::to('contrato');
    }

    public function destroy($id){
        $c = CatContrato::findOrFail($id);
        $c->estatus = false;
        $c->update();
        return Redirect::to('contrato');
    }

    public function activar($id){
        $c = CatContrato::findOrFail($id);
        $c->estatus = true;
        $c->update();
        return Redirect::to('contrato');
    }

    public function desactivar(){
        $contrato = CatContrato::all();
        foreach ($contrato as $con){
            $data = ['estatus_renta' => 'Rentada'];
            $finca = Property::findOrFail($con->id_finca)->update($data);
        }
    }
}
