<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TipoIncidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TipoIncidenteController extends Controller
{
    public function index(){
        $incidente = TipoIncidente::orderBy('estatus', 'desc')
            ->orderBy('tipo_incidente', 'asc')
            ->paginate(15);
        return view('subcatalogos.tipoincidente.index', ['incidente' => $incidente]);
    }

    public function create(){
        return view('subcatalogos.tipoincidente.create');
    }

    public function store(Request $request){
        $data = $request->all();
        TipoIncidente::create($data);
        return Redirect::to('subcatalogos/tipo-incidente');
    }

    public function show($id){
        $incidente = TipoIncidente::findOrFail($id);
        return view('subcatalogos.tipoincidente.show', ['incidente' => $incidente]);
    }

    public function edit($id){
        $incidente = TipoIncidente::findOrFail($id);
        return view('subcatalogos.tipoincidente.edit', ['incidente' => $incidente]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        TipoIncidente::findOrFail($id)->update($data);
        return Redirect::to('subcatalogos/tipo-incidente');
    }

    public function destroy($id){
        $incidente = TipoIncidente::findOrFail($id);
        $incidente->estatus = false;
        $incidente->update();
        return Redirect::to('subcatalogos/tipo-incidente');
    }

    public function activar($id){
        $incidente = TipoIncidente::findOrFail($id);
        $incidente->estatus = true;
        $incidente->update();
        return Redirect::to('subcatalogos/tipo-incidente');
    }
}
