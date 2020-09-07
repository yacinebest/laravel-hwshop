@extends('layouts.default.common.skeletonCE', ['page' => $page , 'type_page'=>'Edit'])

@section('cardElement')


    @include('layouts.default.common.formCE', ['form_type' => 'update'])

@endsection
