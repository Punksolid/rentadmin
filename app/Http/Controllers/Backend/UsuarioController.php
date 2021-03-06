<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class UsuarioController extends Controller
{

    public function index(Request $request){
        if ($request) {
            $query = trim($request->get('searchText'));
            $usuario = User::where('name', 'LIKE', '%' . $query . '%')
                ->orderBy('name', 'asc')
                ->paginate(15);
            return view('seguridad.usuarios.index', [
                "usuario" => $usuario,
                "searchText" => $query
            ]);
        }
    }

    public function create(){
        $tu = TipoUsuario::all();
        return view('seguridad.usuarios.create', ['tipousuario' => $tu]);
    }

    public function store(UserRequest $request)
    {
        DB::transaction(function () use($request){
            $user = User::create([
                'name' => $request->get('nombre'),
                'password' => bcrypt($request->get('password')),
                'email' => $request->get('email')
            ]);
            $profile = $request->toArray();
            $profile['password'] = bcrypt($request->get('password'));
            $user->profile()->create($profile);
        });
        /** @var User $user */


        return Redirect::to('seguridad/usuarios');
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('seguridad.usuarios.show', ["usuario" => $user]);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $tu = TipoUsuario::all();
        $tipo = TipoUsuario::where('id_tipo_usuario', $user->id_tipo_usuario)->first();
        return view('seguridad.usuarios.edit', ["usuario" => $user, "tipousuario" => $tu, "tipo" => $tipo]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $usuario = User::findOrFail($id);
        $checar = Hash::check($data['password'], $usuario->password);
        $data['password'] = bcrypt($data['password']);
        if ($checar == 1){
            $usuario->update($data);
            return Redirect::to('seguridad/usuarios');
        }else{
            return Redirect::back()->withErrors(['error' => 'Contraseña Incorrecta']);
        }
    }

    public function destroy($id){
        $tp = User::findOrFail($id);
        $tp->estatus = false;
        $tp->update();
        return Redirect::to('seguridad/usuarios');
    }

    public function activar($id){
        $tp = User::findOrFail($id);
        $tp->estatus = true;
        $tp->update();
        return Redirect::to('seguridad/usuarios');
    }
}
