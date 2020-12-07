<?php

namespace App\Http\Controllers\Backend;
use App\Models\Mantenimiento;
use App\Models\CatFinca;
use App\Models\User;
use App\Models\TipoMantenimiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class MantenimientoController extends Controller
{
    public function index(){
        $mantenimientos = Mantenimiento::orderBy('estatus', 'desc')
        ->paginate(15);
        return view('mantenimiento.index', ['mantenimientos' => $mantenimientos]);
    }

    public function create(){
        $tp = CatFinca::all();
        $ti = TipoMantenimiento::all();
        return view('mantenimiento.create', ["fincas" => $tp, "tipo" => $ti]);
    }

    public function store(Request $request){
        $data = $request->all();
        $data['id_usuario'] = auth()->user()->getAuthIdentifier();
        Mantenimiento::create($data);
        return Redirect::to('mantenimiento');
    }

    public function show($id){
        //
    }

    public function edit($id){
        $mant = Mantenimiento::findOrFail($id);
        $ti = TipoMantenimiento::all();
        $tp = CatFinca::all();
        return view('mantenimiento.edit', ['mant' => $mant, "tipos" => $ti, "fincas" => $tp]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        if(isset($data['recurrente'])){
            if ($data['recurrente'] == 'on'){
                $data['recurrente'] = true;
            }
        }
        else{
            $data['recurrente'] = false;
            $data['prox_mantenimiento'] = null;
        }

        if($data['estatus_proceso'] == "En Proceso"){
            $data['estatus_proceso'] = false;
        }
        else {
            $data['estatus_proceso'] = true;
        }

        $mante = Mantenimiento::findOrFail($id);
        $mante->update($data);

        return Redirect::to('mantenimiento');
    }

    public function destroy($id){
        $mant = Mantenimiento::findOrFail($id);
        $mant->estatus = 0;
        $mant->update();
        return Redirect::to('mantenimiento');
    }

    public function activar($id){
        $mant = Mantenimiento::findOrFail($id);
        $mant->estatus = 1;
        $mant->update();
        return Redirect::to('mantenimiento');
    }

    public function tipoMantenimiento(Request $request){
        $data = $request->all();
        $tipo = TipoMantenimiento::all();
        foreach ($tipo as $t){
            $nombre = strtoupper($t->tipo_mantenimiento);
            $datos = strtoupper($data['tipo_mantenimiento']);
            if ($nombre == $datos){
                return Redirect::back()->withErrors('Ya existe el tipo de mantenimiento');
            }
        }
        TipoMantenimiento::create($data);

        return Redirect::back();
    }
}
