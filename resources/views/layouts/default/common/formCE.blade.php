@php
if($form_type=='store') 
    $route =route( $route_name . '.' . $form_type ) ;
else if($form_type=='update') 
    $route = route( $route_name . '.' . $form_type,$entity->id )  
@endphp
<form method="post" action="{{ $route }}" autocomplete="off" enctype="multipart/form-data" >
    @csrf
    @if($form_type=='update')
        @method('put')
    @endif   

    @if(  isset($fillable_columns) && $fillable_columns)
    @foreach ($fillable_columns as $key=>$placeholder)
        <div class="form-group">
            <label class="form-control-label" for="input-{{ $key }}">{{ __($placeholder) }}</label>
            @php
                $type='text';
            @endphp
            @if($form_type=='store')
                <input type="{{ $type}}" name="{{ $key }}" id="input-{{ $key }}" class="form-control form-control-alternative" placeholder="{{ __($placeholder) }}" >
            @elseif($form_type=='update')
                <input type="{{ $type}}" name="{{ $key }}" id="input-{{ $key }}" class="form-control form-control-alternative" placeholder="{{ __($placeholder) }}" value="{{ old($key, $entity->$key) }}" >
            @else
            @endif   

            @include('layouts.form.error_field',['key'=>$key])
        </div>
    @endforeach
    @endif

    @yield('custom_colomn')

    <div class="text-center">
        @if($form_type=='store')
            <button type="submit" class="btn btn-success mt-4">{{ __('Create') }}</button>
        @elseif($form_type=='update')
            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
        @else
        @endif  
    </div>
</form>