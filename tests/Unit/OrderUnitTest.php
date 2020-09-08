<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $order;
    protected $owner;

    protected function setUp(): void
    {
        parent::setUp();
        $role_user = factory(Role::class)->create(['type'=>'USER']);
        $this->owner = factory(User::class)->create(['role_id'=>$role_user->id]);
        $this->order = factory(Order::class)->create(['user_id'=>$this->owner->id]);
    }

    /**
     * @test
     * @return void
    */
    function can_create_order_with_factory()
    {
        $this->assertNotEmpty($this->order );
    }

    /**
     * @test
     * @return void
    */
    function can_access_user_relation()
    {
        $this->assertNotEmpty($this->order->user);
    }

    /**
     * @test
     * @return void
    */
    function can_access_admin_relation()
    {
        $role_admin = factory(Role::class)->create(['type'=>'ADMIN']);
        $admin = factory(User::class)->create(['role_id'=>$role_admin->id]);
        $this->order->update(['admin_id'=>$admin->id]);
        $this->assertNotEmpty($this->order->admin);
    }


    /**
     * @test
     * @return void
    */
    function can_access_pivot_order_product_relation()
    {
        $this->order->products()->attach(factory(Product::class)->create(),['ordered_quantity'=>10]);
        $this->order->products()->attach(factory(Product::class)->create(),['ordered_quantity'=>20]);

        $this->assertNotEmpty($this->order->products);
        $this->assertCount(2,$this->order->products);
        $this->assertEquals($this->order->products->get(0)->pivot->ordered_quantity,10);
        $this->assertEquals($this->order->products->get(1)->pivot->ordered_quantity,20);

        // dd($this->order->products);
    }

    /**
     * @test
     * @return void
    */
    function can_access_payment_relation()
    {
        $payment = factory(Payment::class)->create(['contact_info'=>'CCP123456789']);
        $this->order->update(['payment_id'=>$payment->id]);
        $this->assertNotEmpty($this->order->payment);
    }

     /**
     * @test
     * @return void
    */
    function can_access_invoice_relation()
    {
        $this->order->products()->attach(factory(Product::class)->create(['price'=>5000]),['ordered_quantity'=>10]);
        $this->order->products()->attach(factory(Product::class)->create(['price'=>2500]),['ordered_quantity'=>20]);

        $quantity = $this->order->products->get(0)->pivot->ordered_quantity +
                    $this->order->products->get(1)->pivot->ordered_quantity;

        $total_price = $this->order->products->get(0)->price +
                        $this->order->products->get(1)->price;

        $invoice = factory(Invoice::class)->create([
            'quantity'=>$quantity,
            'total_price'=>$total_price
        ]);

        $this->order->invoice()->associate($invoice);

        $this->order->save();
        $invoice->save();

        $this->assertNotEmpty($this->order->invoice);
    }

}
