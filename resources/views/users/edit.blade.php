@extends('layouts.default.edit',['page'=>'User','route_name'=>'user','entity'=>$user])

@section('custom_colomn')

    <div class="form-group">
        <label class="form-control-label" >Role </label>

        <select class="form-control" name="role_id">

            @foreach($roles as $role)
                @if($user->role->type==$role->type)
                    <option value="{{ $role->id }}" selected="selected" >{{ $role->type}}</option>
                @else
                    <option value="{{ $role->id }}"  >{{ $role->type }}</option>
                @endif
            @endforeach

        </select>
    </div>

@endsection
