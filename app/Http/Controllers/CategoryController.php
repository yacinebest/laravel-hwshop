<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $imageRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository,ImageRepositoryInterface $imageRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = $this->categoryRepository->basePaginate();
        return $this->loadIndex($entities);
    }

    public function indexJson()
    {
        return response()->json( $this->categoryRepository->baseAll() );
    }

    public function indexByLevel($level = null)
    {
        $entities = $this->categoryRepository->basePaginate( $level ? ['level'=> intval($level)] : []) ;
        return $this->loadIndex($entities);
    }

    private function loadIndex($entities){
        $columns = $this->categoryRepository->getAccessibleColumn();
        $cardCountAndRoute = $this->categoryRepository->getCardCountAndRoute();
        $baseCategories = $this->categoryRepository->getBaseCategories();

        $categories = $entities;
        return view('categories.index',compact('cardCountAndRoute','categories','columns','baseCategories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $fillable_columns = $this->categoryRepository->getFillableColumn();
        $categories_level= $this->categoryRepository->getCategoriesLevels();
        return view('categories.create',compact('fillable_columns','categories_level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->processRequestForStore($request);
        $category = $this->categoryRepository->baseCreate( $data);

        $images = $this->imageRepository->uploadImages($request,'categories');

        $this->imageRepository->attachImagesToEntity($images,$category);

        return redirect(route('category.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fillable_columns = $this->categoryRepository->getFillableColumn();

        $category = $this->categoryRepository->baseFindOrFail($id);

        $categories_level= $this->categoryRepository->getCategoriesLevels();

        $selected_categories= $this->categoryRepository->getDirectParents($category) ;
        return view('categories.edit',compact('fillable_columns','category','categories_level','selected_categories'));
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

        $category = $this->categoryRepository->baseFindOrFail($id);

        $this->categoryRepository->updateWithChilds($category,$request);

        $images = $this->imageRepository->uploadImages($request,'categories');

        $this->imageRepository->attachImagesToEntity($images,$category);

        return back()->withStatus(__('Category successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->baseFindOrFail($id);
        $this->categoryRepository->deleteWithChilds($category);
        return redirect()->back();
    }

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/

    public function processRequestForStore(Request $request){
        if($request->has('parent_id') && $request->parent_id!=null )
            $data = array_merge( $request->only(['parent_id','name']) , ['level'=>$this->categoryRepository->getLevelCategory($request['parent_id']) + 1] );
        else
            $data = $request->only(['name']);
        return $data;
    }
}
