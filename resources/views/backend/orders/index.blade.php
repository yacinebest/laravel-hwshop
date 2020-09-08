@extends('backend.layouts.default.index' , ['page'=>'Orders','route_name'=>'order',
                                    'btnAction'=>false])

@section('entities_column')
@include('backend.orders.rowOrder', ['orders' => $orders,'columns'=>$columns,'route_name'=>'order','status'=>$status])
@endsection
