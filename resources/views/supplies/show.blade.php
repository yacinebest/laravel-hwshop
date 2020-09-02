@extends('layouts.default.show',['page'=>'Supply For '. $product->name,'route_name'=>'supply',
                                'name_entity'=>'Supply','btnAction'=>false])

@section('otherBtn')
    <div class="col-4 text-right">
        <a href="{{ route('supply.create',$product->id) }}" class="btn btn-sm btn-primary">Add Supply</a>
    </div>
@endsection

@section('entities_column')
@include('supplies.rowSupply', ['supplies' => $supplies,'columns'=>$columns,'route_name'=>'supply'])
@endsection
