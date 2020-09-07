@extends('layouts.default.index' , ['page'=>'Brands','route_name'=>'brand'])

@section('otherBtn')
    <div class="col-4 text-right">
        <a href="{{ route('brand.create') }}" class="btn btn-sm btn-primary">Create New Brand</a>
    </div>
@endsection
