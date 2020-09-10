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
                                <span class="text">En stock</span>
                            </a>
                        </li>
                    @else
                        <li style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="#" class="btn btn-sm btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-check"></i>
                                </span>
                                <span class="text">Non disponible</span>
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
                        {{ $product->commentCount }} Avis(s) / Donnez votre avis
                    </a>
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

                <div class="row">
                    <button type="button" class="btn btn-primary fa fa-shopping-cart mx-auto ajouter-panier" data-id="1" title="Ajouter au panier">
                        Ajouter au panier
                    </button>
                </div>

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
            <a class="nav-link" id="fiche-tab" data-class="fiche" data-toggle="tab">Fiche technique</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="comment-tab" data-class="comment" data-toggle="tab">
                Commentaires ({{ $product->commentCount }})
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
            {{ $product->datasheetFile }}
            @if($product->datasheet && $product->datasheetFile)
                @include('frontend.products.datasheet',['xml'=>$product->datasheetFile])
            @endif
        </div>

        <div id="comment" class="tab-pane tab-details container-fluid comment p-4">
            <div class="row">
                <div class="col-md-6" style="display: inline-block;">
                    <div class="product-reviews border rounded-sm shadow-sm p-2 bg-light">
                        @if($product->commentCount)
                            <hr class="m-1 p-1">
                            @foreach($product->comments as $comment)
                                <div class="comment-area">
                                    <div class="single-review border p-3 m-2 rounded-sm shadow-sm">
                                        <div class="review-heading">
                                            <div>
                                                <a href="">
                                                    <i class="fa fa-user-o"></i>{{ $comment->user->username }}
                                                </a>
                                                <a href="" class="float-right">
                                                    <i class="fa fa-clock-o"></i>{{ $comment->created_at}}
                                                </a>
                                            </div>
                                        </div>
                                        <hr class="p-0 m-1">
                                        <div class="review-body mt-2 p-2">
                                            <p>{{ $comment->body}}</p>
                                            @if(Auth::check())
                                                <hr class="p-0 m-1">
                                                <div class="review-footer pb-3">
                                                    <form action="" method="POST">
                                                        <input type="number" name="commentID" value="{{ $comment->id }}" class="p-0 m-0" hidden>
                                                        <button type="submit" class="btn btn-sm btn-info fa fa-trash float-right p-0 confirm"></button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fa fa-reply pl-3 reply-icon"></i>
                                            </div>
                                            <div class="col-11">
                                                <div class="single-review border p-3 my-2 mr-2 ml-0 rounded-sm shadow-sm">
                                                    <div class="review-heading">
                                                        <div>
                                                            <a href=""><i class="fa fa-user-o"></i> L'équipe HWShop</a>
                                                            <a href="" class="float-right">
                                                                <i class="fa fa-clock-o"></i>Resposne User
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <hr class="p-0 m-1">
                                                    <div class="review-body mt-2 p-2">
                                                        <p>Resposne Body</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="m-1 p-1">
                                        @if(Auth::check())
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <form class="col-md-12" action="" method="POST" class="review-form">
                                                        <label for="#review" id="review">Give Your Review:</label>
                                                        <div class="form-group shadow-sm">
                                                            <textarea class="input form-control comment-text" rows="2" name="commentContent" placeholder="Your Review.." required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-sm btn-primary" style="margin-bottom: 30px;">Send</button>
                                                    </form>
                                                </div>
                                                <div class="row">
                                                    <img class="col-md-12 mw-100" src="{{ asset('storage/image/comments.png') }}" alt="">
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-6 my-auto text-center">
                                                <h5>
                                                    <a href="{{ route('login.user') }}" target="_blank">Login To Post a Comment</a>
                                                </h5>
                                            </div>
                                        @endif
                                    </div>
                            @endforeach
                        @else
                            <h5 class="w-100 text-center">No Comments</h5>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/frontend/product.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/frontend/owlcarousel.js') }}"></script>
@endsection

