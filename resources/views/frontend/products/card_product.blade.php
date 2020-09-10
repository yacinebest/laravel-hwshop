{{-- $page == home || category --}}
<div class="{{ $page=='home' || $page=='category' ? 'col-lg-4 col-md-6 ' : '' }} {{ $page=='carousel' ? 'item p-2' : '' }}">
    <figure class="card card-product-grid {{ $page=='home' ? 'shadow' : '' }}">
        <div class="img-wrap img-height {{ $page=='category' ? 'text-center' : '' }}">
            <img class="img-height" src="{{ $product->image ? $product->image->imagePath : 'https://picsum.photos/seed/picsum/380/225' }}" style="{{ $page=='category' && $product->copy_number>0 ? '' : '-webkit-filter: grayscale(100%); filter: grayscale(100%);' }}">
                <a class="btn-overlay" href="{{ route('product',$product->id) }}">
                    <i class="fa fa-search-plus"></i> See Product
                </a>
        </div>

        <figcaption class="info-wrap">
            <div class="text-center" style=" {{ $page=='category' ? 'min-height: 104px; ' : ' '  }} {{ $page=='home' ? 'height: 85px !important; ' : ' '  }} ">
                <a href="{{ route('product',$product->id) }}" class="title h5 text-capitalize {{ $page=='home' ? 'mw-100 mh-100 embed-responsive ' : ' '  }} {{ $page=='category' && $product->copy_number==0 ? 'text-secondary' : ''}} "  >
                    {{ $product->name }}
                </a>
                <div class="price-wrap mt-2 price-product">
                    <span class="price">{{ $product->price }} DZD</span>
                </div>
            </div>
            @if($product->copy_number>0)
                <a href="#" class="btn btn-block btn-primary mt-2 ajouter-panier ">
                    Add To Cart
                </a>
            @else
                <a href="#" class="btn btn-block btn-secondary mt-2 " style="cursor:default;" >Not available</a>
            @endif
        </figcaption>
    </figure>
</div>


{{--  --}}
{{--  --}}
{{-- carousel  --}}

{{-- <div class="item p-2"> --}}
    <article class="product">
        <div class="container" style="height: 200px !important; width: 200px !important;">
            <a href="{{ route('product',$product->id)  }}">
                <img class="mw-100 mh-100" src="{{ $product->image ? $product->image->imagePath : 'https://picsum.photos/seed/picsum/380/225' }}">
            </a>
        </div>
        <div class="container" style="height: 50px !important; width: 200px">
            <h5 class="mw-100 mh-100 embed-responsive">
                <a href="{{ route('product',$product->id)  }}">
                    {{ $product->name }}
                </a>
            </h5>
        </div>
        <div class="price-group">
            <div class="price text-success">
            <span class="currency">DZD</span>
            <span>{{ $product->price }}</span>
            </div>
        </div>
        <div class="btngroup">
            <button type="button" class="btn btn-primary fa fa-shopping-cart ajouter-panier" title="Add To Cart">
                Add To Cart
            </button>
        </div>
    </article>
</div>
