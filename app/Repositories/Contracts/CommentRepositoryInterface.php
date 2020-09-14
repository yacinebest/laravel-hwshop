<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface CommentRepositoryInterface extends BaseRepositoryInterface {
    public function paginateComments($video,$number = 10);
    public function paginateReplies($comment,$number = 10);
    public function createComment(Request $request);
    public function createReply(Request $request);
}
