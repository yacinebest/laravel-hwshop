@extends('frontend.layouts.app')

@section('links')
<link rel="stylesheet" href="{{ asset('css/frontend/home.css') }}">

<link rel="stylesheet" href="{{ asset('css/frontend/subcategory.css') }}">

@endsection

@section('content')

@include('frontend.home.carousel')

@foreach($productsOrderBy as $type => $products)
<h2 class="text-center">{{ $type }}</h2>
<hr>

<div class="container">
    <product-card :products_props="{{ $products  }}" page="home"></product-card>
    {{-- <div class="row text-center">
        @foreach($products as $product)
            @include('frontend.products.card_product',['product'=>$product,'page'=>'home'])
        @endforeach
    </div> --}}
</div>

<div class="product-more text-right">
    <a href="#" class="btn btn-danger all-product-link pull-md-right h4 product-more text-right m-3 voir-plus-produit">
        See More Products
    </a>
</div>
<hr>
@endforeach




@if($brands)
@include('frontend.home.sectionBrand',['brands'=>$brands])
@endif

@endsection
