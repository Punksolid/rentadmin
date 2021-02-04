<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lessee;
use App\Models\Contract;
use App\Models\Property;
use App\Models\FechaContrato;
use App\Models\Lessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContractsController extends Controller
{
    public function index(Request $request){

        $contracts = Contract::paginate();

        return view('contrato.index', ["contracts" => $contracts ]);
    }

    public function create(){
        $arrendador = Lessor::orderBy('apellido_paterno', 'asc')->get();;
        $arrendatario = Lessee::orderBy('apellido_paterno', 'asc')->get();;
        $properties_availables = Property::whereNull('rented')->where('status',1)->get();

        return view('contrato.create', [
            "arrendador" => $arrendador,
            "arrendatario" => $arrendatario,
            "finca" => $properties_availables
        ]);
    }

    public function store(Request $request){
        $data = $request->all();
        $duracion = $data['duracion_contrato'];
        $contrato = Contract::create($data);

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
        $co = Contract::findOrFail($id);
        return view('contrato.show', ['contrato' => $co]);
    }

    public function edit(Contract $contrato){
        $contract = $contrato;

        $dates = FechaContrato::where('id_contrato', $contract->id)->get();

        return view('contrato.edit', ['contrato' => $contract, 'fechas' => $dates]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $x = $data['duracion_contrato'];
        Contract::findOrFail($id)->update($data);
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
        $c = Contract::findOrFail($id);
        $c->estatus = false;
        $c->update();
        return Redirect::to('contrato');
    }

    public function activar($id){
        $c = Contract::findOrFail($id);
        $c->estatus = true;
        $c->update();
        return Redirect::to('contrato');
    }

    public function desactivar(){
        $contracts = Contract::all();
        foreach ($contracts as $contract){
            $data = ['estatus_renta' => 'Rentada'];
            $finca = Property::findOrFail($contract->id_finca)->update($data);
        }
    }
}
