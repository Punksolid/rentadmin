<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Lessor;
use App\Models\TipoPropiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PropertiesController extends Controller
{
    public function index(Request $request)
    {
        $properties_query = Property::query();
        if ($request->inactive) {
            $properties_query = $properties_query->inactive();
        } else {
            $properties_query = $properties_query->active();
        }
            $properties = $properties_query
//            select('id_cat_fincas',
//                'finca_arrendada',
//                'cat_arrendador.nombre AS arrendador',
//                'cat_arrendador.apellido_paterno AS arrendadora',
//                'servicio_luz',
//                'cta_japac',
//                'tipo_propiedad',
//                'estatus_renta',
//                'cat_fincas.recibo',
//                'cat_fincas.estatus')
//                ->joinSubCat()
                ->whereHas('lessor', function ($lessor_query) {
                    $lessor_query->where('estatus', Lessor::ACTIVE_STATUS);
                })
                ->orderBy('rented', 'asc')
                ->paginate(15);

            return view('catalogos.finca.index', ["finca" => $properties, 'properties' =>  $properties ]);
    }

    public function create(){
        $property_types = TipoPropiedad::all();
        $lessors = Lessor::orderBy('apellido_paterno', 'asc')->get();
        return view('catalogos.finca.create', ["property_types" => $property_types, "arrendador" => $lessors]);
    }

    public function store(Request $request){
        $data = $request->all();
        $data['state_id'] = 25;
        if (isset($data['fiscal']) && $data['fiscal'] == "true"){
            $data['recibo'] = 'Fiscal';
        }else{
            $data['recibo'] = 'No Fiscal';
        }

        /** @var Property $property */
        $property = Property::make($data);
        $property->lessor_id = (integer)$request->get('lessor_id');
        $property->save();
        if ($request->hasFile('photo')) {
            $property->addMediaFromRequest('photo')->toMediaCollection();
        }
        return Redirect::to('catalogos/finca');
    }

    public function show($id){
        $finca = Property::findOrFail($id);
        return view('catalogos.finca.show', ["finca" => $finca]);
    }

    public function edit($id){
//        dd($property_id);
        $property_types = TipoPropiedad::all();
        $finca = Property::findOrFail($id);
        $tipo = TipoPropiedad::findOrFail($finca->property_type_id);
        $arr = Lessor::findOrFail($finca->lessor_id);
        $arre = Lessor::orderBy('apellido_paterno', 'asc')->get();

        return view('catalogos.finca.edit', ["finca" => $finca, "propiedad" => $property_types, "tipo" => $tipo, "arrendadores" => $arr, "arrendador" => $arre]);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        if (isset($data['fiscal']) && $data['fiscal'] == "on"){
            $data['recibo'] = 'Fiscal';
        }else{
            $data['recibo'] = 'No Fiscal';
        }
        if (isset($data['estatus_renta']) && $data['estatus_renta'] == 'on'){
            $data['rented'] = 'Disponible';
        }else{
            $data['rented'] = 'Rentada';
        }
        /** @var Property $property */
        $property = Property::findOrFail($id);
        $property->update($data);
        if ($request->hasFile('photo')) {
            $property->clearMediaCollection();
            $property->addMediaFromRequest('photo')->toMediaCollection();
        }

        return Redirect::to('catalogos/finca');
    }

    public function destroy($id){
        $finca = Property::findOrFail($id);
        $finca->status = false;
        $finca->update();
        return Redirect::to('catalogos/finca');
    }

    public function activar($id){
        $finca = Property::findOrFail($id);
        $finca->status = true;
        $finca->update();
        return Redirect::to('catalogos/finca');
    }

    public function propiedad(Request $request){
        $data = $request->all();
        $propiedad = TipoPropiedad::all();
        foreach ($propiedad as $pro){
            $nombre = strtoupper($pro->tipo_propiedad);
            $datos = strtoupper($data['tipo_propiedad']);
            if ($nombre == $datos){
                return Redirect::back()->withErrors('Ya existe el tipo de propiedad');
            }
        }
        TipoPropiedad::create($data);
        return Redirect::back();
    }

    public function updatePatch( $property_id, Request $request)
    {
        $property = Property::findOrFail($property_id);
        if ($request->has('status')) {
            $property->status = $request->status;
            $property->save();
        }

        return \redirect(route('finca.index'));
    }
}
