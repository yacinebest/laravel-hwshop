@extends('layouts.default.create',['page'=>'Supply','route_name'=>'supply'])

@section('custom_colomn')
<div class="form-group">
    <label class="form-control-label" for="input-product_id">{{ __("Product Id") }}</label>
    <input type="text" name="product_id" id="input-product_id" class="form-control form-control-alternative" value="{{ $product->id }}" readonly>
    @include('layouts.form.error_field',['key'=>"product_id"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-admission-price">{{ __("Admission Price") }}</label>
    <input type="number" name="admission_price" id="input-admission-price" class="form-control form-control-alternative" min="0" >
    @include('layouts.form.error_field',['key'=>"admission_price"])
</div>


<div class="form-group">
    <label class="form-control-label" for="input-quantity">{{ __("Quantity") }}</label>
    <input type="number" name="quantity" id="input-quantity" class="form-control form-control-alternative" min="0"  >
    @include('layouts.form.error_field',['key'=>"quantity"])
</div>

<div class="form-group">
    <label class="form-control-label" >Status </label>
    <select class="form-control" name="status">
        @foreach($status as $stat)
            <option value="{{ $stat }}"  >{{ $stat }}</option>
        @endforeach
    </select>
    @include('layouts.form.error_field',['key'=>"status"])
</div>



<div class="form-group">
    <label class="form-control-label" for="input-supply_date">{{ __("Supply Date") }}</label>
    <input type="date" name="supply_date" id="input-supply_date" class="form-control form-control-alternative" >
    @include('layouts.form.error_field',['key'=>"supply_date"])
</div>



@endsection
