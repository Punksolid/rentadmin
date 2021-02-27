<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessorRequest;
use App\Models\CatBanco;
use App\Models\CatEmail;
use App\Models\CatTelefono;
use App\Models\Lessor;
use App\Models\Phoneable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

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

        if ($request->has('email')) {
            foreach ($request->email as $email){

                CatEmail::create([
                    'id_arrendador' => $lessor->id,
                    'email' => $email
                ]);
            }
        }

        return Redirect::to('catalogos/arrendador');
    }

    public function show($id){
        $lessor = Lessor::findOrFail($id);
        $banco = CatBanco::where('id_arrendador', $id);
        return view('catalogos.arrendador.show',["arrendador" => $lessor, 'banco' => $banco]);
    }

    public function edit($id){
        /** @var Lessor $lessor */
        $lessor = Lessor::findOrFail($id);

        $phones = $lessor->phones;
        $emails = $lessor->emails;
        $banco = $lessor->bankAccounts;

        return view('catalogos.arrendador.edit',[
            "arrendador" => $lessor,
            "phones" => $phones,
            "emails" => $emails,
            'banco' => $banco
        ]);
    }

    public function update(LessorRequest $request, $id){
        /** @var Lessor $lessor */
        $lessor = tap(Lessor::findOrFail($id))->update($request->toArray());
        $emails = $lessor->emails()->get();

        if ($request->filled('bank_accounts_section')) {
            $this->updateBankAccounts($lessor, $request);
        }

        if ($request->filled('phones')) {
            $this->updatePhones($request->get('phones'));
        }

        foreach ($emails as $email) {
            $email->update([
                'email' => $request->get('emailid' . $email->id_email)
            ]);
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

        /** @var Lessor $lessor */
        $lessor = Lessor::findOrFail($id);

        $phone = $lessor->phones()->create($data);

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

    /**
     * @param $contadorTel
     * @param $id
     * @param $telefono
     * @param array $data
     */
    private function updatePhones(array $phones): void
    {
        foreach ($phones as $id => $phone_input) {
            $phone = CatTelefono::find($id);

            $phone->telefono = $phone_input['number'];
            $phone->descripcion = $phone_input['description'];
            $phone->save();
        }
    }

    /**
     * @param Lessor $lessor
     * @param Request $request
     */
    private function updateBankAccounts(Lessor $lessor, Request $request): void
    {
        $bank_accounts = $lessor->bankAccounts()->get();
        foreach ($bank_accounts as $bank_account) {
            if (strlen($request->get('bank_accounts')[ 'clabeid' . $bank_account->id_banco]) != 18) {
                throw  ValidationException::withMessages([
                    'clabe' => ['La clabe no tiene el formato adecuado.']
                ]);
            }
            $bank_account->update([
                'id_arrendador' => $lessor->id,
                'banco' => $request->get('bank_accounts')['bancoid' . $bank_account->id_banco],
                'cuenta' => $request->get('bank_accounts')['cuentaid' . $bank_account->id_banco],
                'clabe' => $request->get('bank_accounts')['clabeid' . $bank_account->id_banco],
                'nombre_titular' => $request->get('bank_accounts')['nombre_titularid' . $bank_account->id_banco]
            ]);
        }
    }
}
