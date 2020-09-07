@extends('layouts.default.show',['page'=>'Supply For '. $product->name,'route_name'=>'supply',
                                'name_entity'=>'Supply','btnAction'=>false,'supplyTable'=>true])

@section('supplyTable')
@include('supplies.tableSupply')  
@endsection
