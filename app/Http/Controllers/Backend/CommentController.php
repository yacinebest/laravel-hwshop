<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    private $commentRepository;
    private $productRepository;

    public function __construct(CommentRepositoryInterface $commentRepository,
                                ProductRepositoryInterface $productRepository) {
        $this->commentRepository = $commentRepository;
        $this->productRepository = $productRepository;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->baseFindOrFail( $id);
        $comments = $this->productRepository->getComments($product);
        return view('backend.comments.show',compact('product','comments'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = $this->commentRepository->baseFindOrFail( $id);
        $this->productRepository->deleteVotes($comment);
        $this->commentRepository->delete($comment);
        return redirect()->back();
    }
}
