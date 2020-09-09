@extends('frontend.layouts.app', ['class' => 'bg-default'])


@section('links')
<link rel="stylesheet" href="{{ asset('css/frontend/home.css') }}">

<link rel="stylesheet" href="{{ asset('css/frontend/subcategory.css') }}">

<link rel="stylesheet" href="{{ asset('css/frontend/modal.css') }}" >
@endsection

@section('content')
<!-- carousel image defilante -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        {{-- <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li> --}}

    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active"
            style="background-image:  url('{{asset('/storage/background-carousel/image1-1920x1080.jpg')}}'') ">
            <div class="carousel-caption d-none d-md-block">
                <h3 class="display-0"></h3>
                <p class="lead"></p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<hr>

<div id="my-modal" class="modal" >
    <div class="modal-content"  >

        <div class="modal-header d-inline-block" >
            <h2 class="text-center text-uppercase d-block" >Choisir Une Categorie :</h2>
            <span class="close" >×</span>
        </div>

        <div class="modal-body text-center" >
        </div>

        <div class="modal-footer border-0" >
        </div>

    </div>
</div>


{{--  --}}
<h2 class="text-center">News</h2>
<hr>
<div class="container">
    <div class="row text-center">
        @for($i = 0; $i < 6; $i++)
        <div class="col-lg-4 col-md-6">
            <figure class="card card-product-grid shadow">
            <div class="img-wrap img-height">
                <img class="img-height" src="https://picsum.photos/seed/picsum/250/150">
                <a class="btn-overlay" href="#">
                <i class="fa fa-search-plus"></i>
                See Product
                </a>
            </div>

                <figcaption class="info-wrap" >
                <div class="text-center" style="height: 85px !important;" >
                    <a Producthref="#" Productclass="title h5 text-capitalize mw-100 mh-100 embed-responsive">Name Product</a>
                    <div class="price-wrap mt-2 price-product">
                        <span class="price">0 DZD</span>
                    </div>
                </div>
                <a href="#" class="btn btn-block btn-primary mt-2 ajouter-panier" data-id="1">
                    <i class="fa fa-cart-plus"></i>
                    Add To Cart
                </a>
                </figcaption>
            </figure>
        </div>
        @endfor
    </div>
</div>
<div class="product-more text-right"><a
        class="btn btn-danger all-product-link pull-md-right h4 product-more text-right m-3 voir-plus-produit"  data-filtre="plus recent" href="#">
        See More Products
    </a>
</div>
<hr>
{{--  --}}


<section class="section-name bg padding-y-sm">
    <div class="container">
        <header class="section-heading">
            <h3 class="section-title text-uppercase p-3">Nos Marques</h3>
        </header>

        <div class="row">
            <div class="col-md-2 col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque AMD" src="{{ asset('storage/svg/amd-2.svg') }}"></a>
                </figure>
            </div>
            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque INTEL" src="{{ asset('storage/svg/intel.svg') }}"></a>
                </figure>
            </div>
            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque GEFORCE" src="{{ asset('storage/svg/geforce-experience-2.svg') }}"></a>
                </figure>
            </div>
            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque MSI-GAMING" src="{{ asset('storage/svg/msi-gaming.svg') }}"></a>
                </figure>
            </div>
            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque RYZEN" src="{{ asset('storage/svg/ryzen.svg') }}"></a>
                </figure>
            </div>
            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque NZXT" src="{{ asset('storage/svg/nzxt-1.svg') }}"></a>
                </figure>
            </div>

            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque ASUS" src="{{ asset('storage/svg/asus-6630.svg') }}"></a>
                </figure>
            </div>

            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque RAZER" src="{{ asset('storage/svg/razer-1.svg') }}"></a>
                </figure>
            </div>

            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque STEELSERIES" src="{{ asset('storage/svg/steelseries.svg') }}"></a>
                </figure>
            </div>

            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque THERMALTAKE" src="{{ asset('storage/svg/thermaltake.svg') }}"></a>
                </figure>
            </div>

            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque CORSAIR" src="{{ asset('storage/svg/corsair-3.svg') }}"></a>
                </figure>
            </div>

            <div class="col-md-2  col-6">
                <figure class="box item-logo shadow">
                    <a href="#"><img alt="marque LOGITECH" src="{{ asset('storage/svg/logitech-5.svg') }}"></a>
                </figure>
            </div>
        </div>
    </div>
</section>
@endsection
