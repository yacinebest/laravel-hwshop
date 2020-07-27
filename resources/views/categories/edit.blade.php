@extends('layouts.default.edit')

@section('custom_colomn')
{{-- {{ dd($selectedCategories) }} --}}
<select-category :categories_level="{{ json_encode($categories_level) }}" :selected_categories="{{ json_encode($selected_categories) }}"></select-category>
@endsection
