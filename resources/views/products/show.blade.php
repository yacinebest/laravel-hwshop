@extends('layouts.default.show',['page'=>'Product Name '. $product->name,'route_name'=>'product',
                                'name_entity'=>'Product','btnAction'=>false,'customTable'=>true])


@section('customTable')
<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Updated Price At</th>
            <th scope="col">Quantity</th>
            <th scope="col">Category</th>
            <th scope="col">View</th>
            <th scope="col">Details</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->updated_price_at }}</td>
            <td>{{ $product->copy_number  }}</td>
            <td>{{  $product->category->name  }}</td>
            <td>{{  $product->view  }}</td>
            <td>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('image.show',$product->id) }}" class="btn btn-primary w-100 mt-2">{{ $product->imageCount }} Image</a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-primary w-100 mt-2">Comment</a>
                    </li>
                    <li>
                        <a href="{{ route('supply.show',$product->id) }}" class="btn btn-primary w-100  mt-2 ">Supply</a>
                    </li>
                    <li>
                        <a href="{{ route('history.show',$product->id) }}" class="btn btn-primary w-100  mt-2">History</a>
                    </li>
                    <li>
                        @if( $product->datasheet)
                            <button class="btn btn-primary w-100 mt-2">Datasheet</button>                         
                        @else
                            <button disabled="disabled" class="btn btn-light w-100 mt-2">Datasheet</button> 
                        @endif
                    </li>
                </ul>
            </td>
            <td>
                <ul class="list-unstyled">
                    <li>
                        <a class="btn btn-primary w-100 mr-2 mb-2" href="{{ route( 'product.edit',$product->id)  }}">Edit</a>
                    </li>
                    <li>
                        <form method="post" action="{{ route('product.destroy',$product->id) }}" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 mr-2 mb-2">Delete</button>
                        </form>
                    </li>
                    <li>
                        <p>
                        <a href="#" class="btn btn-primary mr-2">{{ $product->upVoteCount }}  <i class="fa fa-thumbs-up" ></i></a>
                        <a href="#" class="btn btn-primary ">{{ $product->downVoteCount }}  <i class="fa fa-thumbs-down"></i></a>
                        </p>
                    </li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
@endsection