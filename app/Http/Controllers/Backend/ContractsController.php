<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractRequest;
use App\Models\Lessee;
use App\Models\Contract;
use App\Models\Property;
use App\Models\FechaContrato;
use App\Models\Lessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContractsController extends Controller
{
    public function index(Request $request){
        /** @var Contract $contracts[] */
        $contracts = Contract::with('periods')->paginate();
        $contracts->transform(function ($contract) {
            /** @var Contract $contract */
            $contract->start_date = optional($contract->periods()->first())->fecha_inicio;
            $contract->end_date = optional($contract->periods()->orderByDesc('fecha_inicio')->first())->fecha_fin;
            return $contract;
        });
        return view('contrato.index', ["contracts" => $contracts ]);
    }

    public function create(){
        $arrendador = Lessor::orderBy('apellido_paterno', 'asc')->get();
        $arrendatario = Lessee::orderBy('apellido_paterno', 'asc')->get();
        $properties_availables = Property::availables()->get();

        return view('contrato.create', [
            "arrendador" => $arrendador,
            "arrendatario" => $arrendatario,
            "properties" => $properties_availables
        ]);
    }

    public function store(ContractRequest $request){
        $data = $request->all();
        /** @var Contract $contrato */
        $contrato = Contract::create($data);

        foreach ($request->get('periods') as $period) {
            $contrato->periods()->create($period);
        }

         return Redirect::to('contrato');
    }

    public function show($id){
        $co = Contract::findOrFail($id);
        return view('contrato.show', ['contrato' => $co]);
    }

    public function edit(Contract $contrato){
        $contract = $contrato;
        $dates = FechaContrato::where('id', $contract->id)->get();
        $periods = $contract->periods()->get(['fecha_inicio','fecha_fin','cantidad']);

        $periods->transform(function($period) {
            $period->quantity = $period->cantidad;
            unset($period->cantidad);

            return $period;
        });

        return view('contrato.edit', [
            'contrato' => $contract,
            'fechas' => $dates,
            'periods' => $periods->toJson(),
            'years' => $contract->periods->count()
        ]);
    }

    public function update(ContractRequest $request, $id){
        /** @var Contract $contract */
        $contract = tap(Contract::findOrFail($id))->update($request->all());

        $contract->periods()->delete();
        if ($request->has('periods')) {
            foreach ($request->get('periods') as $period) {
                $contract->periods()->create($period);
            }
        }

        return Redirect::to('contrato');
    }

    public function destroy($id){
        $c = Contract::findOrFail($id);
        $c->estatus = false;
        $c->update();
        return Redirect::to('contrato');
    }

    public function activar($id){
        $c = Contract::findOrFail($id);
        $c->estatus = true;
        $c->update();
        return Redirect::to('contrato');
    }

    public function desactivar(){
        $contracts = Contract::all();
        foreach ($contracts as $contract){
            $data = ['estatus_renta' => 'Rentada'];
            $finca = Property::findOrFail($contract->id_finca)->update($data);
        }
    }
}
