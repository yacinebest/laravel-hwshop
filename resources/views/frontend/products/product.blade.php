@extends('frontend.layouts.app')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

<link href="{{ asset('css/frontend/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/frontend/product.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid py-3 px-4 my-4">
    <article class="product-details col-lg-10 p-1 m-auto grid-categorie bg-white border rounded-sm shadow-sm">
        <div class="row">
            <div class="col-md-8 mt-4">
                <div class="zoom-gallery row">
                    <ul class="list-unstyled product-gallery col-md-2">
                    <li class="list-item" style="height: 100px"></li>
                        @foreach($product->images as $image)
                            <li class="list-item m-2">
                                <a href="{{ $image->imagePath }}">
                                    <img src="{{ $image->imagePath }}" class="img-fluid" />
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="col-md-10">
                    <a href="{{ $product->image->imagePath }}">
                        <img src="{{ $product->image->imagePath }}" class="img-fluid" /></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 pt-5">
                <h4 class="product-heading w-100 px-3">{{ $product->name }}</h4>
                <!-- product attributes -->
                <ul class="list-unstyled text-muted w-100 px-3">
                    <li>Brand:
                        <span>
                            @foreach($product->brands as $brand)
                                {{ $brand->name }}
                            @endforeach
                        </span>
                    </li>
                    @if($product->copy_number >0)
                        <li style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="#" class="btn btn-sm btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-check"></i>
                                </span>
                                <span class="text">In stock</span>
                            </a>
                        </li>
                    @else
                        <li style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="#" class="btn btn-sm btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-check"></i>
                                </span>
                                <span class="text">Not available</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="price-group w-100 px-3" style="font-size: larger; font-weight: bold;">
                    <div class="old-price" style="color: #F8694A; font-size: 80%; text-decoration: line-through;" hidden>
                        <span class="currency">DZD</span>
                        <span>{{  $product->price }}</span>
                    </div>
                    <div class="price text-success">
                        <span class="currency">DZD</span>
                        <span>{{ $product->price }}</span>
                    </div>
                </div>

                <div class="w-100 px-3">
                    <a href="#comment-tab" class="go-to-comment">
                        {{ $product->commentCount }} Opinion (s) /
                    </a>
                    @if(Auth::check())
                        <votes authuser="{{ Auth::user()->id }}" :initvotes="{{ $product->votes }}"  entity_id="{{ $product->id }}" entity_model="Product"></votes>
                    @else
                        <votes :initvotes="{{  $product->votes }}"  entity_id="{{ $product->id }}" entity_model="Product"></votes>
                    @endif

                </div>
                <hr />
                <div class="w-100 px-3 py-1">
                    <p class=" mb-0" style="height: 150px; overflow: hidden; text-overflow: ellipsis !important;">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="text-right mb-3 mr-3">
                    <a href="#description-tab" class="go-to-description">...See More</a>
                </div>

                <add-to-cart-btn :product="{{ $product }}"></add-to-cart-btn>

                <div class="btngroup"></div>
            </div>
        </div>
    </article>
</div>

<div class="container-fluid product-details col-lg-10 grid-categorie w-100 px-4 my-4">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link selected" id="description-tab" data-class="description" data-toggle="tab">Description</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="fiche-tab" data-class="fiche" data-toggle="tab">Datasheet</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="comment-tab" data-class="comment" data-toggle="tab">
                Comments ({{ $product->commentCount }})
            </a>
        </li>
    </ul>

    <div class="tab-content w-100 bg-white my-0 border-bottom border-left border-right shadow-sm" id="myTabContent">
        <div role="tabpanel" class="tab-pane tab-details description p-4 " id="description">
            <p class="description-text p-3 border rounded-sm">
                {{ $product->description }}
            </p>
        </div>
        <div class="tab-pane tab-details fiche p-4" id="fiche">
            @if($product->datasheet && $product->datasheetFile)
                @include('frontend.products.datasheet',['xml'=>$product->datasheetFile])
            @endif
        </div>

        <div id="comment" class="tab-pane tab-details container-fluid comment p-4">
            @if(Auth::check())
                <comments-card :authuser="{{json_encode( Auth::user()->id) }}" :product="{{ $product }}"></comments-card>
            @else
                <comments-card :product="{{ $product }}"></comments-card>
            @endif

        </div>

    </div>
</div>

@foreach($productsOrderBy as $type => $products)
@include('frontend.includes.carousel_product',['type'=>$type,'products'=>$products])
@endforeach



@endsection

@section('scripts')
<script src="{{ asset('js/frontend/product.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/frontend/owlcarousel.js') }}"></script>
@endsection

