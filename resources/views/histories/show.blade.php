@extends('layouts.default.show',['page'=>'History For '. $product->name,'route_name'=>'history',
                                'name_entity'=>'History','btnAction'=>false])

{{-- @section('otherBtn')
    <div class="col-4 text-right">
        <a href="{{ route('supply.create',$product->id) }}" class="btn btn-sm btn-primary">Add Supply</a>
    </div>
@endsection --}}

@section('entities_column')
@include('histories.rowhistory', ['histories' => $histories,'columns'=>$columns])
@endsection
