<?php
namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface {

    private $commentRequest = ['user_id','product_id','body'];
    private $replyRequest =  ['user_id','product_id','body','parent_id'];
/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    // public function getAccessibleColumn(){
    //     return [
    //         'logo'=>'Logo',
    //         'name'=>'Name',
    //         'created_at' => 'Created At',
    //     ];
    // }

    // public function getFillableColumn(){
    //     return [
    //         'name'=>'Name',
    //     ];
    // }

    public function paginateComments($video,$number = 10)
    {
        return $this->defaultPaginate($video->comments(),$number);
    }

    public function paginateReplies($comment,$number = 10)
    {
        return $this->defaultPaginate($comment->replies(),$number);
    }

    public function createComment(Request $request){
        return $this->baseCreate($request->only($this->commentRequest));
    }

    public function createReply(Request $request){
        return $this->baseCreate($request->only($this->replyRequest));
    }

    public function getCommentsForProduct($product,$nbr=10){
        return Comment::where('product_id',$product->id)->paginate($nbr)  ;
    }

}
