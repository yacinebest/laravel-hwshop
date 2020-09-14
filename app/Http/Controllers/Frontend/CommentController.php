<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $commentRepository;
    private $productRepository;

    public function __construct(CommentRepositoryInterface $commentRepository,
                                ProductRepositoryInterface $productRepository) {
        $this->commentRepository = $commentRepository;
        $this->productRepository = $productRepository;
    }


    public function index($id)
    {
        $product = $this->productRepository->baseFindOrFail($id);
        return $this->commentRepository->paginateComments($product);
    }

    public function show($id)
    {
        $comment = $this->commentRepository->baseFindOrFail($id);
        return $this->commentRepository->paginateReplies($comment);  ;
    }

    public function store( Request $request)
    {
        $request['user_id']=Auth::user()->id;
        return ($request->has('parent_id')) ? $this->commentRepository->createReply($request) : $this->commentRepository->createComment($request) ;
    }
}
