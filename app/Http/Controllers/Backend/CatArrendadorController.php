<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CatArrendador;
use App\Models\CatBanco;
use App\Models\CatEmail;
use App\Models\CatTelefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CatArrendadorController extends Controller
{
    public function index(Request $request){
        $arrendador = CatArrendador::select('id_cat_arrendador', 'nombre', 'apellido_paterno', 'apellido_materno', 'telefono', 'email', 'rfc', 'cat_arrendador.estatus')
            ->groupBy('id_cat_arrendador')
            ->joinSubCat()
            ->orderBy('nombre', 'asc')
            ->paginate(15);
        return view('catalogos.arrendador.index', ["arrendador" => $arrendador]);

    }

    public function create(){
        return view('catalogos.arrendador.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_usuario'] = Auth::user()->getAuthIdentifier();;
        $arrendador = CatArrendador::create($data);

        for ($k = 1; $k <= 5; $k++) {
            $ban = isset($data['banco' . $k]);
            if ($ban == null) {
            } else {
                $banco['id_arrendador'] = $arrendador['id_cat_arrendador'];
                $banco['banco'] = $data['banco' . $k];
                $banco['cuenta'] = $data['cuenta' . $k];
                $banco['clabe'] = $data['clabe' . $k];
                $banco['nombre_titular'] = $data['nombre_titular' . $k];
                CatBanco::create($banco);
            }
        }

        for ($i = 1; $i <= 10; $i++) {
            $variable = isset($data['telefono' . $i]);
            if ($variable == null) {
            } else {
                $telefono['id_arrendador'] = $arrendador['id_cat_arrendador'];
                $telefono['telefono'] = $data['telefono' . $i];
                $telefono['descripcion'] = $data['descripcion' . $i];
                CatTelefono::create($telefono);
            }
        }

        for ($j = 1; $j <= 10; $j++) {
            $varia = isset($data['email' . $j]);
            if ($varia == null) {
            } else {
                $email['id_arrendador'] = $arrendador['id_cat_arrendador'];
                $email['email'] = $data['email' . $j];
                CatEmail::create($email);
            }
        }
        return Redirect::to('catalogos/arrendador');
    }

    public function show($id){
        $arrendador = CatArrendador::findOrFail($id);
        $banco = CatBanco::where('id_arrendador', $id);
        return view('catalogos.arrendador.show',["arrendador" => $arrendador, 'banco' => $banco]);
    }

    public function edit($id){
        $arrendador = CatArrendador::findOrFail($id);
        $tel = CatTelefono::where('id_arrendador', $id)->get();
        $email = CatEmail::where('id_arrendador', $id)->get();
        $banco = CatBanco::where('id_arrendador', $id)->get();
        return view('catalogos.arrendador.edit',["arrendador" => $arrendador, "tel" => $tel, "email" => $email, 'banco' => $banco]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        CatArrendador::findOrFail($id)->update($data);
        $contadorBanco = CatBanco::where('id_arrendador', $id)->get();
        $contadorTel = CatTelefono::where('id_arrendador', $id)->get();
        $contadorEmail = CatEmail::where('id_arrendador', $id)->get();

        foreach ($contadorBanco as $cb) {
            $id_banco = $cb->id_banco;
            $b = CatBanco::findOrFail($id_banco);
            $banco['id_arrendador'] = $id;
            $banco['banco'] = $data['bancoid' . $id_banco];
            $banco['cuenta'] = $data['cuentaid' . $id_banco];
            $banco['clabe'] = $data['clabeid' . $id_banco];
            $banco['nombre_titular'] = $data['nombre_titularid' . $id_banco];
            $b->update($banco);
        }

        foreach ($contadorTel as $ct) {
            $id_tel = $ct->id_telefono;
            $u = CatTelefono::findOrFail($id_tel);
            $telefono['id_arrendador'] = $id;
            $telefono['telefono'] = $data['telefonoid' . $id_tel];
            $telefono['descripcion'] = $data['descripcion' . $id_tel];
            $u->update($telefono);
        }

        foreach ($contadorEmail as $ce) {
            $id_email = $ce->id_email;
            $l = CatEmail::findOrFail($id_email);
            $email['id_arrendador'] = $id;
            $email['email'] = $data['emailid' . $id_email];
            $l->update($email);
        }
        return Redirect::to('catalogos/arrendador');
    }

    public function destroy($id){
        $arrendador = CatArrendador::findOrFail($id);
        $arrendador->estatus = false;
        $arrendador->update();
        return Redirect::to('catalogos/arrendador');
    }

    public function activar($id){
        $arrendador = CatArrendador::findOrFail($id);
        $arrendador->estatus = true;
        $arrendador->update();
        return Redirect::to('catalogos/arrendador');
    }

    public function addTelefono(Request $request, $id){
        $data = $request->all();
        $data['id_arrendador'] = $id;
        CatTelefono::create($data);
        return Redirect::back();
    }

    public function addEmail(Request $request, $id){
        $data = $request->all();
        $data['id_arrendador'] = $id;
        CatEmail::create($data);
        return Redirect::back();
    }

    public function addBanco(Request $request, $id){
        $data = $request->all();
        $data['id_arrendador'] = $id;
        CatBanco::create($data);
        return Redirect::back();
    }

    public function deleteTelefono($id){
        CatTelefono::findOrFail($id)->delete();
        return Redirect::back();
    }

    public function deleteEmail($id){
        CatEmail::findOrFail($id)->delete();
        return Redirect::back();
    }

    public function deleteBanco($id){
        CatBanco::findOrFail($id)->delete();
        return Redirect::back();
    }
}
