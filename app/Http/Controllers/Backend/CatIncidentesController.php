<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CatArrendador;
use App\Models\CatFinca;
use App\Models\CatIncidente;
use App\Models\TipoIncidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CatIncidentesController extends Controller
{
    public function index(){
        $incidentes = CatIncidente::orderBy('estatus', 'asc')
            ->paginate(15);
        return view('incidentes.index', ['incidentes' => $incidentes]);
    }

    public function create(){
        $tp = CatFinca::all();
        $arr = CatArrendador::all();
        $ti = TipoIncidente::all();
        return view('incidentes.create', ["propiedad" => $tp, "arrendador" => $arr, "incidente" => $ti]);
    }

    public function store(Request $request){
        $data = $request->all();
        $data['id_usuario_inicio'] = auth()->user()->getAuthIdentifier();
        CatIncidente::create($data);
        return Redirect::to('incidentes');
    }

    public function edit($id){
        $incidente = CatIncidente::findOrFail($id);
        return view('incidentes.edit', ['incidente' => $incidente]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        if ($data['estatus_proceso'] == 'Terminado'){
            $data['estatus_proceso'] = true;
        }else{
            $data['estatus_proceso'] = false;
        }
        $incidente = CatIncidente::findOrFail($id);
        $incidente->update($data);
        return Redirect::to('incidentes');
    }

    public function destroy($id){
        $finca = CatIncidente::findOrFail($id);
        $finca->estatus = false;
        $finca->update();
        return Redirect::to('incidentes');
    }

    public function activar($id){
        $finca = CatIncidente::findOrFail($id);
        $finca->estatus = true;
        $finca->update();
        return Redirect::to('incidentes');
    }

    public function tipoIncidente(Request $request){
        $data = $request->all();
        $tipo = TipoIncidente::all();
        foreach ($tipo as $t){
            $nombre = strtoupper($t->tipo_incidente);
            $datos = strtoupper($data['tipo_incidente']);
            if ($nombre == $datos){
                return Redirect::back()->withErrors('Ya existe el tipo de incidente');
            }
        }
        TipoIncidente::create($data);

        return Redirect::back();
    }
}
