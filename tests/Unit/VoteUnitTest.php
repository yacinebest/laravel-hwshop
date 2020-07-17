<?php

namespace Tests\Unit;

use App\Models\Vote;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VoteUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $vote;

    protected function setUp(): void
    {
        parent::setUp();
        $this->vote = factory(Vote::class)->create();
    }

    /**
     * @test
     * @return void
    */
    function can_create_vote_with_factory()
    {
        $this->assertNotEmpty($this->vote);
    }


     /**
     * @test
     * @return void
    */
    function can_access_user_relation()
    {
        $this->assertNotEmpty($this->vote->user);
    }


}
