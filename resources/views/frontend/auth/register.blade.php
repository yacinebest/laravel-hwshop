@extends('frontend.layouts.app')


@section('links')
<link href="{{ asset('css/frontend/login.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid identification-fluid py-3">
    <div class="row container main-identification mx-auto w-75 border rounded-sm">
        <div class="col-md-6 m-auto">
            <img class="mw-100" src="{{ asset('storage/image/signup.png') }}" alt="">
        </div>
        <div class="col-md-6 mx-auto border rounded-sm shadow m-3">
            
            <form role="form" method="POST" action="{{ route('register') }}">
                @csrf

                <h3 class="text-center mt-3">{{ __('Your Credentials') }} :</h3>
                @foreach (['email'=>'Email','username'=>'Username','password'=>'Password',
                            'password_confirmation'=>'Confirm Password'] as $key=>$placeholder)
                    @if($key==='username')
                        @include('backend.auth.input_login',['page'=>'register','type'=>'text'])
                    @elseif($key==='password' || $key==='password_confirmation')
                        @include('backend.auth.input_login',['page'=>'register','type'=>'password'])
                    @else
                        @include('backend.auth.input_login',['page'=>'register'])
                    @endif
                @endforeach

                <h3 class="text-center mt-3">{{ __('Your Personal Information') }} :</h3>
                @foreach (['firstname'=>'First name','lastname'=>'Last name','birth_date'=>'Birth Date',
                            'gender'=>'Gender','address'=>'Address','country'=>'Country',
                            'phone_number'=>'Phone Number'] as $key=>$placeholder)

                    @if($key==='firstname' || $key==='lastname' || $key=='address' || $key=='country'
                        || $key=='phone_number')
                        @include('frontend.auth.input_login',['page'=>'register','type'=>'text'])
                    @elseif($key==='birth_date' )
                        @include('frontend.auth.input_login',['page'=>'register','type'=>'date'])
                    @elseif($key==='gender' )
                        <div class="form-group{{ $errors->has($key) ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3'">
                                <select id="my-select" class="form-control" name="gender">
                                    <option value="MALE">Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                            </div>
                        </div>
                    @else
                        @include('frontend.auth.input_login',['page'=>'register'])
                    @endif
                @endforeach 

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">{{ __('Create account') }}</button>
                </div>
            </form>

            <div class="text-center sfooter">
            <span>
                HWShop undertakes to keep this information strictly confidential.
            </span>
            </div>
        </div>

    </div>
</div>
@endsection