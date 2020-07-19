<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $role_user;
    protected $role_admin;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->role_user = factory(Role::class)->create(['type'=>'USER']);
        // $this->role_admin = factory(Role::class)->create(['type'=>'ADMIN']);
        $this->role_user =  Role::whereType('USER');
        $this->role_admin = Role::whereType('ADMIN');

    }
    /**
     * @test
     * @return void
    */
    function can_access_users_relation()
    {
        $users = factory(User::class,5)->create(['role_id'=>$this->role_user->id]);
        $this->assertCount(5,$users);
        $this->assertCount(5,$this->role_user->users);
    }

    /**
     * @test
     * @return void
    */
    function can_get_all_roles()
    {
        dd(Role::all(['type']));
    }
}
