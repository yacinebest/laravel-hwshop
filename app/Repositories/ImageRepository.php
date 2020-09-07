<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ImageRepositoryInterface;
use Illuminate\Http\Request;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface{

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'imagePath'=>'Image',
            'imageable_type'=>'Type',
            'imageable_id'=>'Name',

            // 'created_at' => 'Created At'
        ];
    }

    public function getCardCountAndRoute(){
        return [
            'Images'=>['count'=>$this->baseCount(),'route'=>'image.index']
        ];
    }

    public function uploadImages(Request $request,$folder = 'images',$name = 'images')
    {
        $images=array();
        if($files=$request->file($name)){
            foreach($files as $file){
                $name= $this->storeFile($file,'public/uploads/' . $folder);
                $images[]=$name;
            }
        }
        return $images;
    }

    public function storeFile($file , $path)
    {
        $file->store($path);
        return $file->hashName();
    }

    public function attachImagesToEntity($images,$entity){
        if (count($images)>0) {
            array_map(function($name) use ($entity){
                $entity->images()->create(['file'=>$name]);
            },$images);
        }
    }

}
