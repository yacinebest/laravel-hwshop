@extends('layouts.default.index' , ['page'=>'Products','route_name'=>'product'])


@section('otherBtn')
    <div class="col-4 text-right">
        <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Create New Product</a>
    </div>
@endsection