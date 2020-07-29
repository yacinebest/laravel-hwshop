@extends('layouts.default.create',['page'=>'Category','route_name'=>'category'])

@section('custom_colomn')
<select-category :categories_level="{{ json_encode($categories_level) }}"></select-category>
@endsection
