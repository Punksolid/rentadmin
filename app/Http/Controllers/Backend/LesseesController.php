<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LesseeRequest;
use App\Models\Lessee;
use App\Models\CatEmail;
use App\Models\CatFiador;
use App\Models\CatTelefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LesseesController extends Controller
{
    public function index(Request $request)
    {
        $lessees_query = Lessee::query();
        $status = $request->get('status', Lessee::STATUS_ACTIVE);
        $lessees_query->where('estatus', $status);

        $lessees = $lessees_query
            ->orderBy('nombre', 'asc')
            ->paginate();
        $lessees->appends(compact('status'));
        return view('catalogos.arrendatario.index', [
            "arrendatarios" => $lessees,
            'status' => $status
        ]);

    }

    public function create()
    {
        return view('catalogos.arrendatario.create');
    }

    public function store(LesseeRequest $request)
    {
        $data = $request->all();
        if ($request->filled(['nombre_fiador', 'apellido_paterno_fiador'] ) ) {
            $guarantor = $this->registerGuarantor($request);
            $data['id_fiador'] = $guarantor['id_cat_fiadores'];
            for ($k = 1; $k <= 10; $k++) {
                $variable = isset($data['telefono_fiador' . $k]);
                if ($variable == null) {
                } else {
                    $tel['id_fiador'] = $guarantor['id_cat_fiadores'];
                    $tel['telefono'] = $data['telefono_fiador' . $k];
                    $tel['descripcion'] = $data['descripcion_fiador' . $k];
                    CatTelefono::create($tel);
                }
            }
        }

        /** @var Lessee $arrendatario */
        $arrendatario = Lessee::create($data);
        $lessee = &$arrendatario;
        if ($request->hasFile('identity')) {
            $arrendatario->addMediaFromRequest('identity')->toMediaCollection();
        }

        if ($request->filled('phone_number')) {

            foreach ($request->get('phone_number') as $phone){
                $lessee->addPhoneData((string) $phone['telefono'], (string)$phone['descripcion'] );
            }
        }

        if ($request->filled('email')) {
            foreach ($request->get('email') as $email){
                $lessee->addEmail($email);
            }
        }

        return Redirect::to('catalogos/arrendatario');
    }

    public function show($id)
    {
        $arrendatario = Lessee::findOrFail($id);
        $fiador = CatFiador::findOrFail($arrendatario['id_fiador']);
        return view('catalogos.arrendatario.show', ["arrendatario" => $arrendatario, "fiador" => $fiador]);
    }

    public function edit($id)
    {
        /** @var Lessee $lessee */
        $lessee = Lessee::findOrFail($id);
        /** @var CatFiador $fiador */
        $fiador = $lessee->guarantor;
        $tel = $lessee->phones()->get();
        $tel_f = $fiador->phones()->get();
        $email = $lessee->emails()->get();
        
        return view('catalogos.arrendatario.edit', [
            "arrendatario" => $lessee, //@todo deprecate
            "lessee" => $lessee,
            "fiador" => $fiador,
            "telf" => $tel_f, // phones of fiador (guarantor)
            "tel" => $tel, //phones of arrendatario (lessee)
            "email" => $email
        ]);
    }

    public function update(Request $request, $id)
    {
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
        $arre = Lessee::findOrFail($id);
        CatFiador::findOrFail($arre['id_fiador'])->update($fiador);
        $arre->update($data);
        if ($request->hasFile('identity')) {
            $arre->addMediaFromRequest('identity')->toMediaCollection();
        }
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

    public function destroy($id)
    {
        $arrendatario = Lessee::findOrFail($id);
        $arrendatario->estatus = false;
        $arrendatario->update();
        return Redirect::to('catalogos/arrendatario');
    }

    public function toggleStatus(Lessee $arrendatario, Request $request)
    {
        $arrendatario->estatus = $request->status;
        $arrendatario->save();
        return Redirect::to('catalogos/arrendatario');
    }

    public function addTelefono(Request $request, $id)
    {
        $data = $request->all();
        $data['id_arrendatario'] = $id;
        CatTelefono::create($data);

        return Redirect::back();
    }

    public function addTelefonoFiador(Request $request, $id)
    {
        $data = $request->all();
        $data['id_fiador'] = $id;
        $phone = CatTelefono::create($data);

        return Redirect::back();
    }

    public function addEmail(Request $request, $id)
    {
        $data = $request->all();
        $data['id_arrendatario'] = $id;
        CatEmail::create($data);
        return Redirect::back();
    }

    public function deleteTelefono($id)
    {
        CatTelefono::findOrFail($id)->delete();
        return Redirect::back();
    }

    public function deleteEmail($id)
    {
        CatEmail::findOrFail($id)->delete();
        return Redirect::back();
    }

    public function deleteTelefonoFiador($id)
    {
        CatTelefono::findOrFail($id)->delete();
        return Redirect::back();
    }

    public function registerGuarantor(Request $request)
    {
        $fiador['nombre'] = $request->get('nombre_fiador');
        $fiador['apellido_paterno'] = $request->get('apellido_paterno_fiador');
        $fiador['apellido_materno'] = $request->get('apellido_materno_fiador');
        $fiador['calle'] = $request->get('calle_fiador');
        $fiador['colonia'] = $request->get('colonia_fiador');
        $fiador['numero_ext'] = $request->get('numero_ext_fiador');
        $fiador['numero_int'] = $request->get('numero_int_fiador');
        $fiador['estado'] = $request->get('estado_fiador');
        $fiador['ciudad'] = $request->get('ciudad_fiador');
        $fiador['codigo_postal'] = $request->get('codigo_postal_fiador');
        $fiador['entre_calles'] = $request->get('entre_calles_fiador');
        $fiador['calle_trabajo'] = $request->get('calle_fiador_trabajo');
        $fiador['colonia_trabajo'] = $request->get('colonia_fiador_trabajo');
        $fiador['numero_ext_trabajo'] = $request->get('numero_ext_fiador_trabajo');
        $fiador['numero_int_trabajo'] = $request->get('numero_int_fiador_trabajo');
        $fiador['estado_trabajo'] = $request->get('estado_fiador_trabajo');
        $fiador['ciudad_trabajo'] = $request->get('ciudad_fiador_trabajo');
        $fiador['codigo_postal_trabajo'] = $request->get('codigo_postal_fiador_trabajo');
        $fiador['entre_calles_trabajo'] = $request->get('entre_calles_fiador_trabajo');

        return CatFiador::create($fiador);
    }
}
