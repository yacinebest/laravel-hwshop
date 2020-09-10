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
    <div class="row text-center">
        @foreach($products as $product)
            <div class="col-lg-4 col-md-6">
                <figure class="card card-product-grid shadow">
                <div class="img-wrap img-height">
                    <img class="img-height" src="{{ $product->image ? $product->image->imagePath : 'https://picsum.photos/seed/picsum/380/225' }}">
                    <a class="btn-overlay" href="{{ route('product',$product->id) }}">
                        <i class="fa fa-search-plus"></i>
                        See Product
                    </a>
                </div>

                    <figcaption class="info-wrap" >
                    <div class="text-center" style="height: 85px !important;" >
                        <a Producthref="#" Productclass="title h5 text-capitalize mw-100 mh-100 embed-responsive">
                            {{ $product->name }}
                        </a>
                        <div class="price-wrap mt-2 price-product">
                            <span class="price">{{ $product->price }} DZD</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-block btn-primary mt-2 ajouter-panier" data-id="1">
                        <i class="fa fa-cart-plus"></i>
                        Add To Cart
                    </a>
                    </figcaption>
                </figure>
            </div>
        @endforeach
    </div>
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
