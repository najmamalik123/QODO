<style>
	.badge {
		display: inline-block;
		padding: 5px 15px;
		font-size: 11px;
		font-weight: 700;
		line-height: 1;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		border-radius: 20px;
	}

	a.badge:hover,
	a.badge:focus {
		text-decoration: none
	}

	.badge:empty {
		display: none
	}py-5 px-3 rounded

	.btn .badge {
		position: relative;
		top: -1px
	}

	.badge-pill {
		padding-right: .6em;
		padding-left: .6em;
		border-radius: 10rem
	}

	.badge-primary {
		color: #fff;
		background-color: #3f6ad8
	}

	a.badge-primary:hover,
	a.badge-primary:focus {
		color: #fff;
		background-color: #2651be
	}

	.badge-secondary {
		color: #fff;
		background-color: #6c757d
	}

	a.badge-secondary:hover,
	a.badge-secondary:focus {
		color: #fff;
		background-color: #545b62
	}

	.badge-success {
		color: #fff;
		background-color: #3ac47d
	}

	a.badge-success:hover,
	a.badge-success:focus {
		color: #fff;
		background-color: #2e9d64
	}

	.badge-info {
		color: #fff;
		background-color: #16aaff
	}

	a.badge-info:hover,
	a.badge-info:focus {
		color: #fff;
		background-color: #0090e2
	}

	.badge-warning {
		color: rgb(255, 255, 255);
		background-color: #f7b924
	}

	a.badge-warning:hover,
	a.badge-warning:focus {
		color: #212529;
		background-color: #e0a008
	}

	.badge-danger {
		color: #fff;
		background-color: #d92550
	}

	a.badge-danger:hover,
	a.badge-danger:focus {
		color: #fff;
		background-color: #ad1e40
	}

	.badge-light {
		color: #212529;
		background-color: #eee
	}

	a.badge-light:hover,
	a.badge-light:focus {
		color: #212529;
		background-color: #d5d5d5
	}

	.badge-dark {
		color: #fff;
		background-color: #343a40
	}

	a.badge-dark:hover,
	a.badge-dark:focus {
		color: #fff;
		background-color: #1d2124
	}

	.badge-focus {
		color: #fff;
		background-color: #444054
	}

	a.badge-focus:hover,
	a.badge-focus:focus {
		color: #fff;
		background-color: #2d2a37
	}

	.badge-alternate {
		color: #fff;
		background-color: #794c8a
	}

	a.badge-alternate:hover,
	a.badge-alternate:focus {
		color: #fff;
		background-color: #5c3a69
	}
	
	.footercol {
	    width:25%;
	}
	
@media screen and (max-width: 900px) {
    .footercol {
        width: 50%;
    }
}

</style>
<div class="p-2 bg-light offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" data-bs-backdrop="false">
	<div class="sidebar-nav mb-3">
		<div class="pb-4">
			<a href="<?= base_url('home') ?>" class="text-decoration-none">
				<img src="<?= base_url('assets/avator/logo.png') ?>" class="img-fluid logo" alt="brand-logo">
			</a>
		</div>
		<ul class="navbar-nav justify-content-end flex-grow-1">
			<li class="nav-item p-2">
				<a href="<?= base_url('home') ?>" class="nav-link <?= $last_segment == '' ? 'active' : '' ?>"><span class="material-icons me-3">house</span> <span>Home</span></a>
			</li>
			<li class="nav-item px-2">
				<a href="<?= base_url('explore') ?>" class="nav-link <?= $last_segment == 'explore' ? 'active' : '' ?>"><span class="material-icons me-3">location_city</span><span>Articles & News</span></a>
			</li>
			<li class="nav-item px-2">
				<a href="<?= base_url('properties') ?>" class="nav-link <?= $last_segment == 'properties' ? 'active' : '' ?>"><span class="material-icons me-3">real_estate_agent</span> <span>Explore Properties</span></a>
			</li>
			<li class="nav-item px-2">
				<a href="<?= base_url('properties') ?>" class="nav-link <?= $last_segment == 'properties' ? 'active' : '' ?>"><span class="material-icons me-3">domain</span> <span>Hot Investments</span></a>
			</li>
			<li class="nav-item px-2">
				<a href="<?= base_url('calculator') ?>" class="nav-link <?= $last_segment == 'calculator' ? 'active' : '' ?>"><i class="fa-solid fa-calculator me-3"></i> <span>Tools & Calculators</span></a>
			</li>


			<li class="nav-item px-2">
				<a href="<?= base_url('contact') ?>" class="nav-link <?= $last_segment == 'contact' ? 'active' : '' ?>"><span class="material-icons me-3">explore</span> <span>Messages</span></a>
			</li>
			<li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'developers' ? 'active' : '' ?>" href="<?= base_url('developers') ?>"><span class="material-icons me-3">manage_accounts</span> <span>Developers</span></a></li>
				

			<li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'faq' ? 'active' : '' ?>" href="<?= base_url('faq') ?>"><span class="material-icons me-3">question_answer</span> <span>Foreign Investments</span></a></li>
			<?php if (isset($_SESSION['yid'])) {  ?>
				<li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'my-property' ? 'active' : '' ?>" href="<?= base_url('my-property') ?>"><i class="fa-solid fa-house-user  me-3"></i><span>My Properties</span></a></li>
				<!--<li class="nav-item px-2">-->
				<!--	<a href="<?= base_url('profile') ?>" class="nav-link <?= $last_segment == 'profile' ? 'active' : '' ?>"><span class="material-icons me-3">account_circle</span> <span>Profile</span></a>-->
				<!--</li>-->
				<!--<li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'edit' ? 'active' : '' ?>" href="<?= base_url('edit') ?>"><span class="material-icons me-3">manage_accounts</span> <span>Edit Profile</span></a></li>-->
                <li class="nav-item px-2">
					<a href="<?= base_url('logout') ?>" class="nav-link"><span class="material-icons me-3">logout</span> <span>Logout</span></a>
				</li>
			<?php } ?>
		</ul>
	</div>
	<?php if (!isset($_SESSION['yid'])) {  ?>
		<a href="<?= base_url('login') ?>" class="btn btn-primary w-100 text-decoration-none rounded-pill py-2 fw-bold text-uppercase m-0 mb-2">Sign In +</a>
	<?php } ?>

	<?php if (!isset($_SESSION['yid']) || $_SESSION['plan'] == '') {  ?>
		<a href="<?= base_url('membership') ?>" class="btn btn-primary w-100 text-decoration-none rounded-pill py-2 fw-bold text-uppercase m-0">Become a Member</a>
	<?php } ?>
</div>

<section class="py-5 px-3 rounded app-banner1" style="    background: #ffeaf0 !important;">
	<div class="container">
		<div class="row align-items-center">
			<!-- Text Content -->
			<div class="col-md-6 mb-4 mb-md-0">
				<h4 class="fw-bold text-dark">Download <?= $site_name ?> Mobile App</h4>
				<p class="text-muted mb-3">and never miss out any update</p>
				<ul class="list-unstyled">
					<li class="mb-2">
						<span class="text-primary me-2">&#10003;</span>
						Get to know about newly posted properties as soon as they are posted
					</li>
					<li>
						<span class="text-primary me-2">&#10003;</span>
						Manage your properties with ease and get instant alerts about responses
					</li>
				</ul>
				<div class="d-flex mt-4">
					<a href="#"><img src="<?= base_url('assets/avator/apps/app-and.png') ?>" alt="Google Play" style="height:40px; margin-right: 10px;"></a>
					<a href="#"><img src="<?= base_url('assets/avator/apps/app-ios.png') ?>" alt="App Store" style="height:40px;"></a>
				</div>
			</div>

			<!-- Mobile Image -->
			<div class="col-md-6 text-center">
				<div class="position-relative d-inline-block">
					<img src="<?= base_url('assets/avator/mobile.png') ?>" alt="Mobile App" class="img-fluid rounded" style="max-height: 350px;">
					<span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger">
						<i class="fa-solid fa-bell text-white"></i>
					</span>
					<div class="position-absolute bottom-0 start-50 translate-middle-x bg-white px-3 py-2 shadow rounded-pill" style="    width: 180px;  margin-left: -75px;">
						<i class="fa-solid fa-cloud-arrow-down" style="font-size: 15px;"></i> 5M+ Downloads
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="py-5 text-white app-banner2" style="background-color: #5B2333;">
	<div class="container">
		<div class="row">
		    
		    
		    <div class="col-md-3 col-sm-6 mb-4">
				<img src="<?= base_url('assets/avator/logo_light.png') ?>" style="width:70%;height:auto;">
				<p><?= $site_brief ?> </p>
			</div>
			
			<div class="col-md-9 col-sm-6 d-flew row">
			    			<!-- First Column -->
			<div class="footercol col-sm-6 mb-4">
				<h6 class="fw-bold">Quick Links</h6>
				<ul class="list-unstyled">
					<li><a href="#" class="text-white text-decoration-none">Mobile Apps</a></li>
					<li><a href="<?= base_url('properties') ?>" class="text-white text-decoration-none">Our Services</a></li>
					<li><a href="#" class="text-white text-decoration-none">Price Trends</a></li>
					<li><a href="<?= base_url('add-property') ?>" class="text-white text-decoration-none">Post your Property</a></li>
					<li><a href="<?= base_url('contact') ?>" class="text-white text-decoration-none">Real Estate Investments</a></li>
					<li><a href="<?= base_url('member') ?>" class="text-white text-decoration-none">Join Richo Club</a></li>
				</ul>
			</div>

			<!-- Second Column -->
			<div class="footercol col-sm-6 mb-4">
				<h6 class="fw-bold">Company</h6>
				<ul class="list-unstyled">
					<li><a href="<?= base_url('about') ?>" class="text-white text-decoration-none">About us</a></li>
					<li><a href="<?= base_url('contact') ?>" class="text-white text-decoration-none">Contact us</a></li>
					<li><a href="#" class="text-white text-decoration-none">Careers with us</a></li>
					<li><a href="<?= base_url('terms') ?>" class="text-white text-decoration-none">Terms & Conditions</a></li>
					<li><a href="<?= base_url('privacy') ?>" class="text-white text-decoration-none">Privacy Policy</a></li>
				</ul>
			</div>

			<!-- Third Column -->
			<!--<div class="footercol col-sm-6 mb-4">-->
			<!--	<h6 class="fw-bold">Network Sites</h6>-->
			<!--	<ul class="list-unstyled">-->
			<!--		<li><a href="#" class="text-white text-decoration-none">Naukri.com</a></li>-->
			<!--		<li><a href="#" class="text-white text-decoration-none">Shiksha.com</a></li>-->
			<!--		<li><a href="#" class="text-white text-decoration-none">Jeevansathi.com</a></li>-->
			<!--		<li><a href="#" class="text-white text-decoration-none">Policybazaar.com</a></li>-->
			<!--		<li><a href="#" class="text-white text-decoration-none">AmbitionBox.com</a></li>-->
			<!--	</ul>-->
			<!--</div>-->

			<!-- Fourth Column -->
			<div class="footercol col-sm-6 mb-4">
				<h6 class="fw-bold">Connect with us</h6>
				<p class="mb-2">Toll Free - <?= $site_phone ?><br><small>9:30 AM to 6:30 PM (Mon-Sun)</small></p>
				<p class="mb-2">Email - <a href="mailto:<?= $site_email ?>" class="text-white"><?= $site_email ?></a></p>
				<div class="mb-3">
					<a href="<?= $social_fb ?>" class="text-white me-2"><i class="icofont-facebook"></i></a>
					<a href="<?= $social_tw ?>" class="text-white me-2"><i class="icofont-twitter"></i></a>
					<a href="<?= $social_yt ?>" class="text-white me-2"><i class="icofont-youtube-play"></i></a>
					<a href="<?= $social_in ?>" class="text-white me-2"><i class="icofont-instagram"></i></a>
				</div>
			</div>
			
			<div class="footercol col-sm-6 mb-4">
				
				<h6 class="fw-bold">Download the App</h6>
				<div class="d-flex mb-2">
					<a href="#"><img src="<?= base_url('assets/avator/apps/app-and.png') ?>" alt="Google Play" height="35" class="me-2"></a>
					<a href="#"><img src="<?= base_url('assets/avator/apps/app-ios.png') ?>" alt="App Store" height="35"></a>
				</div>
				<p class="small">Usage of site to upload content showing area in non-standard units or enabling targeting by religion/community is prohibited. <a href="#" class="text-white text-decoration-underline">Report abuse</a></p>
			</div>
			    
			</div>



		</div>

		<div class="text-center mt-4">
			<p class="small mb-1">All trademarks are the property of their respective owners.</p>
			<p class="small mb-0">©<?= date('Y') ?> <strong><?= $site_name ?></strong>. All rights reserved – <?= $site_name ?>.</p>
		</div>
	</div>
</div>


<style>
	.mobile-footer {
		position: fixed;
		bottom: 0;
		left: 0;
		width: 100%;
		background: #fff;
		display: flex;
		justify-content: space-around;
		align-items: center;
		padding: 10px 0;
		box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
		border-top: 1px solid #ddd;
		z-index: 1000;
	}

	.footer-item {
		text-align: center;
		color: #333;
		text-decoration: none;
		flex-grow: 1;
		font-size: 12px;
	}

	.footer-item i {
		font-size: 24px;
		display: block;
		margin-bottom: 3px;
	}

	.footer-item.add-btn {
		transform: scale(1.3);
		/* color: #ff4500; */
		color: #007bff;
	}

	.footer-item.active {
		color: #007bff;
	}
</style>

<div class="mobile-footer d-sm-none d-flex">
	<a href="<?= base_url('home') ?>" class="footer-item <?= ($this->uri->segment(1) == '') ? 'active' : '' ?>">
		<i class="material-icons">house</i>
		<!-- <span>Home</span> -->
	</a>
	<a href="<?= base_url('properties') ?>" class="footer-item <?= ($this->uri->segment(1) == 'properties') ? 'active' : '' ?>">
		<i class="fas fa-chart-bar d-block mb-1 "></i>
		<!-- <span>Search</span> -->
	</a>
	<a href="javascript:void(0)" class="footer-item noload" data-bs-toggle="modal" data-bs-target="#postModal">
		<i class="material-icons">add_circle</i>
	</a>
	<a href="<?= base_url('explore') ?>" class="footer-item <?= ($this->uri->segment(1) == 'explore') ? 'active' : '' ?>">
		<i class="fa-solid fa-newspaper d-block mb-1"></i>
		<!-- <span>Likes</span> -->
	</a>
	<a href="<?= base_url('videos') ?>" class="footer-item <?= ($this->uri->segment(1) == 'videos') ? 'active' : '' ?>">
			<i class="fas fa-play-circle d-block mb-1"></i>
		<!-- <span>Likes</span> -->
	</a>
	<a href="<?= base_url('profile') ?>" class="footer-item <?= ($this->uri->segment(1) == 'profile') ? 'active' : '' ?>">
		<i class="material-icons">account_circle</i>
		<!-- <span>Profile</span> -->
	</a>
</div>
<!-- Filter Modal -->
<!-- <div class="modal fade" id="filtersModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content rounded-4 p-4 border-0 bg-light">
			<div class="modal-header d-flex align-items-center justify-content-start border-0 p-0 mb-3">
				<a href="#" class="text-muted text-decoration-none material-icons noload backBtn" data-bs-dismiss="modal">arrow_back_ios_new</a>
				<h5 class="modal-title text-muted ms-3 ln-0" id="staticBackdropLabel">Apply Filters</h5>
			</div>
			<?php
			// Getting filter values from URL
			$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
			$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : 500000;
			$selected_bedrooms = isset($_GET['bedrooms']) ? $_GET['bedrooms'] : '';
			$selected_bathrooms = isset($_GET['bathrooms']) ? $_GET['bathrooms'] : '';
			$selected_categories = isset($_GET['categories']) ? explode(',', $_GET['categories']) : [];
			?>

			<form method="get" action="<?= base_url('properties') ?>">
				<div class="modal-body p-0 mb-3">

					Price Range Sliders
<div class="mb-4">
	<label class="form-label h6 text-muted">Price Range</label>
	<div class="d-flex justify-content-between mb-2">
		<div>
			<label for="minPrice" class="form-label">Minimum Price: <span id="minPriceLabel"><?= $min_price ?></span></label>
			<input type="range" class="form-range" min="0" max="500000" step="1000" name="min_price" id="minPrice" value="<?= $min_price ?>">
		</div>
		<div>
			<label for="maxPrice" class="form-label">Maximum Price: <span id="maxPriceLabel"><?= $max_price ?></span></label>
			<input type="range" class="form-range" min="0" max="500000" step="1000" name="max_price" id="maxPrice" value="<?= $max_price ?>">
		</div>
	</div>
</div>

Categories as Pill-shaped Checkboxes
<div class="mb-4">
	<label class="form-label h6 text-muted">Categories</label>
	<div class="btn-group-toggle d-flex flex-wrap gap-2" data-toggle="buttons">
		<?php
		$categories = $this->db->query("SELECT * FROM yn_site_catagory WHERE display = '1' ORDER BY sid ASC")->result_array();
		foreach ($categories as $category) {
			$isChecked = in_array($category['ctid'], $selected_categories) ? 'checked' : '';
		?>
			<label class="btn btn-outline-primary rounded-pill">
				<input type="checkbox" name="categories[]" value="<?= $category['ctid'] ?>" <?= $isChecked ?>> <?= $category['name'] ?>
			</label>
		<?php } ?>
	</div>
</div>

Bedrooms Dropdown
<div class="form-floating mb-3">
	<select class="form-control rounded-5 border-0 shadow-sm" name="bedrooms" id="bedrooms">
		<option value="">Select Number of Bedrooms</option>
		<?php for ($i = 1; $i <= 10; $i++) { ?>
			<option value="<?= $i ?>" <?= $selected_bedrooms == $i ? 'selected' : '' ?>><?= $i ?></option>
		<?php } ?>
	</select>
	<label for="bedrooms" class="h6 text-muted mb-0">Number of Bedrooms</label>
</div>

Bathrooms Dropdown
<div class="form-floating mb-3">
	<select class="form-control rounded-5 border-0 shadow-sm" name="bathrooms" id="bathrooms">
		<option value="">Select Number of Bathrooms</option>
		<?php for ($i = 1; $i <= 10; $i++) { ?>
			<option value="<?= $i ?>" <?= $selected_bathrooms == $i ? 'selected' : '' ?>><?= $i ?></option>
		<?php } ?>
	</select>
	<label for="bathrooms" class="h6 text-muted mb-0">Number of Bathrooms</label>
</div>
</div>

<div class="modal-footer justify-content-between px-1 py-1 bg-white shadow-sm rounded-5">
	<button type="submit" class="btn btn-primary rounded-5 fw-bold px-3 py-2 fs-6 mb-0">Apply Filters</button>
	<button type="button" class="btn btn-secondary rounded-5 fw-bold px-3 py-2 fs-6 mb-0" data-bs-dismiss="modal">Close</button>
</div>
</form>

<script>
	document.getElementById('minPrice').addEventListener('input', function() {
		document.getElementById('minPriceLabel').textContent = this.value;
	});

	document.getElementById('maxPrice').addEventListener('input', function() {
		document.getElementById('maxPriceLabel').textContent = this.value;
	});
	document.querySelector('form').addEventListener('submit', function(event) {
		event.preventDefault(); // Prevent normal form submission

		const selectedCategories = [];
		document.querySelectorAll('input[name="categories[]"]:checked').forEach((checkbox) => {
			selectedCategories.push(checkbox.value);
		});

		// Convert the categories array to a comma-separated string
		const categoriesString = selectedCategories.join(',');

		// Create a FormData object from the form
		const formData = new FormData(this);

		// Remove the existing categories[] entries from the FormData object
		formData.delete('categories[]');

		// Append the new categories string
		formData.append('categories', categoriesString);

		// Generate the query string from the form data
		const params = new URLSearchParams(formData).toString();

		// Redirect to the new URL with the filtered parameters
		window.location.href = this.action + '?' + params;
	});
</script>
</div>
</div>
</div> -->
 <!-- Share Modal -->
                <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-3">
                      <div class="modal-header">
                        <h5 class="modal-title" id="shareModalLabel">Share This Page</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        <div class="d-flex justify-content-around">
                          <a href="#" onclick="shareTo('facebook')" class="text-primary fs-4"><i class="fab fa-facebook"></i></a>
                          <a href="#" onclick="shareTo('twitter')" class="text-info fs-4"><i class="fab fa-twitter"></i></a>
                          <a href="#" onclick="shareTo('linkedin')" class="text-primary fs-4"><i class="fab fa-linkedin"></i></a>
                          <a href="#" onclick="shareTo('whatsapp')" class="text-success fs-4"><i class="fab fa-whatsapp"></i></a>
                          <a href="#" onclick="shareTo('copy')" class="text-dark fs-4"><i class="fas fa-link"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                  function shareTo(platform) {
                    const url = encodeURIComponent(window.location.href);
                    const title = encodeURIComponent(document.title);
                
                    let shareUrl = "";
                
                    switch (platform) {
                      case "facebook":
                        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                        break;
                      case "twitter":
                        shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                        break;
                      case "linkedin":
                        shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                        break;
                      case "whatsapp":
                        shareUrl = `https://api.whatsapp.com/send?text=${title} ${url}`;
                        break;
                      case "copy":
                        navigator.clipboard.writeText(window.location.href)
                          .then(() => alert("Link copied to clipboard!"))
                          .catch(() => alert("Failed to copy link."));
                        return;
                    }
                
                    window.open(shareUrl, '_blank');
                  }
                </script>



<!-- Post Modal -->
<!-- Post Modal -->
<!-- Updated Post Modal -->
<div class="modal fade" id="postModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 border-0 shadow-lg">

      <!-- Modal Header -->
      <div class="modal-header border-bottom-0 pb-0 bg-light rounded-top-4">
        <div class="d-flex align-items-center w-100">
          <button type="button" class="btn btn-close p-1" data-bs-dismiss="modal"></button>
          <h5 class="modal-title ms-3 fw-bold">Create Post</h5>
          <button type="submit" form="postForm" class="btn btn-primary ms-auto rounded-pill px-4 fw-bold shadow-sm">
            <span id="post-button-text">Post</span>
            <span id="post-button-loader" class="spinner-border spinner-border-sm d-none"></span>
          </button>
        </div>
      </div>

      <!-- FORM -->
      <form id="postForm" method="post" action="<?= base_url('index.php/action/add_post') ?>"
        onsubmit="return uploadandform('<?= base_url('index.php/action/add_post') ?>','post',this,'image_name','progress_value_image','prog_value_text_image','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status','progress_value_video','prog_value_text_video');"
				enctype="multipart/form-data">
           <!-- User Profile Section -->
                <div class="d-flex align-items-center px-4 pt-3 pb-2">
                    <?php
                    if (isset($_SESSION['yid']) && $_SESSION['yid'] != '') {
                        $user = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
                        $profile_pic = base_url('assets/mem/' . $user['mid'] . '/img/' . $user['photo']);
                        echo "<img src='$profile_pic' class='rounded-circle me-3' style='width:48px;height:48px;object-fit:cover; border: 2px solid #f8f9fa'>";
                    } else {
                        echo '<span class="material-icons md-36 me-3">account_circle</span>';
                    }
                    ?>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark"><?= isset($user) ? $user['name'] : 'User' ?></h6>
                        <small class="text-muted">Posting to: <span class="text-primary">Public</span></small>
                    </div>
                </div>

        <div class="modal-body px-4 pt-0 pb-3">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" placeholder="Enter post title">
            <label>Title</label>
          </div>

          <div class="form-floating mb-3">
            <textarea class="form-control" name="post" style="height: 120px;"></textarea>
            <label>What's on your mind?</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="tags" placeholder="Enter tags">
            <label>Tags (comma separated)</label>
          </div>

          <!-- PREVIEW SECTION -->
          <div class="mb-4" id="preview-section" style="display:none;">
            <div id="image-preview" style="display:none;"></div>
            <div id="video-preview" style="display:none;">
              <video id="preview-video" controls class="w-100" style="max-height:300px"></video>
            </div>
          </div>

          <!-- POLL SECTION -->
          <div class="mb-4" id="poll-section" style="display:none;">
            <div class="card border-light shadow-sm">
              <div class="card-body">
                <h6 class="fw-bold text-muted">Poll Options</h6>
                <div id="poll-options"></div>
                <button type="button" id="add-poll-option" class="btn btn-outline-primary mt-2 rounded-pill">
                  <span class="material-icons md-18 me-1">add</span> Add Option
                </button>
              </div>
            </div>
          </div>

          <input type="hidden" name="has_poll" id="has_poll" value="0">
        </div>

        <!-- FOOTER BUTTONS -->
        <div class="modal-footer border-top-0 px-4 pb-4 bg-light">
          <div class="d-flex w-100">

            <!-- MULTIPLE IMAGE UPLOAD -->
            <label class="btn btn-light rounded-pill me-2 d-flex align-items-center px-3 shadow-sm">
              <span class="material-icons text-primary me-2">photo_camera</span>
              <span class="small">Photo</span>
              <input type="file" name="post_images[]" id="post-img" class="d-none" accept="image/*" multiple>
            </label>

            <!-- VIDEO UPLOAD -->
            <label class="btn btn-light rounded-pill me-2 d-flex align-items-center px-3 shadow-sm">
              <span class="material-icons text-danger me-2">videocam</span>
              <span class="small">Video</span>
              <input type="file" name="post_video" id="post-vid" class="d-none" accept="video/*">
            </label>

            <!-- POLL -->
            <button type="button" class="btn btn-light rounded-pill px-3 shadow-sm" onclick="togglePollSection()">
              <span class="material-icons text-warning me-2">poll</span>
              <span class="small">Poll</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const pollSection = document.getElementById("poll-section");
  const pollOptions = document.getElementById("poll-options");
  const hasPoll = document.getElementById("has_poll");

  document.getElementById("add-poll-option").addEventListener("click", () => {
    const count = pollOptions.querySelectorAll(".poll-option").length + 1;
    pollOptions.insertAdjacentHTML("beforeend", `
      <div class="poll-option input-group mb-2">
        <input type="text" class="form-control" name="poll_option[]" placeholder="Option ${count}">
        <button type="button" class="btn btn-outline-light remove-option">X</button>
      </div>
    `);
  });

  pollOptions.addEventListener("click", (e) => {
    if (e.target.closest(".remove-option")) e.target.closest(".poll-option").remove();
  });

  // MULTIPLE IMAGE PREVIEW
  const imgInput = document.getElementById("post-img");
  imgInput.addEventListener("change", (e) => {
    const files = Array.from(e.target.files);
    const container = document.getElementById("image-preview");
    container.innerHTML = "";
    if (files.length > 0) {
      container.style.display = "block";
      document.getElementById("video-preview").style.display = "none";
      document.getElementById("preview-section").style.display = "block";
      files.forEach((file, index) => {
        if (file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = (ev) => {
            container.insertAdjacentHTML("beforeend", `
              <div class="position-relative d-inline-block me-2 mb-2">
                <img src="${ev.target.result}" style="height:100px;width:auto" class="rounded">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="removeImage(${index})">&times;</button>
              </div>
            `);
          };
          reader.readAsDataURL(file);
        }
      });
    }
  });

  // VIDEO PREVIEW
  const vidInput = document.getElementById("post-vid");
  vidInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file && file.type.startsWith("video/")) {
      const url = URL.createObjectURL(file);
      document.getElementById("preview-video").src = url;
      document.getElementById("video-preview").style.display = "block";
      document.getElementById("image-preview").style.display = "none";
      document.getElementById("preview-section").style.display = "block";
    }
  });
});

// REMOVE SELECTED IMAGE
function removeImage(index) {
  const input = document.getElementById("post-img");
  const dt = new DataTransfer();
  const files = Array.from(input.files);
  files.splice(index, 1);
  files.forEach(f => dt.items.add(f));
  input.files = dt.files;
  input.dispatchEvent(new Event("change"));
}

// TOGGLE POLL SECTION
function togglePollSection() {
  const poll = document.getElementById("poll-section");
  const hasPoll = document.getElementById("has_poll");
  if (poll.style.display === "none" || poll.style.display === "") {
    poll.style.display = "block";
    hasPoll.value = "1";
    if (document.querySelectorAll("#poll-options .poll-option").length === 0) {
      document.getElementById("add-poll-option").click();
      document.getElementById("add-poll-option").click();
    }
  } else {
    poll.style.display = "none";
    hasPoll.value = "0";
    document.getElementById("poll-options").innerHTML = "";
  }
}
</script>


<style>
    .modal-content {
        border: none;
        overflow: hidden;
    }
    
    .form-control, .form-control:focus {
        box-shadow: none;
        background-color: #f8f9fa;
    }
    
    .form-floating label {
        color: #6c757d;
        font-weight: 500;
    }
    
    .form-control:focus + label {
        color: #0d6efd;
    }
    
    .btn-light {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }
    
    .btn-light:hover {
        background-color: #e9ecef;
        border-color: #e9ecef;
    }
    
    .progress {
        border-radius: 3px;
    }
    
    .rounded-4 {
        border-radius: 1rem !important;
    }
    
    .material-icons.md-20 {
        font-size: 20px;
    }
    
    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
    
    .border-light {
        border-color: #f1f3f5 !important;
    }
    
    .cursor-pointer {
        cursor: pointer;
    }
    
    #poll-options .form-control {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
    
    #poll-options .remove-option {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }
    
    #preview-video {
        aspect-ratio: 16/9;
    }
    
    /* Fix for Material Icons if CDN fails */
    .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
    }
</style>
<!-- Sign In Modal -->
<div class="modal fade" id="signModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content rounded-4 p-4 border-0">
			<div class="modal-header border-0 p-1">
				<!-- <h6 class="modal-title fw-bold text-body fs-6" id="exampleModalLabel">Choose Language</h6> -->
				<h6 class="modal-title fw-bold text-body fs-6" id="exampleModalLabel">Login</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-0">
				<form action="<?= base_url('index.php/action/login_phone') ?>" method="post">
					<div class="mt-5 login-register" id="number">
						<h6 class="fw-bold mx-1 mb-2 text-dark">Register your Mobile Number</h6>

						<div class="row mx-0 mb-3">
							<div class="col-4 p-1">
								<div class="form-floating">
									<select class="form-select rounded-5" name="country_code" id="floatingSelect" aria-label="Floating label select example">
										<option selected="">+91</option>
									</select>
									<label for="floatingSelect">Code</label>
								</div>
							</div>
							<div class="col-8 p-1">
								<div class="form-floating d-flex align-items-end">
									<input type="text" name="phone" class="form-control rounded-5"
										id="floatingName" value="" placeholder="Enter Mobile Number"
										maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
									<label for="floatingName">Enter Mobile Number</label>
								</div>
							</div>
						</div>
						<div class="p-1">
							<button type="submit" class="btn btn-primary w-100 text-decoration-none rounded-5 py-3 fw-bold text-uppercase m-0">Send OTP</button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Language Modal -->
<div class="modal fade" id="languageModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content border-0 rounded-4 p-4">
			<div class="modal-header border-0 p-1">
				<h6 class="modal-title fw-bold text-body fs-6 d-flex justify-content-center" id="exampleModalLabel1">Choose Language</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form>
				<div class="modal-body pt-0 px-0">
					<div class="row py-3 gy-3 m-0">
						<!-- Langauge Item -->
						<div class="langauge-item col-6 col-md-3 px-1 mt-2">
							<input type="radio" class="btn-check" name="options-outlined" id="hindi1">
							<label class="btn btn-language btn-sm px-2 py-2 rounded-5 d-flex align-items-center justify-content-between" for="hindi1">
								<span class="text-start d-grid">
									<small class="ln-18">हिंदी</small>
									<small class="ln-18">Hindi</small>
								</span>
								<span class="material-icons text-muted md-20">check_circle</span>
							</label>
						</div>
						<!-- Langauge Item -->
						<div class="langauge-item col-6 col-md-3 px-1 mt-2">
							<input type="radio" class="btn-check" name="options-outlined" id="english2" checked="">
							<label class="btn btn-language btn-sm px-2 py-2 rounded-5 d-flex align-items-center justify-content-between" for="english2">
								<span class="text-start d-grid">
									<small class="ln-18">English</small>
									<small class="ln-18">English</small>
								</span>
								<span class="material-icons text-muted md-20">check_circle</span>
							</label>
						</div>
						<!-- Langauge Item -->
						<div class="langauge-item col-6 col-md-3 px-1 mt-2">
							<input type="radio" class="btn-check" name="options-outlined" id="kannada3">
							<label class="btn btn-language btn-sm px-2 py-2 rounded-5 d-flex align-items-center justify-content-between" for="kannada3">
								<span class="text-start d-grid">
									<small class="ln-18">ಕನ್ನಡ</small>
									<small class="ln-18">kannada</small>
								</span>
								<span class="material-icons text-muted md-20">check_circle</span>
							</label>
						</div>
						<!-- Langauge Item -->
						<div class="langauge-item col-6 col-md-3 px-1 mt-2">
							<input type="radio" class="btn-check" name="options-outlined" id="tamil4">
							<label class="btn btn-language btn-sm px-2 py-2 rounded-5 d-flex align-items-center justify-content-between" for="tamil4">
								<span class="text-start d-grid">
									<small class="ln-18">தமிழ்</small>
									<small class="ln-18">Tamil</small>
								</span>
								<span class="material-icons text-muted md-20">check_circle</span>
							</label>
						</div>
						<!-- Langauge Item -->
						<div class="langauge-item col-6 col-md-3 px-1 mt-2">
							<input type="radio" class="btn-check" name="options-outlined" id="punjabi5">
							<label class="btn btn-language btn-sm px-2 py-2 rounded-5 d-flex align-items-center justify-content-between mb-2" for="punjabi5">
								<span class="text-start d-grid">
									<small class="ln-18">ਪੰਜਾਬੀ</small>
									<small class="ln-18">Punjabi</small>
								</span>
								<span class="material-icons text-muted md-20">check_circle</span>
							</label>
						</div>
						<!-- Langauge Item -->
						<div class="langauge-item col-6 col-md-3 px-1 mt-2">
							<input type="radio" class="btn-check" name="options-outlined" id="punjabi511f">
							<label class="btn btn-language btn-sm px-2 py-2 rounded-5 d-flex align-items-center justify-content-between mb-2" for="punjabi511f">
								<span class="text-start d-grid">
									<small class="ln-18">Türk</small>
									<small class="ln-18">Turkish</small>
								</span>
								<span class="material-icons text-muted md-20">check_circle</span>
							</label>
						</div>
						<!-- Langauge Item -->
						<div class="langauge-item col-6 col-md-3 px-1 mt-2">
							<input type="radio" class="btn-check" name="options-outlined" id="punjabi51f">
							<label class="btn btn-language btn-sm px-2 py-2 rounded-5 d-flex align-items-center justify-content-between mb-2" for="punjabi51f">
								<span class="text-start d-grid">
									<small class="ln-18">français</small>
									<small class="ln-18">French</small>
								</span>
								<span class="material-icons text-muted md-20">check_circle</span>
							</label>
						</div>
						<!-- Langauge Item -->
						<div class="langauge-item col-6 col-md-3 px-1 mt-2">
							<input type="radio" class="btn-check" name="options-outlined" id="other">
							<label class="btn btn-language btn-sm px-2 py-2 rounded-5 d-flex align-items-center justify-content-between mb-2" for="other">
								<span class="text-start d-grid">
									<small class="ln-18">Other</small>
									<small class="ln-18">Other</small>
								</span>
								<span class="material-icons text-muted md-20">check_circle</span>
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer border-0 p-1">
					<button type="button" class="btn btn-primary w-100 text-decoration-none rounded-5 py-3 fw-bold text-uppercase m-0" data-bs-dismiss="modal">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content rounded-4 overflow-hidden border-0">
			<div class="modal-header d-none">
				<h5 class="modal-title" id="exampleModalLabel2">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-0">
				<div class="row m-0">
					<div class="col-sm-7 px-0 m-sm-none">
						<!-- Image Slider -->
						<div class="image-slider">
							<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
								<div class="carousel-indicators">
									<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
									<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
									<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
								</div>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img src="<?= base_url('assets/theme/v1/') ?>img/post-img1.jpg" class="d-block w-100" alt="...">
									</div>
									<div class="carousel-item">
										<img src="<?= base_url('assets/theme/v1/') ?>img/post-img2.jpg" class="d-block w-100" alt="...">
									</div>
									<div class="carousel-item">
										<img src="<?= base_url('assets/theme/v1/') ?>img/post-img3.jpg" class="d-block w-100" alt="...">
									</div>
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div>
						</div>
					</div>
					<div class="col-sm-5 content-body px-web-0">
						<div class="d-flex flex-column h-600">
							<div class="d-flex p-3 border-bottom">
								<img src="<?= base_url('assets/theme/v1/') ?>img/rmate4.jpg" class="img-fluid rounded-circle user-img" alt="profile-img">
								<div class="d-flex align-items-center justify-content-between w-100">
									<a href="profile.html" class="text-decoration-none ms-3">
										<div class="d-flex align-items-center">
											<h6 class="fw-bold text-body mb-0">iamosahan</h6>
											<p class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon mb-0">done</p>
										</div>
										<p class="text-muted mb-0 small">@johnsmith</p>
									</a>
									<div class="small dropdown">
										<a href="#" class="text-muted text-decoration-none material-icons ms-2 md-" data-bs-dismiss="modal">close</a>
									</div>
								</div>
							</div>
							<div class="comments p-3">
								<div class="d-flex mb-2">
									<img src="<?= base_url('assets/theme/v1/') ?>img/rmate1.jpg" class="img-fluid rounded-circle" alt="profile-img">
									<div class="ms-2 small">
										<div class="bg-light px-3 py-2 rounded-4 mb-1 chat-text">
											<p class="fw-500 mb-0">Macie Bellis</p>
											<span class="text-muted">Consectetur adipisicing elit.</span>
										</div>
										<div class="d-flex align-items-center ms-2">
											<a href="#" class="small text-muted text-decoration-none">Like</a>
											<span class="fs-3 text-muted material-icons mx-1">circle</span>
											<a href="#" class="small text-muted text-decoration-none">Reply</a>
											<span class="fs-3 text-muted material-icons mx-1">circle</span>
											<span class="small text-muted">1h</span>
										</div>
									</div>
								</div>
								<div class="d-flex mb-2">
									<img src="<?= base_url('assets/theme/v1/') ?>img/rmate3.jpg" class="img-fluid rounded-circle" alt="profile-img">
									<div class="ms-2 small">
										<div class="bg-light px-3 py-2 rounded-4 mb-1 chat-text">
											<p class="fw-500 mb-0">John Smith</p>
											<span class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</span>
										</div>
										<div class="d-flex align-items-center ms-2">
											<a href="#" class="small text-muted text-decoration-none">Like</a>
											<span class="fs-3 text-muted material-icons mx-1">circle</span>
											<a href="#" class="small text-muted text-decoration-none">Reply</a>
											<span class="fs-3 text-muted material-icons mx-1">circle</span>
											<span class="small text-muted">20min</span>
										</div>
									</div>
								</div>
								<div class="d-flex mb-2">
									<img src="<?= base_url('assets/theme/v1/') ?>img/rmate2.jpg" class="img-fluid rounded-circle" alt="profile-img">
									<div class="ms-2 small">
										<div class="bg-light px-3 py-2 rounded-4 mb-1 chat-text">
											<p class="fw-500 mb-0">Shay Jordon</p>
											<span class="text-muted">With our vastly improved notifications system, users have more control.</span>
										</div>
										<div class="d-flex align-items-center ms-2">
											<a href="#" class="small text-muted text-decoration-none">Like</a>
											<span class="fs-3 text-muted material-icons mx-1">circle</span>
											<a href="#" class="small text-muted text-decoration-none">Reply</a>
											<span class="fs-3 text-muted material-icons mx-1">circle</span>
											<span class="small text-muted">10min</span>
										</div>
									</div>
								</div>
							</div>
							<div class="border-top p-3 mt-auto">
								<!--<div class="d-flex align-items-center justify-content-between mb-2">-->
								<!--	<div>-->
        <!--            					<a href="javascript:void(0)" class="noload text-decoration-none like-btn <?= has_liked_post($post['p_id'], @$_SESSION['yid']) ? 'text-primary' : 'text-muted'; ?> like-btn-count<?= $post['p_id'] ?>" data-id="<?= $post['p_id'] ?>">-->
        <!--            						<span class="material-icons md-20 me-2">thumb_up_off_alt</span>-->
        <!--            						<?= ($post['p_likes_count'] == 0) ? '' : $post['p_likes_count'] ?>-->
        <!--            					</a>-->
        <!--            				</div>-->
								<!--	<div>-->
        <!--            					<a href="javascript:void(0)" data-id="<?= $post['p_id'] ?>" class="repeat-btn <?= has_repeated_post($post['p_id'], @$_SESSION['yid']) ? 'text-success' : 'text-muted'; ?> noload text-decoration-none retweet-btn-<?= $post['p_id'] ?>">-->
        <!--            						<span class="material-icons md-20 me-2">repeat</span>-->
        <!--            						<?= ($post['p_share_count'] == 0) ? '' : $post['p_share_count'] ?>-->
        <!--            					</a>-->
        <!--            				</div>-->
    				<!--				<div>-->
        <!--                              <a href="javascript:void(0)" class="text-muted text-decoration-none noload" data-bs-toggle="modal" data-bs-target="#shareModal">-->
        <!--                                <span class="material-icons md-18 me-2">share</span>Share-->
        <!--                              </a>-->
        <!--                            </div>-->
								<!--</div>-->
								<div class="d-flex align-items-center">
									<span class="material-icons bg-white border-0 text-primary pe-2 md-36">account_circle</span>
									<div class="d-flex align-items-center border rounded-4 px-3 py-1 w-100">
										<input type="text" class="form-control form-control-sm p-0 rounded-3 fw-light border-0" placeholder="Write Your comment">
										<a href="#" class="bg-white border-0 text-primary ps-2 text-decoration-none">Post</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer d-none">
			</div>
		</div>
	</div>
</div>
<!-- Loader JS -->
<script>
	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("mobile-loader").style.display = "none";
	});
</script>

<!-- COMMENT JS STARTS -->
<style>
	.comment-input.border-danger {
		border: 1px solid red !important;
		box-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
	}
</style>
<script>
	// $(document).ready(function() {
	function loadComments(post_id) {
		$.ajax({
			url: "<?= base_url('main/get_comments/') ?>" + post_id,
			type: "GET",
			dataType: "json",
			success: function(response) {
				var commentsHtml = "";
				if (response.length > 0) {
					$.each(response, function(index, comment) {
						let photoPath = comment.photo ?
							"<?= base_url('assets/mem/') ?>" + comment.mid + "/img/" + comment.photo :
							"<?= base_url('assets/theme/v1/img/default-profile.png') ?>";

						commentsHtml += `
                            <div class="d-flex mb-2">
                                <img src="${photoPath}" class="img-fluid rounded-circle" alt="profile-img">
                                <div class="ms-2 small w-100">
                                    <div class="bg-light px-3 py-2 rounded-4 mb-1 chat-text">
                                        <p class="fw-500 mb-0">${comment.name}</p>
                                        <span class="text-muted">${comment.c_comment_text}</span>
                                    </div>
                                    <div class="d-flex align-items-center ms-2">
                                        <a href="#" class="small text-muted text-decoration-none d-none">Like</a>
                                        <span class="fs-3 text-muted material-icons mx-1 d-none">circle</span>
                                        <a href="#" class="small text-muted text-decoration-none d-none">Reply</a>
                                        <span class="fs-3 text-muted material-icons mx-1 d-none">circle</span>
                                        <span class="small text-muted">${comment.c_created_at}</span>
                                    </div>
                                </div>
                            </div>
                        `;
					});
				} else {
					commentsHtml = `<p class="text-muted">No comments yet.</p>`;
				}
				$("#comments-" + post_id).html(commentsHtml);
			},
			error: function(xhr, status, error) {

			}
		});
	}

	// Load comments for all posts when the page loads
	$(".comments").each(function() {
		var post_id = $(this).attr("id").split("-")[1];
		loadComments(post_id);
	});

	// Attach event using $(document).on to handle dynamically added forms
	$(document).on("submit", "#comment-form", function(e) {
		e.preventDefault(); // Prevent default form submission



		var form = $(this);
		var post_id = form.find("input[name='post_id']").val();
		var commentInput = form.find("input[name='comment-text']");
		var commentText = commentInput.val().trim();
		var commentsSection = $("#comments-" + post_id);
		var errorMessage = form.find(".comment-div");

		if (commentText === "") {

			errorMessage.addClass("border border-danger");
			commentInput.addClass("border border-danger");
			return false; // Stop form submission
		} else {

			errorMessage.removeClass("border border-danger");
			commentInput.removeClass("border border-danger");
		}

		// Check if AJAX is firing


		$.ajax({
			url: "<?= base_url('main/add_comment') ?>",
			type: "POST",
			data: {
				post_id: post_id,
				comment_text: commentText,
			},
			dataType: "json",
			success: function(response) {

				if (response.status === "success") {
					getupdate_now(post_id);

					let userPhoto = response.user_photo ?
						"<?= base_url('assets/mem/') ?>" + response.user_mid + "/img/" + response.user_photo :
						"<?= base_url('assets/theme/v1/img/default-profile.png') ?>";

					var newComment = `
                    <div class="d-flex mb-2">
                        <img src="${userPhoto}" class="img-fluid rounded-circle" alt="profile-img">
                        <div class="ms-2 small">
                            <div class="bg-light px-3 py-2 rounded-4 mb-1 chat-text">
                                <p class="fw-500 mb-0">${response.name}</p>
                                <span class="text-muted">${response.comment_text}</span>
                            </div>
                            <div class="d-flex align-items-center ms-2">
                                <a href="#" class="small text-muted text-decoration-none">Like</a>
                                <span class="fs-3 text-muted material-icons mx-1">circle</span>
                                <a href="#" class="small text-muted text-decoration-none">Reply</a>
                                <span class="fs-3 text-muted material-icons mx-1">circle</span>
                                <span class="small text-muted">Just now</span>
                            </div>
                        </div>
                    </div>`;

					commentsSection.append(newComment);
					commentInput.val(""); // Clear input
				} else {

					alert(response.message);
				}
			},
			error: function(xhr, status, error) {

			},
		});
	});
	// });
</script>
<!-- COMMENT JS ENDS -->

<script>
	function openModal(postId) {
		var userId = "<?= $this->session->userdata('yid') ?>"; // Get user ID from session

		if (userId) {
			var modalId = "#commentModal" + postId;
			$(modalId).modal('show');
		} else {
			// If user is not logged in, redirect to login page
			window.location.href = "<?= base_url('login') ?>";
		}
	}
</script>
<!-- Likes and Repeat Script -->
<script>
	$(".like-btn").click(function(e) {
		e.preventDefault();
		var post_id = $(this).attr("data-id");
		var likeBtn = $(this);
		$.ajax({
			url: "<?= base_url('main/toggle_like') ?>",
			type: "POST",
			data: {
				post_id: post_id
			},
			dataType: "json",
			success: function(response) {
				if (response.status === "liked") {
					likeBtn.addClass("text-primary").removeClass("text-muted");
					$('.like-btn-count' + post_id).load(document.URL + " .like-btn-count" + post_id);
				} else if (response.status === "unliked") {
					likeBtn.addClass("text-muted").removeClass("text-primary");
					$('.like-btn-count' + post_id).load(document.URL + " .like-btn-count" + post_id);
				}
			},
			error: function(xhr, status, error) {
				console.error("AJAX Error:", xhr.responseText);
			}
		});
	});

	$(".repeat-btn").click(function(e) {
		e.preventDefault();
		var post_id = $(this).attr("data-id");
		var repeatBtn = $(this);


		$.ajax({
			url: "<?= base_url('main/toggle_repeat') ?>",
			type: "POST",
			data: {
				post_id: post_id
			},
			dataType: "json",
			success: function(response) {
				if (response.status === "repeated") {
					repeatBtn.addClass("text-success").removeClass("text-muted");
					location.reload();
					// $('#feed').load(document.URL + " #feed");
				} else if (response.status === "unrepeated") {
					repeatBtn.addClass("text-muted").removeClass("text-success");
					location.reload();
					// $('#feed').load(document.URL + " #feed");
				}
			}
		});
	});
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		document.querySelectorAll(".post-item").forEach(function(post) {
			post.addEventListener("click", function() {
				let postId = this.getAttribute("data-id");
				let content = this.getAttribute("data-content");
				let image = this.getAttribute("data-image");
				let username = this.getAttribute("data-username");
				let name = this.getAttribute("data-name");
				let userImg = this.getAttribute("data-userimg");

				// Update modal content
				document.querySelector("#commentModal .modal-body .comments").innerHTML = `<p>${content}</p>`;

				// Update user info
				document.querySelector("#commentModal .modal-body .user-img").src = userImg;
				document.querySelector("#commentModal .modal-body h6").textContent = name;
				document.querySelector("#commentModal .modal-body .text-muted").textContent = '@' + username;

				// Update post image
				let imgContainer = document.querySelector("#commentModal .modal-body .image-slider .carousel-inner");
				imgContainer.innerHTML = `<div class="carousel-item active"><img src="${image}" class="d-block w-100" alt="Post Image"></div>`;

				// Show modal
				let commentModal = new bootstrap.Modal(document.getElementById('commentModal'));
				commentModal.show();
			});
		});
	});
</script>
<!--scroll bottom to top button end-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php get_codes('footer', '1'); ?>
<script>
	$(document).ready(function() {
		$(".follow-toggle").change(function(event) {
			let userId = $(this).data("user-id");
			let isChecked = $(this).prop("checked");
			let buttonLabel = $(this).next("label");

			// check if user online (session yid)
			let yid = "<?= isset($_SESSION['yid']) ? $_SESSION['yid'] : '' ?>";

			if (!yid) {
				event.preventDefault();
				$(this).prop("checked", !isChecked);
				window.location.href = "<?= base_url('login') ?>"; // send t0 logim page
				return;
			}

			$.ajax({
				url: "<?= base_url('action/user_favourite_me') ?>",
				type: "POST",
				data: {
					itemID: userId
				},
				dataType: "json",
				success: function(response) {
					if (response.status === "followed") {
						buttonLabel.find(".follow").addClass("d-none");
						buttonLabel.find(".following").removeClass("d-none");
						$('#followers').load(document.URL + " #followers");
					} else {
						buttonLabel.find(".follow").removeClass("d-none");
						buttonLabel.find(".following").addClass("d-none");
						$('#followers').load(document.URL + " #followers");
					}
				},
				error: function() {
					alert("Something went wrong. Please try again.");
				}
			});
		});
	});
</script>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		let textarea = document.getElementById("postText");
		let wordCountDisplay = document.getElementById("wordCount");
		let submitButton = document.querySelector("button[type='submit']");
		let maxChars = 500;

		textarea.addEventListener("input", function() {
			let charCount = this.value.length;

			// Update the display
			wordCountDisplay.textContent = `${charCount}/${maxChars}`;

			if (charCount > maxChars) {
				this.value = this.value.substring(0, maxChars); // Trim excess characters
				wordCountDisplay.textContent = `${maxChars}/${maxChars}`;
			}

			// Add 'text-danger' if max limit is exceeded
			if (charCount >= maxChars) {
				wordCountDisplay.classList.add("text-danger");
				submitButton.disabled = true; // Disable submit button
			} else {
				wordCountDisplay.classList.remove("text-danger");
				submitButton.disabled = false; // Enable submit button
			}
		});
	});
</script>


<!-- YNAPS JS FUNCTIONS START -->
<script type="text/javascript">
	function load_new_states(obj) {
		var thecountry = $(obj).children("option:selected").val();
		$("#get_state_data").load("<?= base_url("ynaps_load/load_state?country=") ?>" + thecountry);
	}

	function load_new_citys(obj) {
		var thestate = $(obj).children("option:selected").val();
		$("#get_cities_data").load("<?= base_url("ynaps_load/load_city?state=") ?>" + thestate);
	}

	function load_new_areas(obj) {
		var thestate = document.getElementById("state").value;
		var thecity = $(obj).children("option:selected").val();
		$("#get_area_data").load("<?= base_url("ynaps_load/load_area?state=") ?>" + thestate + "&city=" + thecity);
	}

	function getSelCitys(obj) {
		var thecity = $(obj).children("option:selected").val();
		var citySelect = document.getElementById("getCity");
		var selectedCity = citySelect.options[citySelect.selectedIndex].text;
		document.getElementById("selcity_name").value = selectedCity;
		document.getElementById("city_frm").submit();
	}

	function load_subcats(obj) {
		var thecat = $(obj).children("option:selected").val();
		$("#get_subcat_data").load("<?= base_url("ynaps_load/load_subcat?cat=") ?>" + thecat);
	}

	function show_hides(show_d, hide_d) {
		$("." + hide_d).fadeOut();
		$("." + show_d).fadeIn();
	}
</script>
<!-- YNAPS JS FUNCTIONS ENDS -->


</body>

</html>