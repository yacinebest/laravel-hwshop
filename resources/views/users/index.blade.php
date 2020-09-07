@extends('layouts.default.index' , ['page'=>$page,'route_name'=>'user','addBtn'=>'User'])


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

    @include('layouts.dropdown.btnAction', ['entity' => $user, 'route_name'=>'user'])
</tr>
@endforeach
@endsection