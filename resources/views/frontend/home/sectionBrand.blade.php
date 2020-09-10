
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

        {{-- <div class="row">
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
        </div> --}}
    </div>
</section>
