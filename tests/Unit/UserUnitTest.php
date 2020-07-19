<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $user;
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $role_user = factory(Role::class)->create(['type'=>'USER']);
        $role_admin = factory(Role::class)->create(['type'=>'ADMIN']);

        $this->user = factory(User::class)->create(['role_id'=>$role_user->id]);
        $this->admin = factory(User::class)->create(['role_id'=>$role_admin->id]);
    }

     /**
     * @test
     * @return void
    */
    function can_create_user_with_factory()
    {
        $this->assertNotEmpty($this->user);
    }

    /**
     * @test
     * @return void
    */
    function can_access_role_relation()
    {
        $this->assertNotEmpty($this->user->role);
        $this->assertEquals ($this->user->role->type , 'USER');
        $this->assertEquals ($this->admin->role->type , 'ADMIN');
    }

     /**
     * @test
     * @return void
    */
    function can_access_orders_relation()
    {
        $orders = factory(Order::class,5)->create(['user_id'=>$this->user->id]);

        $this->assertCount(5,$orders);
        $this->assertCount(5,$this->user->orders);

    }

    // /**
    //  * @test
    //  * @return void
    // */
    // function can_access_image_relation()
    // {
    //     $this->user->images()->create(['file'=>'t.jpg']);
    //     $this->user->images()->create(['file'=>'t2.jpg']);


    //     $this->assertNotEmpty($this->user->images);
    //     $this->assertCount(2,$this->user->images);
    // }

     /**
     * @test
     * @return void
    */
    function can_access_comments_relation()
    {
        $product = factory(Product::class)->create();
        $this->user->comments()->create(['product_id'=>$product->id,'body'=>'tdfd']);
        $this->user->comments()->create(['product_id'=>$product->id,'body'=>'يؤيؤيtdfd']);

        $this->assertNotEmpty($this->user->comments);
        $this->assertCount(2,$this->user->comments);
    }

    /**
     * @test
     * @return void
    */
    function can_access_votes_relation()
    {
        $votes = factory(Vote::class,4)->create(['user_id'=>$this->user->id]);

        $this->assertNotEmpty($this->user->votes);
        $this->assertCount(4,$this->user->votes);
    }


      //  /**
    //  * @test
    //  * @return void
    // */
    // function can_count_comments_relation()
    // {
    //     $product = factory(Product::class)->create();
    //     $this->user->comments()->create(['product_id'=>$product->id,'body'=>'tdfd']);
    //     $this->user->comments()->create(['product_id'=>$product->id,'body'=>'sftdfd']);

    //     $this->assertNotEmpty($this->user->comments);
    //     $this->assertCount(2,$this->user->comments);
    // }

}
