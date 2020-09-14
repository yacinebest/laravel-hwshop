<div class="row bg-dark navbar-dark row search-bar grid-search-bar">

    <div class="col-md-10 col-sm-5 input-group search-bar-input text-left">
        <div>
            <a href="#">
            <img class="logo-style logo-icon pl-0" src="{{ asset('/storage/svg/logo-hwshop.svg') }}" alt="HWShop Logo"/>
            </a>
        </div>
        <div class="form mt-3 w-50">
            <form id="form-search-bar" action="{{ route('search.products',) }}" method="POST" style="   width: -webkit-fill-available;   display: flex;   margin: 0px !important; ">
                @csrf
                <input type="hidden" name="action" value="recherche" />
                <input id="input-search" type="text" class="form-control col-12" name="query" placeholder="Search Product..."/>
                <span class="input-group-btn input-button-style">
                    <button type="submit" class="btn btn-default btn-search" type="button">
                        <span class="fa fa-search"></span>
                    </button>
                </span>
            </form>
        </div>
    </div>

    <div class="col-md-2 col-sm-5 text-white text-center justify-content-center pt-2">
        <i class="fa fa-phone-square pr-2"> Call-Us</i>
        <h4>043-000-000</h4>
    </div>

</div>
