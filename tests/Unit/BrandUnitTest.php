<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $brand;

    protected function setUp(): void
    {
        parent::setUp();
        $this->brand = factory(Brand::class)->create();
    }

    /**
     * @test
     * @return void
    */
    function can_create_category_with_factory()
    {
        $this->assertNotEmpty($this->brand);
    }

     /**
     * @test
     * @return void
    */
    function can_access_pivot_brand_product_relation()
    {
        $this->brand->products()->attach(factory(Product::class)->create());
        $this->brand->products()->attach(factory(Product::class)->create());

        $this->assertNotEmpty($this->brand->products);
        $this->assertCount(2,$this->brand->products);
    }

     /**
     * @test
     * @return void
    */
    function can_access_pivot_brand_category_relation()
    {
        $this->brand->categories()->attach(factory(Category::class)->create());
        $this->brand->categories()->attach(factory(Category::class)->create());

        $this->assertNotEmpty($this->brand->categories);
        $this->assertCount(2,$this->brand->categories);
    }

        /**
     * @test
     * @return void
    */
    function can_access_image_relation()
    {
        $this->brand->images()->create(['file'=>'t.jpg']);
        $this->brand->images()->create(['file'=>'t2.jpg']);


        $this->assertNotEmpty($this->brand->images);
        $this->assertCount(2,$this->brand->images);
    }
}
