<?php

namespace App\Http\Controllers\Backend;

use App\Models\TipoPropiedad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TipoPropiedadController extends Controller
{
    public function index(){
        $propiedad = TipoPropiedad::orderBy('estatus', 'desc')
            ->orderBy('tipo_propiedad', 'asc')
            ->paginate(15);
        return view('subcatalogos.tipopropiedad.index', ["propiedad" => $propiedad]);
    }

    public function create(){
        return view('subcatalogos.tipopropiedad.create');
    }

    public function store(Request $request){
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
        return Redirect::to('subcatalogos/tipo-propiedad');
    }

    public function show($id){
        $tp = TipoPropiedad::findOrFail($id);
        return view('subcatalogos.tipopropiedad.show', ["propiedad" => $tp]);
    }

    public function edit($id){
        $tp = TipoPropiedad::findOrFail($id);
        return view('subcatalogos.tipopropiedad.edit', ["propiedad" => $tp]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $propiedad = TipoPropiedad::all();
        foreach ($propiedad as $pro){
            $nombre = strtoupper($pro->tipo_propiedad);
            $datos = strtoupper($data['tipo_propiedad']);
            if ($nombre == $datos){
                return Redirect::back()->withErrors('Ya existe el tipo de propiedad');
            }
        }
        TipoPropiedad::findOrFail($id)->update($data);
        return Redirect::to('subcatalogos/tipo-propiedad');
    }

    public function destroy($id){
        $tp = TipoPropiedad::findOrFail($id);
        $tp->estatus = false;
        $tp->update();
        return Redirect::to('subcatalogos/tipo-propiedad');
    }

    public function activar($id){
        $tp = TipoPropiedad::findOrFail($id);
        $tp->estatus = true;
        $tp->update();
        return Redirect::to('subcatalogos/tipo-propiedad');
    }
}
