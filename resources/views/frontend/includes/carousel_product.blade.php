<div class="container-fluid my-4">
    <main class="col-lg-10 p-1 m-auto grid-categorie bg-white border rounded-sm shadow-sm">
        <div class="row justify-content-center">
            <h2 class="font-weight-bold m-4 text-uppercase title-grid">{{ $type }} :</h2>
        </div>
        <div class="tab-pane fade show active" id="nav-home">
            <section class="products clearfix text-center">
                <div class="owl-carousel owl-theme align-content-around">
                    @foreach($products as $product)
                        <div class="item p-2">
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
                    @endforeach
                </div>
            </section>
        </div>
    </main>
</div>
