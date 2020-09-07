@extends('layouts.default.show',['page'=>'History For '. $product->name,'route_name'=>'history',
                                'name_entity'=>'History','btnAction'=>false,'historyTable'=>true])
{{-- 
@section('entities_column')
@include('histories.rowhistory', ['histories' => $histories,'columns'=>$columns])
@endsection --}}


@section('historyTable')
@include('histories.tableHistory')  
@endsection
