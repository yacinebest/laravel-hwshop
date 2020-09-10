@extends('frontend.users.layout.structure')


@section('principal_content')
{{-- My informations --}}
<div class="row card mb-4 profile-card infos" >
    <div class="card-header profile-card-header">
        My informations
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
            @csrf
            @method('put')

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="pl-lg-4">

                @foreach ($editable_columns as $key=>$placeholder)

                    <div class="form-group{{ $errors->has($key) ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-{{ $key }}">{{ __($placeholder) }}</label>
                        @php
                        if($key=='email')
                            $type='email';
                        else if($key=='birth_date')
                            $type='date';
                        else
                            $type='text';
                        @endphp
                        <input type="{{ $type}}" name="{{ $key }}" id="input-{{ $key }}" class="form-control form-control-alternative{{ $errors->has($key) ? ' is-invalid' : '' }}" placeholder="{{ __($placeholder) }}" value="{{ old($key, $user->$key) }}" required autofocus>


                        @if ($errors->has($key))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first($key) }}</strong>
                            </span>
                        @endif
                    </div>

                @endforeach

                <div class="form-group">
                    <label class="form-control-label" >Gender </label>
                    <select class="form-control" name="gender">
                        @if($user->gender==="MALE")
                            <option value="MALE" selected="selected" >Male</option>
                        @else
                            <option value="MALE"  >Male</option>
                        @endif

                        @if($user->gender==="FEMALE")
                            <option value="FEMALE" selected="selected" >Female</option>
                        @else
                            <option value="FEMALE"  >Female</option>
                        @endif
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                </div>
            </div>

        </form>

        <hr class="my-4" />
        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
            @csrf
            @method('put')

            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

            @if (session('password_status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('password_status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="pl-lg-4">
                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>

                    @if ($errors->has('old_password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('old_password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
