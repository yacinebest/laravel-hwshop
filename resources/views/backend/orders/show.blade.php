@extends('backend.layouts.default.show',['page'=>'Order Ref '. $order->ref,'route_name'=>'order',
                                'name_entity'=>'Order','btnAction'=>false,'otherTable'=>true])


@section('otherTable')
@include('backend.orders.table.tableOrder')
@include('backend.orders.table.tableOrderProducts')
@include('backend.orders.table.tableDelivery',['columns'=>$columns_delivery])
@include('backend.orders.table.tableInvoice',['columns'=>$columns_invoice])
@include('backend.orders.table.tablePayment',['columns'=>$columns_payment])



@endsection
