<?php

namespace Tests\Unit;

use App\Models\Payment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PaymentUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $payment;

    protected function setUp(): void
    {
        parent::setUp();
        $this->payment = factory(Payment::class)->create(['contact_info'=>'CCP123456789']);

    }

     /**
     * @test
     * @return void
    */
    function can_create_payment_with_factory()
    {
        $this->assertNotEmpty($this->payment);
        dd($this->payment);
    }

}
