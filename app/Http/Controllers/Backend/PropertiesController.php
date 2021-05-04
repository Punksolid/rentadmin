<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
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
        $status = $request->get('status', 1);
        $properties_query->where('status', $status);

        $properties = $properties_query
                ->whereHas('lessor', function ($lessor_query) {
                    $lessor_query->where('estatus', Lessor::ACTIVE_STATUS);
                })
                ->orderBy('rented', 'asc')
                ->paginate();
        $properties->appends([
            'status' => $status
        ]);

            return view('catalogos.finca.index', [
                "finca" => $properties,
                'properties' =>  $properties,
                'status' => $status
            ]);
    }

    public function create(){
        $property_types = TipoPropiedad::active()->get();
        $lessors = Lessor::active()->get();

        return view('catalogos.finca.create', [
            "property_types" => $property_types,
            "lessors" => $lessors
        ]);
    }

    public function store(PropertyRequest $request){
        $data = $request->all();
        $data['state_id'] = 25;

        /** @var Property $property */
        $property = Property::make($data);
        $property->lessor_id = (integer)$request->get('lessor_id');
        if (!$property->save()) {
            return back();
        }
        if ($request->hasFile('photo')) {
            $property->addMediaFromRequest('photo')->toMediaCollection();
        }

        return Redirect::to('catalogos/finca');
    }

    public function show($id){
        $finca = Property::findOrFail($id);
        return view('catalogos.finca.show', ["finca" => $finca]);
    }

    public function edit($id) {

        /** @var TipoPropiedad $property_types */
        $property_types = TipoPropiedad::where('estatus', TipoPropiedad::STATUS_ACTIVE)->get();
        /** @var Property $property */
        $property = Property::findOrFail($id);
        $arrendador = Lessor::findOrFail($property->lessor_id); // @todo Refactor this, use relationship instead
        $lessors = Lessor::orderBy('apellido_paterno', 'asc')->get();

        return view('catalogos.finca.edit', [
            "finca" => $property, // @todo Deprecar, eliminar
            "tipo" => $property->type,
            "arrendadores" => $arrendador,
            "lessors" => $lessors,
            "property" => $property,
            'property_types' => $property_types
        ]);
    }

    public function update(PropertyRequest $request, $id){
        $data = $request->all();

        if (isset($data['estatus_renta']) && $data['estatus_renta'] == 'on'){
            $data['rented'] = null;
        }else{
            $data['rented'] = now();
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

    /**
     * @param Property $finca
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function imageDestroy(Property $finca): \Illuminate\Http\RedirectResponse
    {
        $finca->getFirstMedia()->delete();

        return Redirect::route('finca.edit', $finca->id);
    }
}
