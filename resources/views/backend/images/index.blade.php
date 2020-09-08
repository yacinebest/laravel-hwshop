@extends('backend.layouts.default.show' , ['page'=>'Images','route_name'=>'image','edit'=>false])

@section('entities_column')
    @foreach($images as $entity)
    <tr >
        <td>
            <div class="images-preview">
                <div class="img-wrapper" >
                    <img src="{{  $entity->imagePath}}" alt="Category {{  $entity->file}}" width="200" height="200">
                </div>
            </div>
        </td>
        <td>{{ $entity->imageable_type  }}</td>
        <td>{{ $entity->imageable->name  }}</td>
        @include('backend.layouts.dropdown.btnAction', ['entity' => $entity,'route_name'=>'image','edit'=>false ])
    </tr>
    @endforeach
@endsection
