<div class="col-md-4 mt-5 py-3 h-100 lateral border rounded-sm">
    <div class="row px-3">
        <span class="btn btn-lg btn-primary mb-2 w-100 profile-btn btn-menu" data-class="infos">
            <a href="{{ route('profile') }}" class="text-white">
                My Informations
            </a>
        </span>
    </div>
    <div class="row px-3">
        <span href="" class="btn btn-lg btn-primary mb-2 w-100 profile-btn btn-menu" data-class="orders">
            <a href="{{ route('user.orders') }}" class="text-white">
                My Orders
            </a>
        </span>
    </div>
    <div class="row px-3">
        <span class="btn btn-lg btn-primary mb-2 w-100 profile-btn btn-menu" data-class="history">
            <a href="{{ route('user.histories') }}" class="text-white">
                My Purchase History
            </a>
        </span>
    </div>
    <div class="row px-3">
        <span class="btn btn-lg btn-primary mb-2 w-100 profile-btn btn-menu" data-class="history">
            <a href="{{ route('user.comments') }}" class="text-white">
                My Comments
            </a>
        </span>
    </div>
    <div class="dropdown-divider mb-2"></div>
    <div class="row px-3">
        <a href="{{ route('logout') }}" class="fa fa-sign-out style-icon-short btn btn-lg btn-primary mx-auto w-100 profile-btn logout-btn"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    </div>
</div>
