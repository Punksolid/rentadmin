<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CatArrendatario;
use App\Models\CatEmail;
use App\Models\CatFiador;
use App\Models\CatTelefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CatArrendatarioController extends Controller
{
    public function index(Request $request){
            $arrendatarios = CatArrendatario::
//                ->groupBy('id_cat_arrendatario')
//                ->joinSubCat()
                orderBy('nombre', 'asc')
                ->paginate(15);
            return view('catalogos.arrendatario.index', ["arrendatarios" => $arrendatarios]);

    }

    public function create(){
        return view('catalogos.arrendatario.create');
    }

    public function store(Request $request){
        $data = $request->all();
        $fiador['nombre'] = $data['nombre_fiador'];
        $fiador['apellido_paterno'] = $data['apellido_paterno_fiador'];
        $fiador['apellido_materno'] = $data['apellido_materno_fiador'];
        $fiador['calle'] = $data['calle_fiador'];
        $fiador['colonia'] = $data['colonia_fiador'];
        $fiador['numero_ext'] = $data['numero_ext_fiador'];
        $fiador['numero_int'] = $data['numero_int_fiador'];
        $fiador['estado'] = $data['estado_fiador'];
        $fiador['ciudad'] = $data['ciudad_fiador'];
        $fiador['codigo_postal'] = $data['codigo_postal_fiador'];
        $fiador['entre_calles'] = $data['entre_calles_fiador'];
        $fiador['calle_trabajo'] = $data['calle_fiador_trabajo'];
        $fiador['colonia_trabajo'] = $data['colonia_fiador_trabajo'];
        $fiador['numero_ext_trabajo'] = $data['numero_ext_fiador_trabajo'];
        $fiador['numero_int_trabajo'] = $data['numero_int_fiador_trabajo'];
        $fiador['estado_trabajo'] = $data['estado_fiador_trabajo'];
        $fiador['ciudad_trabajo'] = $data['ciudad_fiador_trabajo'];
        $fiador['codigo_postal_trabajo'] = $data['codigo_postal_fiador_trabajo'];
        $fiador['entre_calles_trabajo'] = $data['entre_calles_fiador_trabajo'];
        $f = CatFiador::create($fiador);

        $data['id_fiador'] = $f['id_cat_fiadores'];
        $arrendatario = CatArrendatario::create($data);

        for ($k = 1; $k <= 10; $k++) {
            $variable = isset($data['telefono_fiador'.$k]);
            if ($variable == null){ }else {
                $tel['id_fiador'] = $f['id_cat_fiadores'];
                $tel['telefono'] = $data['telefono_fiador' . $k];
                $tel['descripcion'] = $data['descripcion_fiador' . $k];
                CatTelefono::create($tel);
            }
        }

        for ($i = 1; $i <= 10; $i++) {
            $variable = isset($data['telefono'.$i]);
            if ($variable == null){ }else {
                $telefono['id_arrendatario'] = $arrendatario['id_cat_arrendatario'];
                $telefono['telefono'] = $data['telefono' . $i];
                $telefono['descripcion'] = $data['descripcion' . $i];
                CatTelefono::create($telefono);
            }
        }

        for ($j = 1; $j <= 10; $j++) {
            $varia = isset($data['email'.$j]);
            if ($varia == null){ }else {
                $email['id_arrendatario'] = $arrendatario['id_cat_arrendatario'];
                $email['email'] = $data['email' . $j];
                CatEmail::create($email);
            }
        }
        return Redirect::to('catalogos/arrendatario');
    }

    public function show($id){
        $arrendatario = CatArrendatario::findOrFail($id);
        $fiador = CatFiador::findOrFail($arrendatario['id_fiador']);
        return view('catalogos.arrendatario.show', ["arrendatario" => $arrendatario, "fiador" => $fiador]);
    }

    public function edit($id){
        /** @var CatArrendatario $arrendatario */
        $arrendatario = CatArrendatario::findOrFail($id);
//        /** @var CatFiador $fiador */
        /** @var CatFiador $fiador */
        $fiador = $arrendatario->guarantor;
//        $tel = CatTelefono::where('id_arrendatario', $id)->get();
        $tel = $arrendatario->phones()->get();
//        $tel_f = CatTelefono::where('id_fiador', $fiador['id_cat_fiadores'])->get();
        $tel_f = $fiador->phones()->get();
//        $email = CatEmail::where('id_arrendatario', $id)->get();
        $email = $arrendatario->emails()->get();
        return view('catalogos.arrendatario.edit', [
            "arrendatario" => $arrendatario,
            "fiador" => $fiador,
            "telf" => $tel_f, // phones of fiador (guarantor)
            "tel" => $tel, //phones of arrendatario (lessee)
            "email" => $email
        ]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $fiador['nombre'] = $data['nombre_fiador'];
        $fiador['apellido_paterno'] = $data['apellido_paterno_fiador'];
        $fiador['apellido_materno'] = $data['apellido_materno_fiador'];
        $fiador['calle'] = $data['calle_fiador'];
        $fiador['colonia'] = $data['colonia_fiador'];
        $fiador['numero_ext'] = $data['numero_ext_fiador'];
        $fiador['numero_int'] = $data['numero_int_fiador'];
        $fiador['estado'] = $data['estado_fiador'];
        $fiador['ciudad'] = $data['ciudad_fiador'];
        $fiador['codigo_postal'] = $data['codigo_postal_fiador'];
        $fiador['entre_calles'] = $data['entre_calles_fiador'];
        $fiador['calle_trabajo'] = $data['calle_fiador_trabajo'];
        $fiador['colonia_trabajo'] = $data['colonia_fiador_trabajo'];
        $fiador['numero_ext_trabajo'] = $data['numero_ext_fiador_trabajo'];
        $fiador['numero_int_trabajo'] = $data['numero_int_fiador_trabajo'];
        $fiador['estado_trabajo'] = $data['estado_fiador_trabajo'];
        $fiador['ciudad_trabajo'] = $data['ciudad_fiador_trabajo'];
        $fiador['codigo_postal_trabajo'] = $data['codigo_postal_fiador_trabajo'];
        $fiador['entre_calles_trabajo'] = $data['entre_calles_fiador_trabajo'];
        $arre = CatArrendatario::findOrFail($id);
        CatFiador::findOrFail($arre['id_fiador'])->update($fiador);
        $arre->update($data);
        $contadorTel = CatTelefono::where('id_arrendatario', $id)->get();
        $contadorTelFiador = CatTelefono::where('id_fiador', $arre['id_fiador'])->get();
        $contadorEmail = CatEmail::where('id_arrendatario', $id)->get();

        foreach ($contadorTelFiador as $ctf) {
            $id_tel_f = $ctf->id_telefono;
            $uf = CatTelefono::findOrFail($id_tel_f);
            $telefonof['id_fiador'] = $arre['id_fiador'];
            $telefonof['telefono'] = $data['telefonoid' . $id_tel_f];
            $telefonof['descripcion'] = $data['descripcionid' . $id_tel_f];
            $uf->update($telefonof);
        }

        foreach ($contadorTel as $ct) {
            $id_tel = $ct->id_telefono;
            $u = CatTelefono::findOrFail($id_tel);
            $telefono['id_arrendatario'] = $id;
            $telefono['telefono'] = $data['telefonoid' . $id_tel];
            $telefono['descripcion'] = $data['descripcionid' . $id_tel];
            $u->update($telefono);
        }

        foreach ($contadorEmail as $ce) {
            $id_email = $ce->id_email;
            $l = CatEmail::findOrFail($id_email);
            $email['id_arrendatario'] = $id;
            $email['email'] = $data['emailid' . $id_email];
            $l->update($email);
        }
        return Redirect::to('catalogos/arrendatario');
    }

    public function destroy($id){
        $arrendatario = CatArrendatario::findOrFail($id);
        $arrendatario->estatus = false;
        $arrendatario->update();
        return Redirect::to('catalogos/arrendatario');
    }

    public function activar($id){
        $arrendatario = CatArrendatario::findOrFail($id);
        $arrendatario->estatus = true;
        $arrendatario->update();
        return Redirect::to('catalogos/arrendatario');
    }

    public function addTelefono(Request $request, $id){
        $data = $request->all();
        $data['id_arrendatario'] = $id;
        CatTelefono::create($data);
        return Redirect::back();
    }

    public function addTelefonoFiador(Request $request, $id){
        $data = $request->all();
        $data['id_fiador'] = $id;
        CatTelefono::create($data);
        return Redirect::back();
    }

    public function addEmail(Request $request, $id){
        $data = $request->all();
        $data['id_arrendatario'] = $id;
        CatEmail::create($data);
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

    public function deleteTelefonoFiador($id){
        CatTelefono::findOrFail($id)->delete();
        return Redirect::back();
    }
}
