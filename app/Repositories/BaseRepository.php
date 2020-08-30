<?php
namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Traits\Base\StringToModelNameTrait;

class BaseRepository implements BaseRepositoryInterface {
    use StringToModelNameTrait;

/*
|---------------------------------------------------------------------------|
| READ                                                                      |
|---------------------------------------------------------------------------|
*/
    public function baseFindOrFail($id){
        $modelClass= $this->convertRepositoryToModelName();
        return  $modelClass::findOrFail($id);
    }

    public function baseAll(){
        $modelClass= $this->convertRepositoryToModelName();
        return  $modelClass::all();
    }


    public function basePaginate($where = [],$order =['created_at'=>'DESC'],$number = 10){
        $modelClass= $this->convertRepositoryToModelName();

        $result = (new $modelClass)->newQuery();;
        foreach ($order as $key => $value) {
            $result->orderBy($key,$value);
        }
        foreach ($where as $key => $value) {
            $result->where($key,$value );
        }
        return $this->defaultPaginate($result,$number);
    }

    public function defaultPaginate($result,$number = 10){
        return $result->paginate($number);
    }

    public function baseCount(){
        $modelClass= $this->convertRepositoryToModelName();
        return  count( $modelClass::all() );
    }

/*
|---------------------------------------------------------------------------|
| CREATE                                                                    |
|---------------------------------------------------------------------------|
*/
    public function baseCreate($data)
    {
        $modelClass= $this->convertRepositoryToModelName( );
        return  $modelClass::create($data)->fresh();
    }

/*
|---------------------------------------------------------------------------|
| UPDATE                                                                    |
|---------------------------------------------------------------------------|
*/
    public function update($entity,$data){
        return $entity->update($data);
    }

/*
|---------------------------------------------------------------------------|
| DELETE                                                                    |
|---------------------------------------------------------------------------|
*/
    public function delete($entity){
        $entity->delete();
    }

    public function deleteImages($entity){
        if ($entity->imageCount > 0) {
            collect($entity->images)->map(function($image){
                $this->delete($image);
            });
        }
    }

    public function deleteVotes($entity){
        if ($entity->voteCount > 0) {
            collect($entity->votes)->map(function($vote){
                $this->delete($vote);
            });
        }
    }

/*
|---------------------------------------------------------------------------|
| Custom                                                                    |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [];
    }

    public function getFillableColumn(){
        return [];
    }
}
