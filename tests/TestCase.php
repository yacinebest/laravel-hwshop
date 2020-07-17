<?php

namespace Tests;

use App\Models\Role;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        factory(Role::class)->create(['type'=>'USER']);
        factory(Role::class)->create(['type'=>'ADMIN']);
    }
}
