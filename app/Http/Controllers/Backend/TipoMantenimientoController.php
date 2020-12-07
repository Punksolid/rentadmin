<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TipoMantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TipoMantenimientoController extends Controller
{
    public function index(){
        $mante = TipoMantenimiento::orderBy('estatus', 'desc')
            ->orderBy('tipo_mantenimiento', 'asc')
            ->paginate(15);
        return view('subcatalogos.tipomantenimiento.index', ['mantenimiento' => $mante]);
    }

    public function create(){
        return view('subcatalogos.tipomantenimiento.create');
    }

    public function store(Request $request){
        $data = $request->all();
        TipoMantenimiento::create($data);
        return Redirect::to('subcatalogos/tipo-mantenimiento');
    }

    public function show($id){
        $incidente = TipoMantenimiento::findOrFail($id);
        return view('subcatalogos.tipomantenimiento.show', ['mantenimiento' => $incidente]);
    }

    public function edit($id){
        $incidente = TipoMantenimiento::findOrFail($id);
        return view('subcatalogos.tipomantenimiento.edit', ['mantenimiento' => $incidente]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        TipoMantenimiento::findOrFail($id)->update($data);
        return Redirect::to('subcatalogos/tipo-mantenimiento');
    }

    public function destroy($id){
        $incidente = TipoMantenimiento::findOrFail($id);
        $incidente->estatus = false;
        $incidente->update();
        return Redirect::to('subcatalogos/tipo-mantenimiento');
    }

    public function activar($id){
        $incidente = TipoMantenimiento::findOrFail($id);
        $incidente->estatus = true;
        $incidente->update();
        return Redirect::to('subcatalogos/tipo-mantenimiento');
    }
}
