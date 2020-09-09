@extends('frontend.layouts.app')

@section('links')
<link href="{{ asset('css/frontend/login.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid identification-fluid py-3">
    <div class="container row main-identification mx-auto w-50 border rounded-sm">
        <div class="col-md-1"></div>
        <div class="col-md-6 m-auto text-center border rounded-sm shadow p-3">
            <h3 class="text-center">Login</h3>
            <div class="text-center error">
                <span></span>
            </div>
            <form role="form" method="POST" action="{{ route('login') }}">
                @csrf

                @foreach (['email'=>'Email','password'=>'Password'] as $key=>$placeholder)
                    @include('frontend.auth.input_login',['page'=>'login'])
                @endforeach

                <div class="custom-control custom-control-alternative custom-checkbox">
                    <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customCheckLogin">
                        <span class="text-muted">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4">{{ __('Sign in') }}</button>
                </div>
                <div class="border-top my-4">
                    <h3 class="text-center">Register</h3>
                    <a class="btn btn-primary btn-block" href="{{ route('register.user') }}">Create an Account</a>
                </div>
            </form>
        </div>
        <div class="col-md-5 mx-auto mt-5 text-right">
            <img class="mw-100" src="{{ asset('storage/image/login.png') }}" alt="">
        </div>
    </div>
</div>
@endsection