<?php

namespace App\Models;

class Vote extends BaseModel
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function voteable()
    {
        return $this->morphTo();
    }
}
