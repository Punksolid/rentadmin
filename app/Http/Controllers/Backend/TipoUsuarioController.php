<?php

namespace App\Http\Controllers\Backend;

use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoUsuarioController extends Controller
{
    public function index(){
        $data = TipoUsuario::get();
        return response()->success($data);
    }

    public function store(Request $request){
        $data = $request->all();
        $tu = TipoUsuario::create($data);

        return response()->success($tu);
    }

    public function show($id){
        $tu = TipoUsuario::findOrFail($id);
        return response()->success($tu);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        TipoUsuario::findOrFail($id)->update($data);
        return response()->success(['result' => 'Tipo de usuario actualizado']);
    }

    public function destroy($id){
        TipoUsuario::findOrFail($id);
        return response()->success(['result' => 'Tipo de usuario eliminado']);
    }
}
