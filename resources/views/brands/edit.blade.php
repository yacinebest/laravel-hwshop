@extends('layouts.default.edit',['page'=>'Brand','route_name'=>'brand','entity'])

@section('custom_colomn')

<div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
    <label class="form-control-label" for="input-image">{{ __('Logo') }}</label>
    <div class="custom-file">
        <input id="image" type="file" name="image" class="form-control-file">
    </div>
    <br>
</div>

<div class="row float-right mr-5">
    <div class="col-lg-3 order-lg-2">
        <div class="card-profile-image">
            <img src="{{'/storage/uploads/logo/' . $entity->logo }}" class="rounded-circle top--6" >
        </div>
    </div>
</div>

@endsection
