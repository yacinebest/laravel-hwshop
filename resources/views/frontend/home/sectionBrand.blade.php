
<section class="section-name bg padding-y-sm">
    <div class="container">
        <header class="section-heading">
            <h3 class="section-title text-uppercase p-3">Nos Marques</h3>
        </header>

        <div class="row">
        @foreach($brands as $brand)
            <div class="col-md-2 col-6">
                <figure class="box item-logo shadow">
                    <img alt="{{ $brand->name }}" src="{{ asset('storage/uploads/logo/' . $brand->logo)}}">
                </figure>
            </div>
        @endforeach
        </div>

    </div>
</section>
