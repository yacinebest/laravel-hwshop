@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">

                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>{{ __('Sign up with credentials') }}</small>
                        </div>
                        <form role="form" method="POST" action="{{ route('register') }}">
                            @csrf

                            @foreach (['username'=>'Username','firstname'=>'First name','lastname'=>'Last name',
                                        'email'=>'Email','password'=>'Password',
                                        'password_confirmation'=>'Confirm Password'] as $key=>$placeholder)

                                @if($key==='username' || $key==='firstname' || $key==='lastname')
                                    @include('includes.form_group_element',['page'=>'register','type'=>'text'])
                                @elseif($key==='password' || $key==='password_confirmation')
                                    @include('includes.form_group_element',['page'=>'register','type'=>'password'])
                                @else
                                    @include('includes.form_group_element',['page'=>'register'])
                                @endif
                            @endforeach
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Create account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
