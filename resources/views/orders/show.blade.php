@extends('layouts.default.show',['page'=>'Order Ref '. $order->ref,'route_name'=>'order',
                                'name_entity'=>'Order','btnAction'=>false,'otherTable'=>true])


@section('otherTable')
@include('orders.table.tableOrder')
@include('orders.table.tableOrderProducts')
@include('orders.table.tableDelivery',['columns'=>$columns_delivery])
@include('orders.table.tableInvoice',['columns'=>$columns_invoice])
@include('orders.table.tablePayment',['columns'=>$columns_payment])



@endsection
