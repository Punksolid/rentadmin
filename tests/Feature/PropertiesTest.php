<?php

namespace Tests\Feature;

use App\Models\CatFinca;
use App\Models\Lessor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertiesTest extends TestCase
{
//    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPropertiesPageCanBeSeen()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('finca.index'));

        $response->assertStatus(200);
    }

    public function testLessorOfAPropertyIsShown()
    {
        /** @var CatFinca $property */
        $property = factory(CatFinca::class)->create([
            'estatus' => 1
        ]);
        $lessor = factory(Lessor::class)->create(['estatus' => Lessor::ACTIVE_STATUS]);
        $property->assignLessor($lessor);
        $call = $this->get(route('finca.index'));

        $call->assertSee($lessor->nombre);
    }

    /**
     * @issue #1
     */
    public function testShowOnlyPropertiesOfActiveLessors()
    {
        /** @var CatFinca $property */
        $property = factory(CatFinca::class)->create(['estatus' => 1]);
        $lessor_active = factory(Lessor::class)->create([
            'estatus' => Lessor::ACTIVE_STATUS
        ]);
        $property->assignLessor($lessor_active);

        /** @var CatFinca $property_from_inactive_lessor */
        $property_from_inactive_lessor = factory(CatFinca::class)->create(['estatus' => 1]);
        $lessor_inactive = factory(Lessor::class)->create([
            'estatus' => Lessor::INACTIVE_STATUS
        ]);
        $property_from_inactive_lessor->assignLessor($lessor_inactive);

        $call = $this->get(route('finca.index'));
        $call->assertSee($property->finca_arrendada);
        $call->assertDontSee($property_from_inactive_lessor->finca_arrendada);
    }

    public function testShowOnlyActiveProperties()
    {
        $active_lessor = factory(Lessor::class)->create(['estatus' => Lessor::ACTIVE_STATUS]);
        $active_property = factory(CatFinca::class)->create(['estatus' => true]);
        $active_property->assignLessor($active_lessor);
        $inactive_property = factory(CatFinca::class)->create(['estatus' => false]);
        $inactive_property->assignLessor($active_lessor);

        $call = $this->get(route('finca.index'));

        $call->assertSee($active_property->finca_arrendada);
        $call->assertDontSee($inactive_property->finca_arrendada);
    }
}
