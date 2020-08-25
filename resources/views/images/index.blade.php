@extends('layouts.default.index' , ['page'=>'Images','route_name'=>'image','edit'=>false])

@section('entities_column')
    @foreach($images as $entity)
    <tr class="{{ isset($auth) && $entity->id===$auth->id ? 'table-success' : '' }}">
            <td>
                <div class="images-preview">
                    <div class="img-wrapper" >
                        <img src="{{  $entity->imagePath}}" alt="Category {{  $entity->file}}" width="200" height="200">
                    </div>
                </div>
            </td>
            <td>{{ $entity->imageable_type  }}</td>
            <td>{{ $entity->imageable->name  }}</td>
            @include('layouts.dropdown.btnAction', ['entity' => $entity ])
    </tr>
    @endforeach
@endsection
