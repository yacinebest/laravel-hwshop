@extends('layouts.default.index',['page'=>'Supply','route_name'=>'supply'
                                    ,'btnAction'=>false])

@section('entities_column')
@include('supplies.rowSupply', ['supplies' => $supplies,'columns'=>$columns])
@endsection
