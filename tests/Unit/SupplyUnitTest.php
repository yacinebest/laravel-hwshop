<?php

namespace Tests\Unit;

use App\Models\Supply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class SupplyUnitTest extends TestCase
{
     use RefreshDatabase;
    use DatabaseMigrations;

    protected $supply;

    protected function setUp(): void
    {
        parent::setUp();
        $this->supply = factory(Supply::class)->create();

    }

     /**
     * @test
     * @return void
    */
    function can_create_supply_with_factory()
    {
        $this->assertNotEmpty($this->supply);
    }

      /**
     * @test
     * @return void
    */
    function can_access_product_relation()
    {



        $this->assertNotEmpty($this->supply->product);
        // $this->assertCount(1,$this->supply->product);
    }
}
