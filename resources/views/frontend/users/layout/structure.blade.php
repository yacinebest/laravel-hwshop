@extends('frontend.layouts.app')


@section('links')
<link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">

@endsection

@section('content')
<div class="container-fluid profile-fluid py-3 px-2">
    <div class="container profile bg-white border rounded-sm shadow-sm">
        <div class="row mb-5 px-4">

            @include('frontend.users.aside_link',['user'=>$user])

            <div class="col-md-1"></div>

            <div class="col-md-7 pt-4 welcome-div">
                @yield('principal_content')
            </div>

        </div>
    </div>
</div>
@endsection



@section('scripts')
<script src="{{ asset('js/frontend/profile.js') }}"></script>
@endsection
