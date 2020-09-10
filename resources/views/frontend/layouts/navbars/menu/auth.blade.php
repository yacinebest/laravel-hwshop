<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<li class="nav-item nav-drop">
    <a href="{{ route('profile') }}" class="font-weight-lighter nav-link">
        <span class="fa fa-edit style-icon-short" aria-hidden="true"></span>
        My Profile
    </a>
</li>
<li class="dropdown-divider"></li>
<li class="nav-item nav-drop">
     <a href="{{ route('logout') }}" class="font-weight-lighter nav-link" onclick="event.preventDefault();
     document.getElementById('logout-form').submit();">
        <span class="fa fa-sign-out style-icon-short" aria-hidden="true"></span>
        <span>{{ __('Logout') }}</span>
    </a>
</li>
