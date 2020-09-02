<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends BaseModel
{
/*
|---------------------------------------------------------------------------|
| RELATIONSHIP                                                              |
|---------------------------------------------------------------------------|
*/
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function history()
    {
        return $this->belongsTo('App\Models\History');
    }
}
