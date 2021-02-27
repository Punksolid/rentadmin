<?php

namespace Tests\Unit;

use App\Models\Lessor;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessorTest extends TestCase
{
    /** @var Generator */
    private $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLessorHasAPrincipalPhoneNumber()
    {
        $lessor = factory(Lessor::class)->create();
        $phone_number = $this->faker->phoneNumber;
        $description = $this->faker->word;
        $lessor->addPhoneData($phone_number, $description, 1);

        $this->assertEquals($phone_number, $lessor->getPhoneData()->telefono);
        $this->assertEquals($description, $lessor->getPhoneData()->descripcion);
        $this->assertEquals(1, $lessor->getPhoneData()->estatus);
    }
}
