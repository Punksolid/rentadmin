<?php

namespace Tests\Feature;

use App\Models\CatContrato;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContractTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testContractsLists()
    {

        $response = $this->get(route('contrato.index'));

        $response->assertStatus(200);
    }

    public function testContractForm()
    {
        $call = $this->get(route('contrato.create'));

        $call->assertSuccessful();
    }

    public function testContractFormUpdate()
    {
        $this->withoutExceptionHandling();
        $contract = factory(CatContrato::class)->create();
        $call = $this->get(route('contrato.edit', [
            $contract->id_contratos
        ]));

        $call->assertSuccessful();
    }
}
