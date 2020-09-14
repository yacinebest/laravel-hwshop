<?php

namespace App\Models;

class Comment extends BaseModel
{

    // protected $appends =[];
    protected $appends =['username','upVoteCount','downVoteCount','voteCount'];
    // protected $with =['user'] ;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function votes()
    {
        return $this->morphMany('App\Models\Vote', 'voteable');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Comment','parent_id')->whereNotNull('parent_id')->orderBy('created_at','DESC');
    }


/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/

    /**
     * @return number
     */
    public function getUpVoteCountAttribute()
    {
        return count($this->votes()->whereType('UP')->get());
    }
    /**
     * @return number
     */
    public function getDownVoteCountAttribute()
    {
        return count($this->votes()->whereType('DOWN')->get());
    }

     /**
     * @return number
     */
    public function getVoteCountAttribute()
    {
        return count($this->votes);
    }

    public function getUsernameAttribute()
    {
        return $this->user->username;
    }

}
