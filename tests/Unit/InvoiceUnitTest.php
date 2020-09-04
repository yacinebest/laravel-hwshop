<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InvoiceUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $invoice;

    protected function setUp(): void
    {
        parent::setUp();

        $order = factory(Order::class)->create();
        $order->products()->attach(factory(Product::class)->create(['price'=>5000]),['ordered_quantity'=>10]);
        $order->products()->attach(factory(Product::class)->create(['price'=>3000]),['ordered_quantity'=>5]);

        $quantity = $order->products->get(0)->pivot->ordered_quantity +
                    $order->products->get(1)->pivot->ordered_quantity;

        $total_price = $order->products->get(0)->price +
                        $order->products->get(1)->price;

        $this->invoice = factory(Invoice::class)->create([
            'quantity'=>$quantity,
            'total_price'=>$total_price
        ]);

        $order->invoice()->associate($this->invoice);
        $order->save();
        $this->invoice->save();
    }

     /**
     * @test
     * @return void
    */
    function can_create_invoice_with_factory()
    {
        $this->assertNotEmpty($this->invoice);

    }

      /**
     * @test
     * @return void
    */
    function can_access_order_relation()
    {
        $this->assertNotEmpty($this->invoice->order);
    }
}
