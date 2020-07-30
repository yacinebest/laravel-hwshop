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


    public function basePaginate($column = 'created_at',$order = 'DESC',$number = 10){
        $modelClass= $this->convertRepositoryToModelName();
        return  $modelClass::orderBy($column,$order)->paginate($number);
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
