<div class="container-fluid my-4">
    <main class="col-lg-10 p-1 m-auto grid-categorie bg-white border rounded-sm shadow-sm">
        <div class="row justify-content-center">
            <h2 class="font-weight-bold m-4 text-uppercase title-grid">{{ $type }} :</h2>
        </div>
        <div class="tab-pane fade show active" id="nav-home">
            <section class="products clearfix text-center">
                <product-card :products_props="{{ $products  }}" page="carousel"></product-card>
            </section>
        </div>
    </main>
</div>
