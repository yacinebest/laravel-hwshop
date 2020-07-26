@extends('layouts.default.create')

@section('custom_colomn')

{{-- @foreach($categories_level as $key => $categories )
    <div class="form-group">
        <label>Level {{ $key }}</label>
        <select  class="form-control" >
            <option></option>
            @foreach($categories as $category)
                <option>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
@endforeach --}}

{{-- <select-category :categories_level="{{ json_encode($categories_level) }}"></select-category> --}}
<select-category-model :categories_level="{{ json_encode($categories_level) }}"></select-category-model>
@endsection
