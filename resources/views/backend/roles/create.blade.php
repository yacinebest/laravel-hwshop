@extends('backend.layouts.default.create',['page'=>'Role','route_name'=>'role'])


@section('custom_colomn')
<div class="form-group">
    <label class="form-control-label" for="input">{{ __("Role Already Created :") }}</label>
    @foreach($roles as $role)
        <input type="text" class="form-control form-control-alternative mb-2" value="{{ $role->type }}" readonly>
    @endforeach
</div>
@endsection
