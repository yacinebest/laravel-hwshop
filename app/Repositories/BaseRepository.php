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


    public function basePaginate($number = 10){
        $modelClass= $this->convertRepositoryToModelName();
        return  $modelClass::paginate($number);
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
}
