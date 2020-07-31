<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row mt-3">
                @foreach($cardCountAndRoute as $name => $result)
                    <card-entity  entity_name="{{ $name }}" entity_total="{{ $result['count'] }}" entity_route="{{ route($result['route'], isset($result['attribute'])? $result['attribute'] : null  ) }}" ></card-entity>
                @endforeach
            </div>
        </div>
    </div>
</div>
