@extends('layouts.app', ['title' => __( $page . ' Management')])

@section('content')
<div class="main-content">

    @include('layouts.headers.cards',['cardCountAndRoute'=> (isset($cardCountAndRoute) ? $cardCountAndRoute : [] )])

    <div class="container-fluid mt--7">

        @include('layouts.default.common.tableDisplay',['page'=> isset($page) && $page ? $page : '' ])

        @include('layouts.footers.auth')
    </div>
</div>
@endsection

@section('scripts')
@endsection
