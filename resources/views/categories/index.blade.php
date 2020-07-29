@extends('layouts.default.index' , ['page'=>'Categories','route_name'=>'category'])

@section('displayTree')
<div class="m-3 justify-content-center">
    <h3>Hierarchy Categories Tree</h3>
    @include('categories.recursive-element', ['baseCategories' => $baseCategories,'route_name'=>'category'])
</div>
@endsection
