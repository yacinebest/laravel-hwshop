@extends('layouts.default.index' , ['page'=>'Categories','route_name'=>'category',
                                    'addBtn'=>'Category'])

@section('entities_column')
@foreach($categories as $category)
    <tr>
        @foreach($columns as $key => $value)
            @if($key==='imageCount')
                <td>
                    <a href="{{ route('image.show',$category->id) }}" class="btn btn-primary">{{ $category->$key }} Image</a>
                </td>
            @else
                <td >{{ $category->$key }}</td>
            @endif
        @endforeach
        @include('layouts.dropdown.btnAction', ['entity' => $category,'route_name'=>'category' ])
    </tr>
@endforeach
@endsection

@section('displayTree')
<div class="m-3 justify-content-center">
    <h3>Hierarchy Categories Tree</h3>
    @include('categories.recursive_tree', ['baseCategories' => $baseCategories,'route_name'=>'category'])
</div>
@endsection
