<header class="fixed-top">
    @include('frontend.layouts.navbars.header')

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-padding nav-theme">

        <button id="collapse-bar" class="navbar-toggler first-button collapsed" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="justify-content-center">
            <a href="{{ route('home') }}" class="navbar-brand mr-auto style-menu logo-site">
                <img class="logo-style logo-text" src="{{ asset('/storage/svg/logo-hwshop-text.svg') }}" alt="HWShop Name" />
            </a>
        </div>

        <div class="nav navbar-nav btn-group btn-group-menu-mobile">
            <button type="button" class="btn btn-primary button-icon button-cart">
                <span class="fa fa-shopping-cart style-icon">
                    <span class="cercel-number"></span>
                </span>
            </button>
            <button type="button" class="btn btn-primary button-icon" data-toggle="dropdown" aria-expanded="false" >
                <span class="fa fa-user o style-icon"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-right-position p-0 m-0" >
                <ul class="dropdown-menu dropdown-width-compte navbar-dark bg-dark navbar-padding liste-comp" style="margin-top: 12px;" >

                    @if(Auth::check())
                        @include('frontend.layouts.navbars.menu.auth')
                    @else
                        @include('frontend.layouts.navbars.menu.user')
                    @endif
                </ul>
            </div>
        </div>

        <!-- premiere partie du Menu Accueil, categorie... -->
        <div id="navbarMenu" class="in navbar-collapse justify-content-center collapse pr-3">
            <ul class="navbar-nav border-style-navbar">
                <li class="nav-item border-style-navbar">
                    <a href="{{ route('home') }}" class="nav-link nav-link-height">
                        <span class="fa fa-home style-icon-short" aria-hidden="true"></span>
                        HOME
                    </a>
                </li>
                <li class="nav-item dropdown border-style-navbar width-categorie">
                    <a class="nav-link nav-link-height dropdown-toggle caret-off" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="fa fa-list-alt style-icon-short" aria-hidden="true" ></span>
                            CATEGORIES
                            <span class="fa fa-angle-right style-icon-small" aria-hidden="true" ></span>
                    </a>
                    @include('frontend.layouts.navbars.submenu')
                </li>

                <li id="panier" class="nav-item">
                    <a href="#" class="nav-link nav-link-height border-style-navbar button-cart" >
                        <span class="fa fa-shopping-cart style-icon-short" aria-hidden="true" style="position: sticky;" >
                            <span class="cercel-number" style="left: 3px; top: -19px;" ></span>
                        </span >
                        CART
                    </a >
                </li>

                <li class="nav-item">
                    <a href="{{ route('faq') }}" class="nav-link nav-link-height border-style-navbar" >
                        <span class="fa fa-question-circle style-icon-short" aria-hidden="true" ></span >
                        FAQ
                    </a >
                </li>

            </ul>
        </div>

      <!-- deuxieme partie du Menu Mon compte -->
        <div id="navbarMenuButtonGroup">
        {{-- <div id="navbarMenuButtonGroup" class="navbarMenu-connexion-inscription"> --}}
            <!-- Compte avec logo -->
            <div class="nav navbar-nav navbar-right btn-group btn-group-menu">
                <button id="user-shop-icon" type="button" class="btn btn-primary button-icon button-cart">
                    <span class="fa fa-shopping-cart style-icon">
                        <span class="cercel-number"></span>
                    </span>
                </button>

                <button id="user-compte-icon" type="button" class="btn btn-primary button-icon" data-toggle="dropdown" aria-expanded="false">
                    <span class="fa fa-user o style-icon"></span>
                </button>

                <div class="dropdown-menu dropdown-menu-right m-0 p-0">
                    <ul class="dropdown-menu dropdown-width-compte navbar-dark bg-dark navbar-padding liste-comp" style="margin-top: 12px; width: max-content; left: auto;" >

                        @if(Auth::check())
                            @include('frontend.layouts.navbars.menu.auth')
                        @else
                            @include('frontend.layouts.navbars.menu.user')
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Compte sans logo avec texte seulemnt -->
            <div id="navbarcompte" class="nav navbar-nav navbar-right drop-compte">
                <div id="user-compte-txt" class="nav-item nav-drop nav-icon">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >
                        <span class="fa fa-user o style-icon"></span>
                    </a>
                </div>

                <div id="compte-drop" class="nav-item dropdown border-style-navbar log-sign">
                    <a class="nav-link nav-link-height dropdown-toggle caret-off" data-toggle="dropdown" href="#" aria-expanded="false" >
                        <span class="fa fa-user style-icon-short"></span>
                        My Account
                        <span class="fa fa-angle-right style-icon-small" aria-hidden="true"></span>
                        <span class="sr-only"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-width-compte navbar-dark bg-dark navbar-padding lop" >

                        @if(Auth::check())
                            @include('frontend.layouts.navbars.menu.auth')
                        @else
                            @include('frontend.layouts.navbars.menu.user')
                        @endif

                    </ul>
                </div>
            </div>

        </div>
    </nav>

    @include('frontend.carts.mini_cart')
</header>
