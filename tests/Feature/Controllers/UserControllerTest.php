<?php

namespace Tests\Feature\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    protected $user;
    protected $admin;

    protected $role_user;
    protected $role_admin;


    protected function setUp(): void
    {
        parent::setUp();
        $this->role_user = factory(Role::class)->create(['type'=>'USER']);
        $this->role_admin = factory(Role::class)->create(['type'=>'ADMIN']);

        $this->user = factory(User::class)->create(['role_id'=>$this->role_user->id]);
        $this->admin = factory(User::class)->create(['role_id'=>$this->role_admin->id]);
    }

    /**
     * @test
     * @group feature_controller
     * @return void
    */
    function can_display_index_all_users()
    {
        $this->withoutExceptionHandling();

        Auth::login($this->admin);
        $response = $this->get(route('user.index'));

        $response->assertOk();
                // ->assertViewHas('users');
    }
    /**
     * @test
     * @group feature_controller
     * @return void
    */
    function can_display_index_all_admins()
    {
        $this->withoutExceptionHandling();

        Auth::login($this->admin);
        $response = $this->get(route('user.admin.index'));

        $response->assertOk();
                // ->assertViewHas('users');
    }

    /**
     * @test
     * @group feature_controller
     * @return void
    */
    function can_display_index_users()
    {
        $this->withoutExceptionHandling();

        Auth::login($this->admin);
        $response = $this->get(route('user.user.index'));

        $response->assertOk();
                // ->assertViewHas('users');
    }

    /**
     * @test
     * @group feature_controller
     * @return void
    */
    function can_edit_user()
    {
        $this->withoutExceptionHandling();

        Auth::login($this->admin);
        $response = $this->get(route('user.edit',$this->user->id));

        $response->assertOk();
    }

    /**
     * @test
     * @group feature_controller
     * @return void
    */
    function can_edit_own_profile()
    {
        $this->withoutExceptionHandling();

        Auth::login($this->user);
        $response = $this->get(route('user.edit',$this->user->id));

        $response->assertRedirect();
    }

    /**
     * @test
     * @group feature_controller
     * @return void
    */
    function can_updateRole_user()
    {
        $this->withoutExceptionHandling();

        Auth::login($this->admin);
        $response = $this->put(route('user.update',$this->user->id),['role_id'=>$this->role_admin->id]);
        $this->user->refresh();

        $this->assertEquals('ADMIN',$this->user->roleType);
    }

    /**
     * @test
     * @group feature_controller
     * @return void
    */
    function can_updateProfile_user()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        Auth::login($this->admin);
        $response = $this->put(route('user.update',$this->user->id),['role_id'=>$user->role_id, 'username'=>'fsdsfs','email'=>$this->user->email ]);
        $this->user->refresh();

        $this->assertEquals($user->roleType,$this->user->roleType);
    }

      /**
     * @test
     * @group feature_controller
     * @return void
    */
    function can_delete_user()
    {
        $this->withoutExceptionHandling();

        Auth::login($this->admin);
        $response = $this->delete(route('user.destroy',$this->user->id));

        $this->assertEmpty(User::find($this->user->id));
    }

    /**
     * @test
     * @group feature_controller
     * @return void
    */
    function can_show_profile_user()
    {
        $this->withoutExceptionHandling();

        Auth::login($this->admin);
        $response = $this->get(route('user.profile'));

        $response->assertOk();
    }


}
