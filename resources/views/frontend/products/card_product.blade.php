{{-- $page == home || category || carousel--}}
<div class="{{ $page=='home' || $page=='category' ? 'col-lg-4 col-md-6 ' : '' }} {{ $page=='carousel' ? 'item p-2' : '' }}">
    <figure class=" {{ $page=='home' || $page=='category' ? 'card card-product-grid ' : ''}}
                     {{ $page=='home' ? 'shadow ' : '' }}
                     {{ $page=='carousel' ? 'product' : '' }}">

        <div class=" {{ $page=='home' || $page=='category' ? 'img-wrap img-height ' : ''}}
                     {{ $page=='category' ? 'text-center ' : '' }}
                     {{ $page=='carousel' ? 'container ' : '' }}"  style="{{ $page=='carousel' ? 'height: 200px !important; width: 200px !important; ' : '' }}">

                <img class="{{ $page=='home' || $page=='category' ? 'img-height ' : ''}}
                            {{ $page=='carousel' ? 'mw-100 mh-100 ' : '' }}"
                     src="{{ $product->image ? $product->image->imagePath : 'https://picsum.photos/seed/picsum/380/225' }}" style="{{ $page=='category' && $product->copy_number>0 ? '' : '-webkit-filter: grayscale(100%); filter: grayscale(100%);' }}">
                <a class="btn-overlay" href="{{ route('product',$product->id) }}">
                    <i class="fa fa-search-plus"></i> See Product
                </a>
        </div>

        <figcaption class="info-wrap">
            <div class="{{ $page=='home' || $page=='category' ? 'text-center ' : ''}}
                        {{ $page=='carousel' ? 'container ' : '' }} "
                style=" {{ $page=='category' ? 'min-height: 104px; ' : ' '  }}
                        {{ $page=='home' ? 'height: 85px !important; ' : ' '  }}
                        {{ $page=='carousel' ? 'height: 50px !important; width: 200px ' : '' }} ">

                <a href="{{ route('product',$product->id) }}" class="title h5 text-capitalize {{ $page=='home' || $page=='carousel' ? 'mw-100 mh-100 embed-responsive ' : ' '  }} {{ $page=='category' && $product->copy_number==0 ? 'text-secondary' : ''}} "  >
                    {{ $product->name }}
                </a>
                @if($page=='carousel')
                    <div class="price-group">
                        <div class="price text-success">
                        <span class="currency">DZD</span>
                        <span>{{ $product->price }}</span>
                        </div>
                    </div>
                @else
                    <div class="price-wrap mt-2 price-product">
                        <span class="price">{{ $product->price }} DZD</span>
                    </div>
                @endif
            </div>

            @if($product->copy_number>0)
                <a href="#" class="{{ $page=='home' || $page=='category' ? 'btn btn-block btn-primary mt-2 ajouter-panier ' : ''}}
                                    {{ $page=='carousel' ? 'btn btn-primary fa fa-shopping-cart ajouter-panier ' : '' }}   ">
                    Add To Cart
                </a>
            @else
                <a href="#" class="btn btn-block btn-secondary mt-2 " style="cursor:default;" >Not available</a>
            @endif
        </figcaption>
    </figure>
</div>
