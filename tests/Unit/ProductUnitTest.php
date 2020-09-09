<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\History;
use App\Models\Order;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Supply;
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

       /**
     * @test
     * @return void
    */
    function can_access_brands_relation()
    {
        $user = factory(User::class)->create();
        $this->product->brands()->create(['name'=>"dqsdqsd"]);
        $this->product->brands()->create(['name'=>"dqsdqsd"]);

        $this->assertNotEmpty($this->product->brands);
        $this->assertCount(2,$this->product->brands);

    }

       /**
     * @test
     * @return void
    */
    function can_attach_brands_relation()
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
    function can_detach_brands_relation()
    {
        $this->product->brands()->attach(factory(Brand::class)->create());
        $this->product->brands()->attach(factory(Brand::class)->create());

        $this->assertNotEmpty($this->product->brands);
        $this->assertCount(2,$this->product->brands);

        $this->product->brands()->detach();

        $this->product = $this->product->refresh();

        $this->assertEmpty($this->product->brands);
        $this->assertCount(0,$this->product->brands);
    }

        /**
     * @test
     * @return void
    */
    function can_access_supplies_relation()
    {
        for ($i=0; $i <2 ; $i++) {
            $this->product->supplies()->save(
                factory(Supply::class)->create(['product_id'=>$this->product->id])
            );
        }

        $this->product = $this->product->refresh();

        $this->assertNotEmpty($this->product->supplies);
        $this->assertCount(2,$this->product->supplies);
    }

       /**
     * @test
     * @return void
    */
    function find_number_product_sold(){
        $product = factory(Product::class)->create(['copy_number'=>20]);
        for ($i=0; $i <2 ; $i++) {
            $supply = factory(Supply::class)->create(['product_id'=>$product->id,'quantity'=>20]);
            
            $data =  [
                'supply_id'=>$supply->id,
                'product_id'=>$product->id,
                'quantity'=> $supply->quantity,
                'selling_price'=> $supply->admission_price 
            ];
            $history = factory(History::class)->create($data);

            $supply->update(['history_id'=>$history->id]);
    
            $product->supplies()->save($supply);
            $supply->changeStatToInProgress();
            $supply->changeStatToCompleted();
        }

        $supply = factory(Supply::class)->create(['product_id'=>$product->id,'quantity'=>20]);
        $data =  [
            'supply_id'=>$supply->id,
            'product_id'=>$product->id,
            'quantity'=> $supply->quantity,
            'selling_price'=> $supply->admission_price 
        ];
        $history = factory(History::class)->create($data);

        $supply->update(['history_id'=>$history->id]);
        $product->supplies()->save($supply);
        $supply->changeStatToInProgress();

        $product->update(['copy_number'=>12]);
        $product = $product->refresh();

        dd([$product->quantitySold,$product->supplies]);
        $this->assertNotEmpty($product->supplies);
        $this->assertCount(3,$product->supplies);
    }
}
