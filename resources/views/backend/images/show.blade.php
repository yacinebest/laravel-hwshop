@extends('backend.layouts.app', ['title' => __('Images Management'),'route_name'=>'image','edit'=>false])


@section('content')
<div class="main-content">
    @include('backend.layouts.headers.cards',['cardCountAndRoute'=> (isset($cardCountAndRoute) ? $cardCountAndRoute : [] )])
    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">
                <image-show :images="{{ $images }}" :entity="{{ $entity }}"></image-show>
            </div>
        </div>

        @include('backend.layouts.footers.auth')
    </div>
</div>
@endsection


