<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $comment;

    protected function setUp(): void
    {
        parent::setUp();
        $this->comment = factory(Comment::class)->create();
    }

    /**
     * @test
     * @return void
    */
    function can_create_category_with_factory()
    {
        $this->assertNotEmpty($this->comment);
    }

     /**
     * @test
     * @return void
    */
    function can_access_user_relation()
    {
        $this->assertNotEmpty($this->comment->user);
    }

     /**
     * @test
     * @return void
    */
    function can_access_product_relation()
    {
        $this->assertNotEmpty($this->comment->product);
    }

          /**
     * @test
     * @return void
    */
    function can_access_votes_relation()
    {
        $user = factory(User::class)->create();
        $this->comment->votes()->create(['user_id'=>$user->id,'type'=>'UP']);
        $this->comment->votes()->create(['user_id'=>$user->id,'type'=>'DOWN']);


        $this->assertNotEmpty($this->comment->votes);
        $this->assertCount(2,$this->comment->votes);
    }

     /**
     * @test
     * @return void
    */
    function can_access_parent_relation()
    {
        $reply  = factory(Comment::class)->create(['parent_id'=>$this->comment->id]);

        $this->assertNotEmpty($reply);
        $this->assertNotEmpty($reply->parent);

    }
}
