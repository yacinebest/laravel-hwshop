@extends('backend.layouts.app', ['title' => __( $page . ' Management')])

@section('content')
<div class="main-content">

    @include('backend.layouts.headers.cards',['cardCountAndRoute'=> (isset($cardCountAndRoute) ? $cardCountAndRoute : [] )])

    <div class="container-fluid mt--7">

        @include('backend.layouts.default.common.tableDisplay',['page'=> isset($page) && $page ? $page : '' ])

        @include('backend.layouts.footers.auth')
    </div>
</div>
@endsection

@section('scripts')
@endsection
