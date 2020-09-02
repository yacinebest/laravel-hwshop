<?php

namespace Tests\Unit;

use App\Models\History;
use App\Models\Supply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HistoryUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $history;

    protected function setUp(): void
    {
        parent::setUp();
        $this->history = factory(History::class)->create();

    }

     /**
     * @test
     * @return void
    */
    function can_create_history_with_factory()
    {
        $this->assertNotEmpty($this->history);
        // dd($this->history);
    }

}
