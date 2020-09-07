<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    private $brandRepository;
    private $imageRepository;

    public function __construct(BrandRepositoryInterface $brandRepository,
                                ImageRepositoryInterface $imageRepository) {
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
        $entities = $this->brandRepository->basePaginate();
        $columns = $this->brandRepository->getAccessibleColumn();
        $cardCountAndRoute = $this->brandRepository->getCardCountAndRoute();
        $brands = $entities ;
        return view('brands.index',compact('brands','columns','cardCountAndRoute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fillable_columns = $this->brandRepository->getFillableColumn();
        return view('brands.create',compact('fillable_columns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->processRequest($request);
        $this->brandRepository->baseCreate($data);
        return redirect(route('brand.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fillable_columns = $this->brandRepository->getFillableColumn();

        $entity = $this->brandRepository->baseFindOrFail($id);


        return view('brands.edit',compact('fillable_columns','entity'));
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
        $entity = $this->brandRepository->baseFindOrFail($id);
        $data = $this->processRequest($request);
        $this->brandRepository->update($entity,$data);
        return back()->withStatus(__('Brand successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->brandRepository->baseFindOrFail($id);
        $this->brandRepository->delete($brand);
        return redirect()->back();
    }


/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/
    public function processRequest(Request $request){
        if($request->hasFile('image')){
            $logo = $this->imageRepository->storeFile($request->file('image'),"public/uploads/logo");
            $data = ['name'=>$request->name,'logo'=>$logo] ;
        }
        else{
            $data = $request->only(['name']) ;
        }
        return $data;
    }
}
