<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Models\Product;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SupplyRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository ;
    private $brandRepository ;
    private $imageRepository;
    private $supplyRepository;

    public function __construct(ProductRepositoryInterface $productRepository,
                                CategoryRepositoryInterface $categoryRepository,
                                BrandRepositoryInterface $brandRepository,
                                ImageRepositoryInterface $imageRepository,
                                SupplyRepositoryInterface $supplyRepository) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->imageRepository = $imageRepository;
        $this->supplyRepository = $supplyRepository;
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

        $supply = $this->processRequestSuppliesField($request,$product);
        $history = $this->processRequestHistoriesField($request,$product,$supply);

        $this->supplyRepository->linkHistoryToSupply($supply,$history);


        $this->processRequestBrandsField($request,$product);

        $this->processRequestImagesFile($request,$product);

        $this->processRequestDatasheetFile($request,$product);

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

        $product = $this->productRepository->baseFindOrFail( $id);

        $category = $this->categoryRepository->baseFindOrFail($product->category_id);
        $categories_level= $this->categoryRepository->getCategoriesLevels();
        $selected_categories= $this->categoryRepository->getDirectParents($category) ;

        $brands = $this->brandRepository->basePaginate();

        return view('products.edit',compact('brands','product','category','categories_level','selected_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request, $id)
    {

        $product = $this->productRepository->baseFindOrFail( $id);

        $data = $this->processRequestForStore($request);

        $this->productRepository->update($product,$data);

        $this->processRequestBrandsField($request,$product,true);

        $this->processRequestImagesFile($request,$product);

        $this->processRequestDatasheetFile($request,$product);

        return back()->withStatus(__('Product successfully updated.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->baseFindOrFail( $id);
        $this->productRepository->deleteImages($product);
        $this->productRepository->delete($product);
        return redirect()->back();
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

    public function processRequestBrandsField(Request $request,Product $product,$detach =false){
        if( $request->input('brands') ){

            if($detach)
                $this->productRepository->detachAllBrandToProduct($product);

            foreach ($request->input('brands') as $brand) {
                $this->productRepository->attachBrandToProduct($brand,$product);
            }
        }
    }

    public function processRequestImagesFile(Request $request,Product $product){
        $images = $this->imageRepository->uploadImages($request,'products');
        if($images)
            $this->imageRepository->attachImagesToEntity($images,$product);
    }

    public function processRequestDatasheetFile(Request $request,Product $product){
        if($file=$request->file('datasheet')){
            $file->store('public/uploads/datasheet/');
            $name = $file->hashName();
            $product->update(['datasheet'=> $name]);
        }
    }

    public function processRequestSuppliesField($request,$product){
        $admission_price = $request->input('admission_price');
        $quantity = $request->input('copy_number');
        $supply_date = $request->input('supply_date');
        return $this->productRepository->attachSupplyToProduct($admission_price,$supply_date,$quantity,$product);
    }

    public function processRequestHistoriesField($request,$product,$supply){
        $selling_price = $request->input('price');
        $quantity = $request->input('copy_number');
        return $this->productRepository->attachHistoryToProduct($selling_price,$quantity,$product,$supply);
    }

}
