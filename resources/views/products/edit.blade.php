@extends('layouts.default.edit',['page'=>'Product','route_name'=>'product','entity'=>$product])

@section('links')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection


@section('custom_colomn')

<div class="form-group">
    <label class="form-control-label" for="input-name">{{ __("Name") }}</label>
    <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="Name" value="{{ old("name", $product->name) }}">
    @include('layouts.form.error_field',['key'=>"name"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-description">{{ __("Description") }}</label>
    <textarea  rows="4" name="description" id="input-description" class="form-control form-control-alternative">{{ $product->description }}</textarea>
    @include('layouts.form.error_field',['key'=>"description"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-price">{{ __("Price") }}</label>
    <input type="number" name="price" id="input-price" class="form-control form-control-alternative" min="0" value="{{ old("price", $product->price) }}">
    @include('layouts.form.error_field',['key'=>"price"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-copy_number">{{ __("Copy Number") }}</label>
    <input type="number" name="copy_number" id="input-copy_number" class="form-control form-control-alternative" min="0" value="{{ old("copy_number", $product->copy_number) }}" >
    @include('layouts.form.error_field',['key'=>"copy_number"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-datasheet">{{ __("Datasheet") }}</label>
    @if($product->datasheet)
        <span>file selected already : {{$product->datasheet}}</span>
    @endif
    <input type="file" name="datasheet" id="input-datasheet" class="form-control form-control-alternative"   >
    @include('layouts.form.error_field',['key'=>"datasheet"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-price">{{ __("Brand") }}</label>
    <select class="selectpicker form-control"  data-style="btn-primary" name="brands[]" multiple>
        @foreach($brands as $brand)
            @if( $product->brands->contains($brand) )
                <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
            @else
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endif
        @endforeach
    </select>
    @include('layouts.form.error_field',['key'=>"brands"])
</div>

<div class="form-group">
    <label class="form-control-label" for="input-price">{{ __("Select Category :") }}</label>
    <select-category
        :categories_level="{{ json_encode($categories_level) }}"
        :selected_categories="{{ json_encode($selected_categories) }}"
        :current_category="{{ json_encode($category) }}"
    ></select-category>
    @include('layouts.form.error_field',['key'=>"parent_id"])
</div>
<image-uploader></image-uploader>

@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    // $('.selectpicker').selectpicker('val', 'Mustard');
</script>
@endsection
