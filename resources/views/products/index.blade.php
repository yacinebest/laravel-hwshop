@extends('layouts.default.index' , ['page'=>'Products','route_name'=>'product'])


@section('otherBtn')
    <div class="col-4 text-right">
        <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Create New Product</a>
    </div>
@endsection

@section('entities_column')
@foreach($products as $product)
    <tr>
        @foreach($columns as $key => $value)
            @if($key==='name')
                <td>
                    {{ $product->$key }}
                    <br>
                    <a href="{{ route( 'product.show',$product->id) }}" class="btn btn-sm btn-secondary bottom--6 left--2 ">See Details</a>
                </td>
            @elseif($key=='categoryName')
                <td>{{ $product->category->name }}</td>
            @elseif($key==='columnCount')
            <td>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('image.show',$product->id) }}" class="btn btn-primary mt-2">{{ $product->imageCount }} Image</a>
                    </li>
                    <li>
                        <a href="{{ route('supply.show',$product->id) }}" class="btn btn-primary  mt-2 ">Supply</a>
                    </li>
                    <li>
                        <a href="{{ route('history.show',$product->id) }}" class="btn btn-primary  mt-2">History</a>
                    </li>
                </ul>
            </td>
            @else
                <td >{{ $product->$key }}</td>
            @endif
        @endforeach
        @include('layouts.dropdown.btnAction', ['entity' => $product,'route_name'=>'product' ])
    </tr>
@endforeach
@endsection


@section('paginate')
@if(!empty($products))
{!! $products->links() !!}
@endif
@endsection