@extends('layouts.default.create')

@section('custom_colomn')
<select-category :categories_level="{{ json_encode($categories_level) }}"></select-category>
@endsection
