<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends BaseModel
{
    protected $appends =['isCCP'];

/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/

    public function getIsCCPAttribute(){
        return $this->method=='CCP' ;
    }
}
