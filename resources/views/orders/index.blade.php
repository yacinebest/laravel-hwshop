@extends('layouts.default.index' , ['page'=>'Orders','route_name'=>'order','columns'=>$columns,
                                    'btnAction'=>false])

@section('entities_column')
@include('orders.rowOrder', ['orders' => $orders,'columns'=>$columns,'route_name'=>'order','status'=>$status])
@endsection

@section('paginate')
@if(!empty($orders))
{!! $orders->links() !!}
@endif
@endsection
