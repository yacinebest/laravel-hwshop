<footer class="page-footer font-small mdb-color lighten-3 pt-4 bg-dark ">

	<div class="container text-center mx-auto text-md-left">

        <div class="row ">

			<div class="col-md-4 col-lg-3 mr-auto my-md-4 my-0 mt-4 mb-1">
				<h5 class="font-weight-bold text-center text-uppercase mb-4">Content</h5>
				<p>Here you can use rows and columns to organize your footer content.</p>
			</div>

			<hr class="clearfix w-100 d-md-none">
			<div class="col-md-2 col-lg-2 mx-auto my-md-4 my-0 mt-4 mb-1">
				<h5 class="font-weight-bold text-uppercase mb-4">About</h5>
				<ul class="list-unstyled">
					<li><p><a href="#!">ABOUT US</a></p></li>
				</ul>
			</div>

			<hr class="clearfix w-100 d-md-none">
			<div class="col-md-4 col-lg-3 mx-auto my-md-4 my-0 mt-4 mb-1">
				<h5 class="font-weight-bold text-uppercase mb-4 text-center">Address</h5>
				<ul class="list-unstyled">
					<li>
						<p><i class="fa fa-home mr-1 icon-fa-style"></i> Algeria, Tlemcen 13000, DZ</p>
					</li>
					<li>
						<p><i class="fa fa-envelope mr-1 icon-fa-style"></i> hwshop@gmail.com</p>
					</li>
					<li>
						<p><i class="fa fa-phone mr-1 icon-fa-style"></i> + 213 0 00 00 00 00</p>
					</li>
					<li>
						<p><i class="fa fa-print mr-1 icon-fa-style"></i> + 213 0 00 00 00 00</p>
					</li>
				</ul>
			</div>

            <hr class="clearfix w-100 d-md-none">
			<div class="col-md-2 col-lg-2 text-center mx-auto my-4">
				<h5 class="font-weight-bold text-uppercase mb-4">Follow-Us</h5>
				<img alt="icon FACEBOOK" class="icon-follow-us" src="{{ asset('storage/svg/facebook-icon.svg') }}" >
				<img alt="icon INSTAGRAM" class="icon-follow-us" src="{{ asset('/storage/svg/instagram-2-1.svg') }}" >
				<img alt="icon TWITTER" class="icon-follow-us" src="{{ asset('/storage/svg/twitter-3.svg') }}" >
				<img alt="icon GOOGLE" class="icon-follow-us" src="{{ asset('/storage/svg/google-icon.svg') }}" >
				<img alt="icon LINKEDIN" class="icon-follow-us" src="{{ asset('/storage/svg/linkedin-icon.svg') }}" >
			</div>
		</div>
	</div>

	<div class="footer-copyright text-center py-3 footer-border">
		<img class="logo-style logo-icon-footer" src="{{ asset('/storage/svg/logo-hwshop.svg') }}" alt="HWShop Logo"  >
		<div class="justify-content-center">
            <a href="#" class="navbar-brand mr-auto style-menu logo-site ">
                <img class="logo-style logo-text-footer" src="{{ asset('/storage/svg/logo-hwshop-text.svg') }}" alt="HWShop Name"  >
            </a>
        </div>
	</div>
	<div class="footer-copyright text-center py-3 footer-border">©  {{ now()->year }} Copyright:</div>

</footer>
