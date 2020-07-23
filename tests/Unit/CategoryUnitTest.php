<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryUnitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = factory(Category::class)->create();
    }

    /**
     * @test
     * @return void
    */
    function can_create_category_with_factory()
    {
        $this->assertNotEmpty($this->category);
    }

    /**
     * @test
     * @return void
    */
    function can_access_products_relation()
    {
        $products  = factory(Product::class,5)->create(['category_id'=>$this->category->id]);
        $this->assertCount(5,$products);
        $this->assertCount(5,$this->category->products);
    }

    /**
     * @test
     * @return void
    */
    function can_access_parent_relation()
    {
        $subcategory  = factory(Category::class)->create(['parent_id'=>$this->category->id]);

        $this->assertNotEmpty($subcategory);
        $this->assertNotEmpty($this->category->childs);
        // $this->assertNotEmpty($subcategory->parent);

    }

     /**
     * @test
     * @return void
    */
    function can_access_pivot_brand_category_relation()
    {
        $this->category->brands()->attach(factory(Brand::class)->create());
        $this->category->brands()->attach(factory(Brand::class)->create());

        $this->assertNotEmpty($this->category->brands);
        $this->assertCount(2,$this->category->brands);
    }

     /**
     * @test
     * @return void
    */
    function can_access_image_relation()
    {
        $this->category->images()->create(['file'=>'t.jpg']);
        $this->category->images()->create(['file'=>'t2.jpg']);


        $this->assertNotEmpty($this->category->images);
        $this->assertCount(2,$this->category->images);
    }
}
