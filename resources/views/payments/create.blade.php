@extends('layouts.default.create',['page'=>'Payment','route_name'=>'payment'])

@section('custom_colomn')

<div class="form-group">
    <label class="form-control-label" for="input-method">{{ __("Payment Method") }}</label>
    <input type="text" name="method" id="input-method" class="form-control form-control-alternative" value="{{ $method }}" readonly>
    @include('layouts.form.error_field',['key'=>"method"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-contact_info">{{ __("Contact Info") }}</label>
    <input type="text" name="contact_info" id="input-contact_info" class="form-control form-control-alternative">
    @include('layouts.form.error_field',['key'=>"contact_info"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-phone_number">{{ __("Phone Number") }}</label>
    <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative">
    @include('layouts.form.error_field',['key'=>"phone_number"])
</div>

@endsection
