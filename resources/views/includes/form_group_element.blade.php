
<div class="form-group{{ $errors->has($key) ? ' has-danger' : '' }} {{ $page && $page=='login' ? ' mb-3' : '' }} ">
    <div class="input-group input-group-alternative{{ $page && $page=='register' ? ' mb-3' : '' }}">
        <div class="input-group-prepend">
            <span class="input-group-text">
                @if($key =='email')
                    <i class="ni ni-email-83"></i>
                @elseif($key =='username' || $key =='firstname' || $key=='lastname')
                    <i class="ni ni-hat-3"></i>
                @elseif($key =='password' || $key=='password_confirmation')
                    <i class="ni ni-lock-circle-open"></i>
                @endif
            </span>
        </div>
        <input class="form-control{{ $errors->has($key) ? ' is-invalid' : '' }}" placeholder="{{ __($placeholder) }}" type="{{ $type ?? $key }}" name="{{ $key }}" value="{{ old($key) }}"  required autofocus>
    </div>
    @if ($errors->has($key))
        <span class="invalid-feedback" style="display: block;" role="alert">
            <strong>{{ $errors->first($key) }}</strong>
        </span>
    @endif
</div>

{{--

<div class="form-group">
    <div class="input-group input-group-alternative">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
        </div>
        <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>
    </div>
</div> --}}
