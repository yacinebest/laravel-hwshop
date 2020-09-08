@extends('backend.layouts.default.index' , ['page'=>$page,'route_name'=>'user','addBtn'=>'User','addBtn'=>false])


@section('otherBtn')
<div class="col-4 text-right">
    <a href="{{ route('role.create') }}" class="btn btn-sm btn-primary">Create New Role</a>
</div>
@endsection

@section('entities_column')
@foreach($users as $user)
<tr class="{{ isset($auth) && $user->id===$auth->id ? 'table-success' : '' }}">
    @foreach($columns as $key => $value)
        @if($key==='avatar')
            <td>
                <user-avatar :user="{{ $user }}" ></user-avatar>
            </td>
        @else
            <td >{{ $user->$key }}</td>
        @endif
    @endforeach

    @include('backend.layouts.dropdown.btnAction', ['entity' => $user, 'route_name'=>'user'])
</tr>
@endforeach
@endsection
