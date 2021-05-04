<?php

namespace Tests\Feature;

use App\Models\Guarantor;
use App\Models\Lessee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuarantorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGuarantorCanHavePhones(): void
    {
        /** @var Guarantor $guarantor */
        $guarantor = factory(Guarantor::class)->create();
        $guarantor->addPhoneData('6672067464', 'celular', 1);

        $this->assertSame('6672067464', $guarantor->defaultPhoneNumber->telefono);
    }

    public function testGuarantorCanBeRelatedToALessee(): void
    {
        /** @var Guarantor $guarantor */
        $guarantor = factory(Guarantor::class)->create();
        /** @var Lessee $lessee */
        $lessee = factory(Lessee::class)->create();

        $guarantor->lessee()->associate($lessee);

        $this->assertEquals($lessee->id, $guarantor->lessee()->first()->id);
    }
}
