<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository) {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fillable_columns = $this->roleRepository->getFillableColumn();
        $roles = $this->roleRepository->baseAll();

        return view('backend.roles.create',compact('fillable_columns','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->roleRepository->baseCreate( ['type'=>$request->input('type')]);
        return redirect(route('user.index'));
    }

}
