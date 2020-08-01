@extends('layouts.default.edit',['page'=>'Category','route_name'=>'category','entity'=>$category])

@section('custom_colomn')
<select-category
    :categories_level="{{ json_encode($categories_level) }}"
    :selected_categories="{{ json_encode($selected_categories) }}"
    :current_category="{{ json_encode($category) }}"
></select-category>
@endsection
