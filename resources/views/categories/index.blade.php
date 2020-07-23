@extends('layouts.default.index')

@section('displayTree')
<div class="m-3">
    <h3>Hierarchy Categories Tree</h3>
    @include('categories.recursive-element', ['baseCategories' => $baseCategories])
</div>
@endsection
