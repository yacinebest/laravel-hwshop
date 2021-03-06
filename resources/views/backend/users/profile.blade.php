@extends('backend.layouts.app', ['title' => __('User Profile')])

@section('content')
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(../argon/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12 col-lg-7">
                    <h1 class="display-2 text-white">{{  __('Hello') . ' '. $user->firstname . ' ' . $user->lastname }}</h1>
                    <p class="text-white mt-0 mb-5">{{ __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <user-avatar :user="{{ $user }}" :upload="true"></user-avatar>

                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-info disabled mr-4 " >{{ __('Connect') }}</button>
                            <button  class="btn btn-sm btn-default float-right">{{ $user->role->type }}</button >
                        </div>
                    </div>

                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-inline-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">{{ $user->upVoteCount }}</span>
                                        <span class="description">{{ __('Up Vote') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $user->downVoteCount }}</span>
                                        <span class="description">{{ __('Down Vote') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $user->commentCount }}</span>
                                        <span class="description">{{ __('Comment') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $user->orderApprovedByAdminCount }}</span>
                                        <span class="description">{{ __('Order Approved By You') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ $user->firstname }} {{ $user->lastname }}<span class="font-weight-light">, {{ $user->age }}</span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ __( $user->country ) }} ,<br>
                                <i class="ni location_pin mr-2"></i>{{ __( $user->address ) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.update.profile') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

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

                                <div class="form-group">
                                    <label class="form-control-label" >Role </label>
                                    <select class="form-control" name="role_id">

                                        @foreach($roles as $role)
                                            @if($user->role->type==$role->type)
                                                <option value="{{ $role->id }}" selected="selected" >{{ $role->type}}</option>
                                            @else
                                                <option value="{{ $role->id }}"  >{{ $role->type }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>



                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>

                        </form>

                        <hr class="my-4" />
                        <form method="post" action="{{ route('user.password') }}" autocomplete="off">
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
            </div>

        </div>

        @include('backend.layouts.footers.auth')
    </div>
@endsection
