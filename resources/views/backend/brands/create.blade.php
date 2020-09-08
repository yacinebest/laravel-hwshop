@extends('backend.layouts.default.create',['page'=>'Brand','route_name'=>'brand'])

@section('custom_colomn')
<div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
    <label class="form-control-label" for="input-image">{{ __('Logo') }}</label>
    <div class="custom-file">
        <input id="image" type="file" name="image" class="form-control-file">
    </div>
    <br>
</div>
@endsection
