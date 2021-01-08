<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CatBanco;
use App\Models\CatEmail;
use App\Models\CatTelefono;
use App\Models\Lessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LessorController extends Controller
{
    public function index(Request $request){
        $lessors_query = Lessor::query();
        if ($request->has('full_name')) {
            $lessors_query = $lessors_query->where('nombre','LIKE', "%".$request->get('full_name')."%");
            $lessors_query = $lessors_query->orWhere('apellido_paterno','LIKE', "%".$request->get('full_name')."%");
            $lessors_query = $lessors_query->orWhere('apellido_materno','LIKE', "%".$request->get('full_name')."%");
        }
        $status = $request->get('status', Lessor::ACTIVE_STATUS);
        $lessors_query->where('estatus', $status);

        $lessors = $lessors_query->with('defaultPhoneNumber')
            ->orderBy('nombre', 'asc')
            ->paginate(15);
        $lessors->appends(compact('status'));

        return view('catalogos.arrendador.index', [
            "lessors" => $lessors,
            'status' => $status
        ]);

    }

    public function create(){
        return view('catalogos.arrendador.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['id_usuario'] = Auth::user()->getAuthIdentifier();;
        /** @var Lessor $lessor */
        $lessor = Lessor::create($data);

        for ($k = 1; $k <= 5; $k++) {
            $ban = isset($data['banco' . $k]);
            if ($ban  == null) {
            } else {
                $banco['id_arrendador'] = $lessor->id;
                $banco['banco'] = $data['banco' . $k];
                $banco['cuenta'] = $data['cuenta' . $k];
                $banco['clabe'] = $data['clabe' . $k];
                $banco['nombre_titular'] = $data['nombre_titular' . $k];
                CatBanco::create($banco);
            }
        }

        if ($request->has('phone_number')) {
            $this->addPhones($lessor, $request->get('phone_number'));
        }
//        for ($i = 1; $i <= 10; $i++) {
//            $variable = isset($data['telefono' . $i]);
//            if ($variable == null) {
//            } else {
//                $telefono['id_arrendador'] = $lessor['id_cat_arrendador'];
//                $telefono['telefono'] = $data['telefono' . $i];
//                $telefono['descripcion'] = $data['descripcion' . $i];
//                CatTelefono::create($telefono);
//            }
//        }
        if ($request->has('email')) {
            foreach ($request->email as $email){
//                $email['id_arrendador'] = $lessor->id;
//                $email['email'] = $data['email' . $j];
                CatEmail::create([
                    'id_arrendador' => $lessor->id,
                    'email' => $email
                ]);
            }
        }
//        for ($j = 1; $j <= 10; $j++) {
//            $varia = isset($data['email' . $j]);
//            if ($varia == null) {
//            } else {
//                $email['id_arrendador'] = $lessor['id_cat_arrendador'];
//                $email['email'] = $data['email' . $j];
//                CatEmail::create($email);
//            }
//        }

        return Redirect::to('catalogos/arrendador');
    }

    public function show($id){
        $lessor = Lessor::findOrFail($id);
        $banco = CatBanco::where('id_arrendador', $id);
        return view('catalogos.arrendador.show',["arrendador" => $lessor, 'banco' => $banco]);
    }

    public function edit($id){
        $lessor = Lessor::findOrFail($id);
        $tel = CatTelefono::where('id_arrendador', $id)->get();
        $email = CatEmail::where('id_arrendador', $id)->get();
        $banco = CatBanco::where('id_arrendador', $id)->get();
        return view('catalogos.arrendador.edit',["arrendador" => $lessor, "tel" => $tel, "email" => $email, 'banco' => $banco]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        Lessor::findOrFail($id)->update($data);
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
        $lessor = Lessor::findOrFail($id);
        $lessor->estatus = false;
        $lessor->update();
        return Redirect::to('catalogos/arrendador');
    }

    public function activar($id){
        $lessor = Lessor::findOrFail($id);
        $lessor->estatus = true;
        $lessor->update();
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

    /**
     * @param Phoneable $lessor
     * @param array $phone_numbers
     */
    private function addPhones(Phoneable $lessor, array $phone_numbers)
    {
        foreach ($phone_numbers as $phone_number) {
            $lessor->addPhoneData($phone_number['telefono'], $phone_number['descripcion'], 1 );
        }
    }
}
