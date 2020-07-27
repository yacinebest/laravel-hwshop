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
        if(request()->wantsJson())
            return response()->json(Category::all());
        else{
            $page='Categories';
            $baseCategories = Category::with('childs')->where('parent_id',null)->get();
            $entities = $this->categoryRepository->paginate();
            $columns = $this->categoryRepository->getAccessibleColumn();
            $cardCountAndRoute = [];

            $auth = Auth::user();

            $route_name= 'category';

            // return view('layouts.default.index',compact('page','entities','cardCountAndRoute','columns','auth','display'));
            return view('categories.index',compact('page','entities','cardCountAndRoute','columns','auth','baseCategories','route_name'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page='Create Categories';
        $route_name= 'category';
        $fillable_columns = $this->categoryRepository->getFillableColumn();
        $cardCountAndRoute = [];
        $auth = Auth::user();

        $level=1;
        $categories_level= [];
        do {
            $categories_level[$level]=Category::where('level',$level)->get();
            $level++;
        } while (count(Category::where('level',$level)->get())>0);

        return view('categories.create',compact('page','cardCountAndRoute','fillable_columns','route_name','auth','categories_level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->categoryRepository->create($request);
        return redirect(route('category.index'));
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
        $page='Update Categories';
        $route_name= 'category';
        $fillable_columns = $this->categoryRepository->getFillableColumn();
        $cardCountAndRoute = [];
        $category = $this->categoryRepository->findOrFail($id);

        $level=1;
        $categories_level= [];
        do {
            $categories_level[$level]=Category::where('level',$level)->get();
            $level++;
        } while (count(Category::where('level',$level)->get())>0);

        $selected_categories= [];
        // $selected_categories['select_'.$category->level] = $category;
        $parent_id = $category->parent_id;
        for ($i=$category->level; $i > 0 && $parent_id!=null ; $i--) {
            $selected_categories['select_'.$i] = $this->categoryRepository->findOrFail($parent_id);
            $parent_id = $selected_categories['select_'.$i]->parent_id;
        }

        return view('categories.edit',compact('page','cardCountAndRoute','fillable_columns','route_name','category','categories_level','selected_categories'));

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
        $category = $this->categoryRepository->findOrFail($id);
        // dd($category,$request->all());
        $level =  ($request->parent_id ? $this->categoryRepository->findOrFail($request->parent_id)->level + 1 : 1  );
        $this->categoryRepository->update($category,['name'=>$request->name,'parent_id'=> $request->parent_id,'level'=>$level]);
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
        //
    }
}
