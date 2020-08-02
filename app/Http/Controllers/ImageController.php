<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Repositories\Contracts\ImageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    private $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository) {
        $this->imageRepository = $imageRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = $this->imageRepository->basePaginate([],['imageable_type'=>'ASC','imageable_id'=>'DESC']);
        $columns = $this->imageRepository->getAccessibleColumn();
        // $cardCountAndRoute = $this->imageRepository->getCardCountAndRoute();


        return view('images.index',compact('entities','columns'));
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


    // public static function uploadImage(Request $request)
    // {
    //     $file = ImageController::storeFile($request->file('file'),"public/uploads/images");
    //     return $file;
    // }

    public static function storeFile($file , $path)
    {
        $file->store($path);
        return $file->hashName();
    }
}