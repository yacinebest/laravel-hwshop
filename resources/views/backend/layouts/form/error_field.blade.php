@if ($errors->has($key))
<span class="error text-danger" role="alert">
    {{-- invalid-feedback  --}}
    <strong>{{ $errors->first($key) }}</strong>
</span>
@endif
