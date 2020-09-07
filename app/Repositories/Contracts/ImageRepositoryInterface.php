<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Base\CardCountRouteInterface;
use Illuminate\Http\Request;

interface ImageRepositoryInterface extends BaseRepositoryInterface, CardCountRouteInterface{

    public function uploadImages(Request $request,$folder = 'images',$name = 'images');
    public function storeFile($file , $path);

    public function attachImagesToEntity($images,$entity);
}
