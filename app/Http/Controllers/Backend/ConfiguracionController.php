<?php
namespace App\Http\Controllers\Backend;
use App\Models\Configuracion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConfiguracionController extends Controller
{
    public function index(){
        $correo = Configuracion::findOrFail(1);
        $retiva = Configuracion::findOrFail(2);
        $retisr = Configuracion::findOrFail(3);
        $comision = Configuracion::findOrFail(4);
        $iva = Configuracion::findOrFail(5);

        return view('configuracion.index', [ 'correo' => $correo, 'retiva' => $retiva, 'retisr' => $retisr, 'comision' => $comision, 'iva' => $iva ]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $config = Configuracion::findOrFail($id);
        $config->update($data);
        return Redirect::to('configuracion');
    }
}
