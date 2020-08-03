<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface ImageRepositoryInterface extends BaseRepositoryInterface{

    public function uploadImages(Request $request,$folder = 'images',$name = 'images');
    public function storeFile($file , $path);

    public function attachImagesToEntity($images,$entity);
}
