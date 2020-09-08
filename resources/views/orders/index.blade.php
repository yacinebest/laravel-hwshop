@extends('layouts.default.index' , ['page'=>'Orders','route_name'=>'order',
                                    'btnAction'=>false])

@section('entities_column')
@include('orders.rowOrder', ['orders' => $orders,'columns'=>$columns,'route_name'=>'order','status'=>$status])
@endsection
