@extends('backend.layouts.default.common.skeletonCE', ['page' => $page , 'type_page'=>'Edit'])

@section('cardElement')


    @include('backend.layouts.default.common.formCE', ['form_type' => 'update'])

@endsection
