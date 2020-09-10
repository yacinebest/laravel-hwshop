@extends('frontend.layouts.app')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>


<link rel="stylesheet" href="{{ asset('css/frontend/category.css') }}">


<!-- slider price range -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"/>
<!-- switch  -->
<link rel="stylesheet" href="{{ asset('css/frontend/switch.css') }}">
@endsection

@section('content')

{{-- link to parents --}}
@include('frontend.categories.link_parents',['category'=>$category])

{{-- section product filter --}}
<section class="section-content padding-y mb-5">
    <div class="container">
        <div class="row">

            @include('frontend.categories.aside_filter',['category'=>$category])

            @include('frontend.categories.paginate_card_products',['category'=>$category,'nbr_product'=>$nbr_product])

        </div>
    </div>
</section>

{{-- sub category link  --}}
@if($category->directChildCount)
@include('frontend.categories.subcategory',['category'=>$category])
@endif

{{-- carousel product link --}}
@foreach($productsOrderBy as $type => $products)
@include('frontend.includes.carousel_product',['type'=>$type,'products'=>$products])
@endforeach

@endsection



@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/frontend/owlcarousel.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/frontend/slider-range.js') }}"></script>
@endsection
