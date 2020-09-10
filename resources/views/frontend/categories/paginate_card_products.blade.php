<main class="col-lg-9 col-md-8">

    <header class="border-bottom mb-4 pb-3">
        <div class="form-inline">
            <span id="nombre-article" class="mr-md-auto">
                {{ $nbr_product }} Products Finds
            </span>
            <select id="order-select" class="mr-2 form-control" >
                <option value="plus recent" selected="selected">Most Recent</option>
                <option value="plus ancien">Oldest</option>
                <option value="plus vues">Most Viewed</option>
                <option value="plus vendus">Most Sold</option>
                <option value="prix croissant">Ascending price</option>
                <option value="prix decroissant">Decreasing price</option>
            </select>

            <select id="number-per-page" class="mr-2 form-control" >
                <option value="9" selected="selected">9</option>
                <option value="6">6</option>
                <option value="9">9</option>
                <option value="15">15</option>
                <option value="18">18</option>
                <option value="21">21</option>
            </select>

            <div class="btn-group">
                <a href="#" class="btn btn-outline-secondary" data-toggle="tooltip" title="" data-original-title="List view" >
                    <i class="fa fa-bars"></i>
                </a>
                <a href="#" class="btn btn-outline-secondary active" data-toggle="tooltip" title="" data-original-title="Grid view" >
                    <i class="fa fa-th"></i>
                </a>
            </div>
        </div>
    </header>

    <div id="display-article" class="row">
        @foreach($products as $product)
            @include('frontend.products.card_product',['product'=>$product,'page'=>'category'])
        @endforeach
    </div>


    {{ $products->links() ? $products->links() : '' }}
    {{-- <div>
        <nav class="mt-4" aria-label="Page navigation sample">
            <ul id="display-page" class="pagination float-right">
            </ul>
        </nav>
    </div> --}}

</main>
