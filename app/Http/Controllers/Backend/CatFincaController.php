<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CatFinca;
use App\Models\Lessor;
use App\Models\TipoPropiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CatFincaController extends Controller
{
    public function index(Request $request){
            $finca = CatFinca::
                active()
//            select('id_cat_fincas',
//                'finca_arrendada',
//                'cat_arrendador.nombre AS arrendador',
//                'cat_arrendador.apellido_paterno AS arrendadora',
//                'servicio_luz',
//                'cta_japac',
//                'tipo_propiedad',
//                'estatus_renta',
//                'cat_fincas.recibo',
//                'cat_fincas.estatus')
//                ->joinSubCat()
                ->whereHas('lessor', function ($lessor_query) {
                    $lessor_query->where('estatus', Lessor::ACTIVE_STATUS);
                })->
                orderBy('estatus_renta', 'asc')
                ->paginate(15);
            return view('catalogos.finca.index', ["finca" => $finca]);
    }

    public function create(){
        $tp = TipoPropiedad::all();
        $lessors = Lessor::orderBy('apellido_paterno', 'asc')->get();
        return view('catalogos.finca.create', ["propiedad" => $tp, "arrendador" => $lessors]);
    }

    public function store(Request $request){
        $data = $request->all();
        $data['id_estados'] = 25;
        if (isset($data['fiscal']) && $data['fiscal'] == "true"){
            $data['recibo'] = 'Fiscal';
        }else{
            $data['recibo'] = 'No Fiscal';
        }
        CatFinca::create($data);
        return Redirect::to('catalogos/finca');
    }

    public function show($id){
        $finca = CatFinca::findOrFail($id);
        return view('catalogos.finca.show', ["finca" => $finca]);
    }

    public function edit($id){
        $tp = TipoPropiedad::all();
        $finca = CatFinca::findOrFail($id);
        $tipo = TipoPropiedad::findOrFail($finca->id_tipo_propiedad);
        $arr = Lessor::findOrFail($finca->id_arrendador);
        $arre = Lessor::orderBy('apellido_paterno', 'asc')->get();;
        return view('catalogos.finca.edit', ["finca" => $finca, "propiedad" => $tp, "tipo" => $tipo, "arrendadores" => $arr, "arrendador" => $arre]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        if (isset($data['fiscal']) && $data['fiscal'] == "on"){
            $data['recibo'] = 'Fiscal';
        }else{
            $data['recibo'] = 'No Fiscal';
        }
        if (isset($data['estatus_renta']) && $data['estatus_renta'] == 'on'){
            $data['estatus_renta'] = 'Disponible';
        }else{
            $data['estatus_renta'] = 'Rentada';
        }
        CatFinca::findOrFail($id)->update($data);
        return Redirect::to('catalogos/finca');
    }

    public function destroy($id){
        $finca = CatFinca::findOrFail($id);
        $finca->estatus = false;
        $finca->update();
        return Redirect::to('catalogos/finca');
    }

    public function activar($id){
        $finca = CatFinca::findOrFail($id);
        $finca->estatus = true;
        $finca->update();
        return Redirect::to('catalogos/finca');
    }

    public function propiedad(Request $request){
        $data = $request->all();
        $propiedad = TipoPropiedad::all();
        foreach ($propiedad as $pro){
            $nombre = strtoupper($pro->tipo_propiedad);
            $datos = strtoupper($data['tipo_propiedad']);
            if ($nombre == $datos){
                return Redirect::back()->withErrors('Ya existe el tipo de propiedad');
            }
        }
        TipoPropiedad::create($data);
        return Redirect::back();
    }
}
