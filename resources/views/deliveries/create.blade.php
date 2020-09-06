@extends('layouts.default.create',['page'=>'Delivery','route_name'=>'delivery'])

@section('custom_colomn')


<div class="form-group">
    <label class="form-control-label" for="input-price">{{ __("Price") }}</label>
    <input type="number" name="price" id="input-price" class="form-control form-control-alternative" min="0" >
    @include('layouts.form.error_field',['key'=>"price"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-delivery_date">{{ __("Delivery Date") }}</label>
    <input type="date" name="delivery_date" id="input-delivery_date" class="form-control form-control-alternative" >
    @include('layouts.form.error_field',['key'=>"delivery_date"])
</div>

<input type="hidden" name="order_id" value="{{ $order->id }}">

@endsection

