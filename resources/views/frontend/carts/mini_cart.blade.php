 {{-- include  $_SERVER['DOCUMENT_ROOT'] . "/public/includes/panier-cart.php" ; --}}
 <div class="container">
    <div class="shopping-cart" style="display: none; width:300px;  ">
        <ul class="dropdown-cart shopping-cart-items" role="menu" >

            <li class="header-shopping-cart" >
                <span class="text-uppercase">
                    <span class="fa fa-shopping-cart style-icon-short" style="font-size: 27px;margin-left: 5px;margin-top: 1px;" aria-hidden="true"></span>
                    <span class="cercel-number" ></span>
                    <span class="font-weight-bolder total-price">Total :
                        <span class="price-all-article">0</span>
                        DZD
                    </span>
                </span>
            </li>

            <li class="panier-vide" style="height:35px;text-align-last: center;position: relative;top: 6px;" >
                <span class="text-uppercase font-weight-bolder text-center">
                    Your Cart Is Empty
                </span>
            </li>




            <li class="dropdown-divider "></li>
            <div class="list-article-panier">

                <li data-id="1">
                    <span class="item">
                        <img class="img-cart" src="https://via.placeholder.com/50" alt="">
                        <span class="d-block" >
                            <a href="#" class="title font-weight-bolder text-capitalize text-dark" >
                                Name Product
                            </a>
                        </span>
                        <span class="price" style="font-weight: 900 !important;" >
                            <span class="text-muted qte">0 X </span>
                            0.00 DZD
                        </span>
                        <button class="btn fa fa-trash-o d-block float-right delete-article" style="font-size: 25px;"></button>
                    </span>
                </li>
                <li class="dropdown-divider "></li>
            </div>

            <li>
                <a href="{{ route('cart') }}" class="btn btn-out btn-primary btn-square btn-main btn-panier text-uppercase font-weight-bolder w-100" >
                    View Cart
                </a>
            </li>

        </ul>
    </div>
</div>
