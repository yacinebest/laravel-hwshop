@extends('layouts.default.index' , ['page'=>'Orders','route_name'=>'order',
                                    'edit'=>false,'delete'=>false,'tableComponent'=>true])

{{-- @extends('layouts.default.show',['page'=>'Orders','route_name'=>'order',
                                'name_entity'=>'Order','btnAction'=>false]) --}}

@section('tableComponent')
<div>
    <table-index :paginate="{{ json_encode($orders) }}" :columns="{{ json_encode($columns) }}"></table-index>
    @if(!empty($orders))
        {!! $orders->links() !!}
    @endif
</div>
@endsection
