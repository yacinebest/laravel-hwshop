@extends('layouts.default.index' , ['page'=>$page,'route_name'=>'user'])


@section('otherBtn')
    <div class="col-4 text-right">
        <a href="{{ route('role.create') }}" class="btn btn-sm btn-primary">Create New Role</a>
    </div>
@endsection
