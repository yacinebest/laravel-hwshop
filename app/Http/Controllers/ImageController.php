<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class ImageController extends Controller
{
    private $imageRepository;
    private $categoryRepository;
    private $productRepository;

    public function __construct(ImageRepositoryInterface $imageRepository,
                                CategoryRepositoryInterface $categoryRepository,
                                ProductRepositoryInterface $productRepository) {
        $this->imageRepository = $imageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = $this->imageRepository->basePaginate([],['imageable_type'=>'ASC','imageable_id'=>'DESC']);
        $columns = $this->imageRepository->getAccessibleColumn();
        // $cardCountAndRoute = $this->imageRepository->getCardCountAndRoute();

        return view('images.index',compact('columns','images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $entity = $this->categoryRepository->baseFindOrFail($request->entity_id);
            $folder= "categories";
        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            $entity = $this->productRepository->baseFindOrFail($request->entity_id);
            $folder= "products";
        } catch (\Throwable $th) {
            //throw $th;
        }

        foreach ($request->images as $image) {
            $name= $this->imageRepository->storeFile($image,'public/uploads/' . $folder);
            $images[]=$name;
        }


        if($images)
            $this->imageRepository->attachImagesToEntity($images,$entity);
        $entity->refresh();
        return response()->json($entity->images);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image =  $this->imageRepository->baseFindOrFail($id);
        $this->imageRepository->delete($image);
        return response()->json([]);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd([]);
        $columns = $this->imageRepository->getAccessibleColumn();
        try {
            $entity = $this->categoryRepository->baseFindOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            $entity = $this->productRepository->baseFindOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $images = $entity->images;
        return view('images.show',compact('columns','entity','images'));
        // return view('images.show',compact('columns','category','images'));
    }

    public static function upload(Request $request)
    {
        return response()->json($request->all());
        dd($request);
    }
}
