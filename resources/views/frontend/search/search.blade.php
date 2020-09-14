@extends('frontend.layouts.app')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>


<link rel="stylesheet" href="{{ asset('css/frontend/category.css') }}">

@endsection

@section('content')

{{-- section product filter --}}
<section class="section-content padding-y mb-5">
    <div class="container">
        @if($products)
            <search-paginate :q="{{$q}}" :products="{{ $products  }}" :nbr_product="{{$nbr_product }}"></search-paginate>
        @else
            <div>
                <h3>0 Products Found...</h3>
            </div>
        @endif
    </div>
</section>

@endsection



@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/frontend/owlcarousel.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

@endsection
