@extends('layouts.default.common.skeletonCE', ['page' => $page , 'type_page'=>'Create'])

@section('cardElement')
    @yield('image')
    @include('layouts.default.common.formCE', ['form_type' => 'store'])
@endsection
