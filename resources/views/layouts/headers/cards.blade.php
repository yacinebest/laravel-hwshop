<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row mt-3">
                @foreach($models as $name => $total)
                {{-- entity_route="{{ $routes[] }} --}}

                    <card-entity  entity_name="{{ $name }}" entity_total="{{ $total }}" entity_route="{{ route($routes[$name]) }}" ></card-entity>
                @endforeach
            </div>
        </div>
    </div>
</div>
