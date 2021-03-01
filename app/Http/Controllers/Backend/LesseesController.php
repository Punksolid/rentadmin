<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LesseeRequest;
use App\Models\Lessee;
use App\Models\CatEmail;
use App\Models\Guarantor;
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
        $data = $request->all(); // @todo Drop this thing
        if ($request->filled(['guarantor_block'] ) ) {
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
        $fiador = Guarantor::findOrFail($arrendatario['id_fiador']);
        return view('catalogos.arrendatario.show', ["arrendatario" => $arrendatario, "fiador" => $fiador]);
    }

    public function edit($id)
    {
        /** @var Lessee $lessee */
        $lessee = Lessee::findOrFail($id);
        /** @var Guarantor $fiador */
        $fiador = $lessee->guarantor;
        $tel = $lessee->phones()->get();

        $email = $lessee->emails()->get();

        return view('catalogos.arrendatario.edit', [
            "arrendatario" => $lessee, //@todo deprecate
            "lessee" => $lessee,
            "fiador" => $fiador,
            "guarantor" => $lessee->guarantor,
            "tel" => $tel, //phones of arrendatario (lessee)
            "email" => $email
        ]);
    }

    public function update(LesseeRequest $request, $id)
    {

        $data = $request->all();
        $arre = Lessee::findOrFail($id);
        $arre->update($data);

        if ($request->get('guarantor_block' ) == 'on') {
            $guarantor = $this->updateOrCreateGuarantor($request, $arre);
        }

        if ($request->hasFile('identity')) {
            $arre->addMediaFromRequest('identity')->toMediaCollection();
        }
        $contadorTel = CatTelefono::where('id_arrendatario', $id)->get();
        $contadorEmail = CatEmail::where('id_arrendatario', $id)->get();



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
        /** var $guarantor Guarantor */
        $guarantor = Guarantor::create($request->guarantor);

        if($request->hasFile('guarantor.identity')) {
            $guarantor->addMediaFromRequest('guarantor.identity')->toMediaCollection();
        }

        return $guarantor;
    }

    public function updateOrCreateGuarantor(Request $request,Lessee $lessee)
    {


        /** @var Guarantor $guarantor */
        if($lessee->guarantor) {
            $guarantor = tap($lessee->guarantor)->update($request->guarantor);
        } else {
            $guarantor = $lessee->guarantor()->create($request->guarantor);
        }

        if($request->hasFile('guarantor.identity')) {
            $guarantor->addMediaFromRequest('guarantor.identity')->toMediaCollection();
        }
        $contadorTelFiador = $guarantor->phones()->get();

        if ($contadorTelFiador) {
            foreach ($contadorTelFiador as $ctf) {
                $id_tel_f = $ctf->id_telefono;
                $uf = CatTelefono::find($id_tel_f);
                $telefonof['id_fiador'] = $guarantor->id;
                $telefonof['telefono'] = $request->get('telefonoid' . $id_tel_f);
                $telefonof['descripcion'] = $request->get('descripcionid' . $id_tel_f);
                $uf->update($telefonof);
            }
        }

        return $guarantor;
    }

    /**
     * @param Guarantor $guarantor
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function guarantorImageDestroy(Guarantor $guarantor): \Illuminate\Http\RedirectResponse
    {
        $guarantor->getFirstMedia()->delete();

        return Redirect::route('arrendatario.edit', $guarantor->lessee->id);
    }
}
