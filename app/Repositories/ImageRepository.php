<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ImageRepositoryInterface;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface{

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'file'=>'File',
            'imageable_type'=>'Type',
            'imageable_id'=>'Id',
            // 'created_at' => 'Created At'
        ];
    }

    // public function getCardCountAndRoute(){
    //     return [
    //         // 'Admin'=>['count'=>$this->countOnlyAdmin(),'route'=>'user.admin.index'],
    //         // 'User'=>['count'=>$this->countOnlyUser(),'route'=>'user.user.index'],
    //         // 'All User'=>['count'=>$this->baseCount(),'route'=>'user.index'],
    //     ];
    // }
}
