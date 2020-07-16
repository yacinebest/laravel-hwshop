<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        factory(Role::class)->create(['type'=>'USER']);
        factory(Role::class)->create(['type'=>'ADMIN']);
        $this->user = factory(User::class)->create();
    }

     /**
     * @test
     * @return void
    */
    function can_create_user_with_factory()
    {
        $this->assertNotEmpty($this->user);
    }
}
