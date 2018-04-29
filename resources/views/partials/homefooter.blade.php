<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
						<ul class="footer_nav">
							<li><a href="#">Blog</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Contact us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="footer_nav_container">
						<div class="cr">©2018 All Rights Reserverd. Theme by <a href="#">Colorlib</a></div>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<script src="{{ asset('coloshop/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('coloshop/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('coloshop/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('coloshop/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('coloshop/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('coloshop/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('coloshop/js/custom.js') }}"></script>
<script src="{{ asset('js/systemjs/system.js') }}"></script>
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/systemjs/0.19.22/system.js"></script> -->
<script type="text/javascript">
	SystemJS.config({
		  baseURL: '/js',
	});
  SystemJS.import('Cart.js').then((m) => {
	  new m.Cart(document);
  });

</script>

@yield('js')
</body>

</html>
