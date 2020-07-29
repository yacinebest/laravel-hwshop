<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = $this->categoryRepository->basePaginate();
        $columns = $this->categoryRepository->getAccessibleColumn();
        $cardCountAndRoute = $this->categoryRepository->getCardCountAndRoute();

        $baseCategories = $this->categoryRepository->getBaseCategories();

        return view('categories.index',compact('cardCountAndRoute','entities','columns','baseCategories'));
    }

    public function indexJson()
    {
        return response()->json( $this->categoryRepository->allCategories() );
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
        $this->categoryRepository->create($request);
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

        $this->categoryRepository->updateCategoriesWithChilds($category,$request);

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
}
