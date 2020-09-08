@extends('backend.layouts.app', ['title' => __( $page . ' Management')])

@section('content')
<div class="main-content">
    @include('backend.layouts.headers.cards',['cardCountAndRoute'=> (isset($cardCountAndRoute) ? $cardCountAndRoute : [] )])
    {{-- <div class="container-fluid mt--7"> --}}

    <div class="container-fluid mt--7">

        @if(isset($otherTable) && $otherTable)
            @yield('otherTable')
        @else
            @include('backend.layouts.default.common.tableDisplay',['page'=> isset($page) && $page ? $page : '' ])
        @endif
        @include('backend.layouts.footers.auth')
    </div>
{{-- </div> --}}
@endsection

@section('scripts')
@endsection
