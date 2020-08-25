<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository ;
    private $brandRepository ;
    private $imageRepository;

    public function __construct(ProductRepositoryInterface $productRepository,
                                CategoryRepositoryInterface $categoryRepository,
                                BrandRepositoryInterface $brandRepository,
                                ImageRepositoryInterface $imageRepository) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = $this->productRepository->basePaginate();
        $columns = $this->productRepository->getAccessibleColumn();
        // $cardCountAndRoute = $this->productRepository->getCardCountAndRoute();

        return view('products.index',compact('entities','columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fillable_columns = $this->productRepository->getFillableColumn();
        $categories_level= $this->categoryRepository->getCategoriesLevels();
        $brands = $this->brandRepository->basePaginate();

        return view('products.create',compact('fillable_columns','categories_level','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $this->processRequestForStore($request);
        $product = $this->productRepository->baseCreate( $data);

        if( $request->input('brands') ){
            foreach ($request->input('brands') as $brand) {
                $product->brands()->attach($brand);
            }
        }

        $images = $this->imageRepository->uploadImages($request,'products');
        if($images)
            $this->imageRepository->attachImagesToEntity($images,$product);


        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/

    public function processRequestForStore(Request $request){
        $data = array_merge(
                $request->only(['name','description','price','copy_number']),
                ['category_id'=>$request['parent_id'],'updated_price_at'=>now()->format('Y-m-d H:m:s')]
            );
        return $data;
    }

}
