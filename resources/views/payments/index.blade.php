@extends('layouts.default.index' , ['page'=>'Payments','route_name'=>'payment','edit'=>false])

@section('otherBtn')
    <div class="col-4 text-right">
        <a href="{{ route('payment.create') }}" class="btn btn-sm btn-primary">Add Payment Method</a>
    </div>
@endsection
