<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $image;

    protected function setUp(): void
    {
        parent::setUp();
        $this->image = factory(Image::class)->create();
    }

    /**
     * @test
     * @return void
    */
    function can_create_image_with_factory()
    {
        $this->assertNotEmpty($this->image);
    }

    // /**
    //  * @test
    //  * @return void
    // */
    // function can_read_type()
    // {
    //     dd($this->image->imageable_type);
    // }


}
