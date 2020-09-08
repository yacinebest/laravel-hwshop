@extends('backend.layouts.default.index' , ['page'=>'Brands','route_name'=>'brand',
                                    'addBtn'=>'Brand'])

@section('entities_column')
@foreach($brands as $brand)
<tr>
    @foreach($columns as $key => $value)
        @if($key==='logo')
            <td>
                <brand-logo :entity="{{ $brand }}"></brand-logo>
            </td>
        @else
            <td >{{ $brand->$key }}</td>
        @endif
    @endforeach

    @include('backend.layouts.dropdown.btnAction', ['entity' => $brand, 'route_name'=>'brand' ])
</tr>
@endforeach
@endsection
