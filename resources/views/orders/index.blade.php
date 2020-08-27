@extends('layouts.default.index' , ['page'=>'Orders','route_name'=>'order',
                                    'edit'=>false,'delete'=>false,'tableComponent'=>true])

@section('tableComponent')
    <table-index :paginate="{{ json_encode($orders) }}" :columns="{{ json_encode($columns) }}" ></table-index>
@endsection
