<style>

.colour:hover {
  color: white;
}

</style>

<footer class="footer-04">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-3 mb-md-0 mb-4">
						<h2 class="footer-heading"><a href="#" class="logo nav-link">Elisha Creation</a></h2>
						<p>Start Your Shopping and Experiance some amazing Discounts.</p>
						<a href="#" class="nav-link colour" onmousemove="this.style.color='#fffff'" onmouseout="this.style.color='#f76838'" style="color: #f76838;">read more <i class="fa-solid fa-circle-arrow-right"></i></a>
					</div>
					<div class="col-md-6 col-lg-3 mb-md-0 mb-4">
						<h2 class="footer-heading">Categories</h2>
						<ul class="list-unstyled">
              <li><a href="#" class="py-1 d-block nav-link">Home</a></li>
              <li><a href="#" class="py-1 d-block nav-link">Products</a></li>
              <li><a href="#" class="py-1 d-block nav-link">About Us</a></li>
              <li><a href="#" class="py-1 d-block nav-link">Contact &amp; Us</a></li>
            </ul>
					</div>
					<div class="col-md-6 col-lg-3 mb-md-0 mb-4">
						<h2 class="footer-heading">Latest</h2>
						<div class="tagcloud">
							<?php 
							 $cat_rs = Database::search("SELECT * FROM `category`");
							 $cat_num = $cat_rs->num_rows;
							 for ($x=0; $x < $cat_num; $x++) { 
								$cat_data = $cat_rs->fetch_assoc();
								?>
								<a href="index.php?.<?php echo "#".$cat_data["category_name"] ?>" class="tag-cloud-link nav-link"><?php echo $cat_data["category_name"] ?></a>
								<?php
							 }
							?>

	            
	          </div>
					</div>
					<div class="col-md-6 col-lg-3 mb-md-0 mb-4">
						<h2 class="footer-heading">Subscribe</h2>
						<form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="email" class="form-control rounded-left" placeholder="Enter email address">
                <button type="submit" class="form-control submit rounded-right" style="background-color: #f76838;"><span class="sr-only" style="background-color: #f76838;">Submit</span><i class="fa-solid fa-paper-plane"></i></button>
              </div>
            </form>
            <h2 class="footer-heading mt-5">Follow us</h2>
            <ul class="ftco-footer-social p-0">
              <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="fa-brands fa-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><span class="fa-brands fa-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="fa-brands fa-instagram"></span></a></li>
            </ul>
					</div>
				</div>
			</div>
			<div class="w-100 mt-2 border-top py-5">
				<div class="container">
					<div class="row">
	          <div class="col-md-6 col-lg-8">

	            <p class="copyright">
	  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="fa-solid fa-heart" aria-hidden="true"></i> By <a href="#" target="_blank">Elisha Creation</a>
	  </p>
	          </div>
	        </div>
				</div>
			</div>
		</footer>

		
		<script>
  window.addEventListener('load', function() {
    document.getElementById('preloader').style.display = 'none';
  });

 </script>
 
    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
	<script src="assets/js/jquery.sticky.js"></script>
	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="assets/js/script.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>