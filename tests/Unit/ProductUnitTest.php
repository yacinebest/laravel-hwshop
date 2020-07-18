<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Order;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = factory(Product::class)->create();
    }

    /**
     * @test
     * @return void
    */
    function can_create_product_with_factory()
    {
        $this->assertNotEmpty($this->product);
    }

    /**
     * @test
     * @return void
    */
    function can_access_category_relation()
    {
        $this->assertNotEmpty($this->product->category);
    }

    /**
     * @test
     * @return void
    */
    function can_access_pivot_order_product_relation()
    {
        $this->product->orders()->attach(factory(Order::class)->create(),['ordered_quantity'=>10]);
        $this->product->orders()->attach(factory(Order::class)->create(),['ordered_quantity'=>20]);

        $this->assertNotEmpty($this->product->orders);
        $this->assertCount(2,$this->product->orders);
        $this->assertEquals($this->product->orders->get(0)->pivot->ordered_quantity,10);
        $this->assertEquals($this->product->orders->get(1)->pivot->ordered_quantity,20);
    }

         /**
     * @test
     * @return void
    */
    function can_access_pivot_brand_product_relation()
    {
        $this->product->brands()->attach(factory(Brand::class)->create());
        $this->product->brands()->attach(factory(Brand::class)->create());

        $this->assertNotEmpty($this->product->brands);
        $this->assertCount(2,$this->product->brands);
    }

       /**
     * @test
     * @return void
    */
    function can_access_image_relation()
    {
        $this->product->images()->create(['file'=>'t.jpg']);
        $this->product->images()->create(['file'=>'t2.jpg']);


        $this->assertNotEmpty($this->product->images);
        $this->assertCount(2,$this->product->images);
    }

    /**
     * @test
     * @return void
    */
    function can_access_comments_relation()
    {
        $user = factory(User::class)->create();
        $this->product->comments()->create(['user_id'=>$user->id,'body'=>'tdfd']);
        $this->product->comments()->create(['user_id'=>$user->id,'body'=>'يؤيؤيtdfd']);

        $this->assertNotEmpty($this->product->comments);
        $this->assertCount(2,$this->product->comments);
    }

        /**
     * @test
     * @return void
    */
    function can_access_votes_relation()
    {
        $user = factory(User::class)->create();
        $this->product->votes()->create(['user_id'=>$user->id,'type'=>'UP']);
        $this->product->votes()->create(['user_id'=>$user->id,'type'=>'DOWN']);


        $this->assertNotEmpty($this->product->votes);
        $this->assertCount(2,$this->product->votes);
    }
}