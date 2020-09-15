<?php

namespace App\Repositories;

use App\Models\History;
use App\Models\Product;
use App\Models\Supply;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {

    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }
/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'name'=>'Name',
            'price'=>'Price',
            'updated_price_at'=>'Updated Price At',
            'copy_number'=>'Quantity',
            // 'view'=>'View',
            'categoryName'=>'Category',

            'columnCount' => '',
            // 'brands' => 'Brands',

            // 'imageCount'=>'Images',
            // 'commentCount'=>'Comment',
            // 'upVoteCount'=> 'Up Vote',
            // 'downVoteCount'=> 'Down Vote'
            // 'category_id'=>'Category',
        ];
    }

    public function getFillableColumn(){
        return [
            // 'name'=>'Name',
            // 'price'=>'Price',
            // 'copy_number'=>'Copy Number',
            // 'category_id'=>'Category',
        ];
    }

    public function getCardCountAndRoute(){
        return [
            'Product'=>['count'=>$this->countProduct(),'route'=>'product.index'],
        ];
    }
/*
|---------------------------------------------------------------------------|
| Override Interface FUNCTION                                               |
|---------------------------------------------------------------------------|
*/

    public function getCardCountAndRouteForShow($product){
        return [
            'Supply'=>['count'=> $product->supplies ? count($product->supplies) : 0 ,'route'=>'supply.show','attribute'=>$product->id],
            'History'=>['count'=> $product->histories ? count($product->histories) : 0 ,'route'=>'history.show','attribute'=>$product->id],
        ];
    }

    public function attachBrandToProduct($brand,$product){
        $product->brands()->attach($brand);
    }

    public function detachAllBrandToProduct($product){
        $product->brands()->detach();
    }

    public function getSupplies($product){
        return $product->supplies;
    }

    public function getSuppliesPaginate($product){
        return $this->defaultPaginate($product->supplies());
    }

    public function getHistoriesPaginate($product){
        return $this->defaultPaginate($product->histories());
    }

    public function attachSupplyToProduct($admission_price,$supply_date,$quantity,$product){
        $supply =
                factory(Supply::class)->create([
                    'product_id'=>$product->id,
                    'admission_price'=>$admission_price,
                    'quantity'=>$quantity,
                    'supply_date'=>$supply_date,
                    'started_at'=>now()->format('Y-m-d H:m:s'),
                    'status'=>'IN PROGRESS'
                ]);

        $product->supplies()->save($supply);
        return $supply;
    }

    public function attachHistoryToProduct($selling_price,$quantity,$product,$supply){
        $history =
                factory(History::class)->create([
                    'product_id'=>$product->id,
                    'supply_id'=>$supply->id,
                    'quantity'=>$quantity,
                    'selling_price'=>$selling_price,
                    'started_at'=>now()->format('Y-m-d H:m:s')
                ]);

        $product->histories()->save($history);
        return $history;
    }

    public function orderBySell($number = 0){
        $entities = Product::get()->sortByDesc('quantitySold');
        return $entities->take($number)->values();
    }

    public function orderByView($number = 0){
        $entities = $this->baseOrderBy(['view'=>'DESC']);
        return $this->baseTake($entities,$number);
    }

    public function getProductsIdEqualToBrands($brands,$products){
        $result = collect();
        foreach($brands as $key=>$value){
            foreach($products as $product) {
                foreach ($product->brands as $p_brand) {
                    if($p_brand->id==$value){
                        $result->push( $product->id );
                        break;
                    }
                }
            }
        }
        return $result;
    }

    public function filterProductsWithoutBrands($id,$page,$request){
        $available = -1;
        if($request->input('available'))
            $available = 0;

        $products = Product::
                where('category_id',$id)
            ->where('copy_number','>',$available)
            ->where('price','>',$request->input('min'))
            ->where('price','<',$request->input('max'))
            ->orderBy($request->input('orderBy'),$request->input('orderByDirection'))
            ->paginate($request->input('paginate'), ['*'], 'page', $page);

        return $products;
    }

    public function filterProductsWithBrands($id,$page,$request){
        $category = $this->categoryRepository->baseFindOrFail($id);

        $available = -1;
        if($request->input('available'))
            $available = 0;

        $result =  $this->getProductsIdEqualToBrands(json_decode($request->input('brands')),$category->products);
        $products = Product::
                where('category_id',$id)
            ->whereIn('id',$result)
            ->where('copy_number','>',$available)
            ->where('price','>',$request->input('min'))
            ->where('price','<',$request->input('max'))
            ->orderBy($request->input('orderBy'),$request->input('orderByDirection'))
            ->paginate($request->input('paginate'), ['*'], 'page', $page);
            return $products;
    }

    public function searchProducts($q,$nbr){
        return Product::where('name','LIKE','%'.$q.'%')->paginate($nbr);
    }

     public function filterProductForSearch($q,$page,$request){

        $products = Product::
                where('name','LIKE','%'.$q.'%')
            ->orderBy($request['orderBy'],$request['orderByDirection'])
            ->paginate($request['paginate'], ['*'], 'page', $page);
            return $products;
    }

/*
|---------------------------------------------------------------------------|
| Override Interface FUNCTION                                               |
|---------------------------------------------------------------------------|
*/

    public function countProduct(){
        return count(Product::all());
    }
}
