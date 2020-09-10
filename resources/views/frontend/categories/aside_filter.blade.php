<aside class="col-lg-3 col-md-4">
    <div class="card">

        @if($category->directChildCount)
        <article class="filter-group">
            <header class="card-header style-card-header py-2">
                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="d-inline-flex">
                    <i class="icon-control fa fa-chevron-down mr-2"></i>
                    <h6 id="sous-categorie-title" data-id="" data_href="" class="title text-capitalize" >
                        {{ $category->name }}
                    </h6>
                </a>
            </header>

            <div class="filter-content collapse show" id="collapse_1" >
                <div class="card-body">
                    <ul class="list-menu">
                        @foreach($category->childs as $subcategory)
                            <li>
                                <a href="{{ route('category',$subcategory->id) }}" class="text-capitalize text-dark" >
                                    {{ $subcategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </article>
        @endif

        <article class="filter-group">
            <header class="card-header style-card-header py-2">
                <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="d-inline-flex" >
                    <i class="icon-control fa fa-chevron-down mr-2"></i>
                    <h6 class="title">Brands :</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_3" >
                <div class="card-body">
                    @foreach($category->brands as $brand)
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" value="{{ $brand->name }}" class="custom-control-input marque-checkbox" />
                            <div class="custom-control-label">
                                {{ $brand->name }}
                                <b class="badge badge-pill badge-light float-right">
                                    {{ $brand->productsCount }}
                                </b>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
        </article>

        <article class="filter-group">
            <header class="card-header style-card-header py-2">
                <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true" class="d-inline-flex" >
                    <i class="icon-control fa fa-chevron-down mr-2"></i>
                    <h6 class="title">Price in DZD</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_4" >
                <div class="card-body">
                    <p>
                        <input type="text" id="amount" readonly="" class="text-dark text-center" style=" border: 0; font-weight: bold; width: -webkit-fill-available; " />
                    </p>

                    <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" >
                        <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 99.6%;" >
                        </div>

                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;" >
                        </span>
                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 99.6%;" >
                        </span>
                    </div>

                    <button id="price-filter" class="btn btn-block btn-sm btn-primary w-50 mt-3 mx-auto" >
                        Submit
                    </button>

                    <button id="price-reset" class="btn btn-block btn-sm btn-primary w-50 mt-3 mx-auto" >
                        Reset
                    </button>
                </div>
            </div>
        </article>

        <article class="filter-group">
            <header class="card-header style-card-header py-2">
                <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="true" class="d-inline-flex" >
                    <i class="icon-control fa fa-chevron-down mr-2"></i>
                    <h6 class="title">Other Filters :</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_5" >
                <div class="card-body">
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item switch-list">
                            <label class="switch">
                                <input type="checkbox" value="disponible" class="primary more-filter" />
                                <span class="slider round"></span>
                            </label>
                            <p class="pl-2 switch-text">
                                View Products Available
                            </p>
                        </li>

                        <li class="list-group-item switch-list">
                            <label class="switch">
                                <input type="checkbox" value="indisponible" class="primary more-filter" />
                                <span class="slider round"></span>
                            </label>
                            <p class="pl-2 switch-text">
                                Show products Unavailable
                            </p>
                        </li>

                    </ul>
                </div>
            </div>
        </article>

    </div>
</aside>
