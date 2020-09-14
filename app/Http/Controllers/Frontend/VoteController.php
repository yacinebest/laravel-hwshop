<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\VoteRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    private $voteRepository;
    private $userRepository;

    public function __construct(VoteRepositoryInterface $voteRepository,
                                UserRepositoryInterface $userRepository) {
        $this->voteRepository = $voteRepository;
        $this->userRepository = $userRepository;
    }

    public function vote($entity,Request $request)
    {
        if($entity = $this->voteRepository->otherFindOrFail($entity,$request->model)){
            $user = $this->userRepository->baseFindOrFail(Auth::user()->id);
            return $this->userRepository->toggleVote($user,$entity,$request->type) ;
        }
        // return [];
    }
}
