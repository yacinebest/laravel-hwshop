@extends('layouts.app', ['title' => __( $page . ' Management')])

@section('content')
<div class="main-content">
    @include('layouts.headers.cards',['cardCountAndRoute'=> (isset($cardCountAndRoute) ? $cardCountAndRoute : [] )])
    {{-- <div class="container-fluid mt--7"> --}}

    <div class="container-fluid mt--7">

        @if(isset($otherTable) && $otherTable)
            @yield('otherTable')
        @else
            @include('layouts.default.common.tableDisplay',['page'=> isset($page) && $page ? $page : '' ])   
        @endif
        @include('layouts.footers.auth')
    </div>
{{-- </div> --}}
@endsection

@section('scripts')
@endsection
