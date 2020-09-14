<?php
namespace App\Repositories;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Vote;
use App\Repositories\Contracts\Common\Traits\ReadTraits;
use App\Repositories\Contracts\VoteRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VoteRepository extends BaseRepository implements VoteRepositoryInterface {

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/

    public function getFillableColumn(){
        return [
            // 'type'=>'Type',
        ];
    }

    public function otherFindOrFail($id,$model = null){
        if($model=='Product')
            return Product::findOrFail($id);
        else if($model == 'Comment')
            return Comment::findOrFail($id);
        else if($model == 'Vote')
            return Vote::findOrFail($id);
        else
            throw new ModelNotFoundException('Entity Not Found');
    }
}
