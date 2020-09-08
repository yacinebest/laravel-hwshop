@extends('backend.layouts.default.common.skeletonCE', ['page' => $page , 'type_page'=>'Create'])

@section('cardElement')
    @yield('image')
    @include('backend.layouts.default.common.formCE', ['form_type' => 'store'])
@endsection
