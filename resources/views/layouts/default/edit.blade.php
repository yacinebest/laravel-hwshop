@extends('layouts.app', ['title' => __($page)])

@section('content')
<div class="header bg-gradient-gray-dark pb-8 pt-5 pt-md-8">
    <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">

            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <h3 class="col-12 mb-0">{{ __('Edit ' . $page) }}</h3>
                </div>
            </div>

            <div class="card-body">
                <div class="pl-lg-4">
                    <h6 class="heading-small text-muted mb-4">{{ __( $page .' information') }}</h6>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @isset($read_only_columns)
                    @foreach ($read_only_columns as $key=>$placeholder)
                        <div class="form-group">
                            <label class="form-control-label" for="input-{{ $key }}">{{ __($placeholder) }}</label>
                            @php
                            if($key=='email')
                                $type='email';
                            else if($key=='birth_date')
                                $type='date';
                            else
                                $type='text';
                            @endphp
                            <input type="{{ $type}}" name="{{ $key }}" id="input-{{ $key }}" class="form-control form-control-alternative" placeholder="{{ __($placeholder) }}" value="{{ old($key, $user->$key) }}" readonly >


                            @if ($errors->has($key))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first($key) }}</strong>
                                </span>
                            @endif
                        </div>
                    @endforeach
                    @endisset



                    <form method="post" action="{{ route( $route_name . '.update',$entity->id ) }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        @isset($fillable_columns)
                        @foreach ($fillable_columns as $key=>$placeholder)
                            <div class="form-group">
                                <label class="form-control-label" for="input-{{ $key }}">{{ __($placeholder) }}</label>
                                @php
                                    $type='text';
                                @endphp
                                <input type="{{ $type}}" name="{{ $key }}" id="input-{{ $key }}" class="form-control form-control-alternative" placeholder="{{ __($placeholder) }}" value="{{ old($key, $entity->$key) }}" >


                                @if ($errors->has($key))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($key) }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endforeach
                        @endisset

                        @yield('custom_colomn')

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                        </div>

                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection
