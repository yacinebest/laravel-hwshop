@extends('layouts.default.show',['page'=>'Supply For '. $product->name,'route_name'=>'supply',
                                'name_entity'=>'Supply','btnAction'=>false,'customTable'=>true])

@section('otherBtn')
<div class="col-4 text-right">
    <a href="{{ route('supply.create',$product->id) }}" class="btn btn-sm btn-primary">Add Supply</a>
</div>
@endsection

@section('customTable')
<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            @foreach($columns_supply as $key => $value)
                <th  scope="col">{{ $value }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @include('supplies.rowSupply', ['supplies' => $supplies,'columns'=>$columns_supply,'route_name'=>'supply'])
    </tbody>
</table>
@endsection

@section('paginate')
@if(!empty($supplies))
    {!! $supplies->links() !!}
@endif
@endsection