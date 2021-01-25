<?php

namespace Tests\Feature;

use App\Models\Contract;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContractTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testContractsLists()
    {
        $this->withoutExceptionHandling();
        $contract = factory(Contract::class)->create();
        $response = $this->get(route('contrato.index'));

        $response->assertStatus(200);
        $response->assertSee($contract->lessor->nombre);
        $response->assertSee($contract->lessee->nombre);
        $response->assertSee($contract->property->name);
    }

    public function testContractForm()
    {
        $call = $this->get(route('contrato.create'));

        $call->assertSuccessful();
    }

    public function testContractFormUpdate()
    {
        $this->withoutExceptionHandling();
        $contract = factory(Contract::class)->create();
        $call = $this->get(route('contrato.edit', [
            $contract->id
        ]));

        $call->assertSuccessful();
    }
}
