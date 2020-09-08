@extends('layouts.default.show',['page'=>'Order Ref '. $order->ref,'route_name'=>'order',
                                'name_entity'=>'Order','btnAction'=>false,'otherTable'=>true])


@section('otherTable')
@include('orders.tableOrder')
@include('deliveries.tableDelivery',['columns'=>$columns_delivery])
@include('invoices.tableInvoice',['columns'=>$columns_invoice])
@include('payments.tablePayment',['columns'=>$columns_payment])



@endsection
