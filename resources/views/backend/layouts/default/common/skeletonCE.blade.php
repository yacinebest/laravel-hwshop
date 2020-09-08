@extends('backend.layouts.app', ['title' => __($page)])

@section('content')
<div class="header bg-gradient-gray-dark pb-8 pt-5 pt-md-8">
    <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">

            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <h3 class="col-12 mb-0">{{ __($type_page . $page) }}</h3>
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

                    @if(isset($read_only_columns) && $read_only_columns)
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
                            <input type="{{ $type}}" class="form-control form-control-alternative" placeholder="{{ __($placeholder) }}" value="{{ old($key, $user->$key) }}" readonly >
                            {{-- <input type="{{ $type}}" name="{{ $key }}" id="input-{{ $key }}" class="form-control form-control-alternative" placeholder="{{ __($placeholder) }}" value="{{ old($key, $user->$key) }}" readonly > --}}

                            @include('backend.layouts.form.error_field',['key'=>$key])
                        </div>
                    @endforeach
                    @endif

                    @yield('cardElement')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
