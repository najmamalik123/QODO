<?php get_codes('header', $meta_array); ?>
<style>
	.content h1,
	.content h2,
	.content h3,
	.content h4,
	.content h5,
	.content h6,
	.content p,
	.content ul,
	.content li {
		color: #000;
	}

	.content h2,
	.content h4 {
		font-size: 20px !important
	}

	.content h3,
	.content h5 {
		font-size: 16px !important
	}

	.themains_s90s {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(255, 255, 255, 0.8);
		z-index: 9999;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.themains_s90s .spinner {
		width: 50px;
		height: 50px;
		border: 4px solid #ccc;
		border-top: 4px solid #007bff;
		border-radius: 50%;
		animation: spin 1s linear infinite;
	}
	
	.container-fluid {
	 max-width:1200px;   
	}

	@keyframes spin {
		from {
			transform: rotate(0deg);
		}

		to {
			transform: rotate(360deg);
		}
	}

	@media (max-width: 1200px) {
		img.img-fluid.logo-mobile {
			height: 40px !important;
		}
	}

	@media (max-width: 992px) {
		img.img-fluid.logo-mobile {
			height: 40px !important;
		}
	}

	.sidebar-nav .navbar-nav a {
		display: flex;
		align-items: center;
		text-transform: capitalize;
		font-size: 14px;
		letter-spacing: 1px;
		font-weight: 800;
		color: #282828;
		padding: 3px 16px !important;
		/* border-radius: 11px; */
		/* background: #edf2f6; */
		margin-bottom: 2px;
	}
</style>

<!-- <div class="theme-switch-wrapper ms-3">
	<label class="theme-switch" for="checkbox">
		<input type="checkbox" id="checkbox">
		<span class="slider round"></span>
		<i class="icofont-ui-brightness"></i>
	</label>
	<em>Enable Dark Mode!</em>
</div> -->

<!-- <div class="themain_leoafers d-sm-none" id="theloader_90" onclick="setTimeout(function() { $('#theloader_90').hide(); }, 2000);">
	<div class="themains_s90s">
		<div class="spinner"></div>
	</div>
</div> -->

<div class="themain_leoafers d-sm-none" id="theloader_90" onclick="setTimeout(function() { $('#theloader_90').hide(); }, 2000);">
	<div class="p-3 bg-white themains_s90s theshadows">
		<!-- <img src="<?= base_url('assets/avator/preloader.gif') ?>"> -->
		<div class="spinner"></div>
	</div>
</div>

<div class="web-none d-flex align-items-center px-3 pt-3 mobile-header sticky-top">
	<a href="<?= base_url('home') ?>" class="text-decoration-none">
		<img src="<?= base_url('assets/avator/logo.png') ?>" class="img-fluid logo-mobile" alt="brand-logo">
	</a>
	<button class="ms-auto btn btn-primary ln-0" ype="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
		<span class="material-icons">menu</span>
	</button>
	<?php if (isset($_SESSION['yid'])) { ?>
					<div class="dropdown ms-3 position-relative">
						<button class="btn btn-light border-0 rounded-circle" id="menuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fa-solid fa-bell fa-lg"></i>
						</button>
						<ul class="dropdown-menu dropdown-menu-end shadow p-2" aria-labelledby="menuDropdown" style="min-width: 250px;">
							 <!--<li><a class="dropdown-item <?= $last_segment == 'explore' ? 'active' : '' ?>" href="<?= base_url('explore') ?>"><span class="material-icons me-2">location_city</span>Articles & News</a></li> -->
							 	<?php
                        			$all_blogs = $this->db->query("SELECT * FROM yn_site_blogs ORDER BY blog_id DESC LIMIT 5")->result_array();
                        			if (!empty($all_blogs)) { ?>
                        				<?php foreach ($all_blogs as $news) { // Show only 4 trending news 
                        				?>
                        					<!-- Trending News Item -->
                        					<a href="<?= base_url('blog') ?>/<?= $news['slug'] ?>" target="_blank" class="p-3 border-bottom d-flex align-items-center text-dark text-decoration-none">
                        						<!--<img src="<?= base_url('assets/avator/upload/') . $news['blog_img'] ?>" class="img-fluid rounded-1" alt="news-img" style="width: 70px; height: 60px; object-fit: cover; margin-right:5px;">-->
                        						<div>
                        							<div class="text-muted fw-light d-flex align-items-center">
                        								<small style="    font-size: 8px;margin-left: 10px;"><?= date_format_1($news['blog_time'], 'alpha_date') ?></small><span class="mx-1 material-icons md-3">circle</span>
                        							</div>
                        							<p class="fw-bold mb-0 pe-3" style="  font-size: 9px;margin-left: 10px;"><?= htmlspecialchars($news['title']) ?></p>
                        							<!--<small class="text-muted" style="    font-size: 9px;"><?= strip_tags(trim_text($news['comment'], '100', '...')) ?></small><br>-->
                        						</div>
                        
                        					</a>
                        				<?php } ?>
                        			<?php } else { ?>
                        				<p class="p-3 text-muted">No trending blogs available.</p>
                        			<?php } ?>

						</ul>
					</div>
				<?php } ?>
</div>

<style>
	.navbar-brand {
		font-weight: bold;
		color: #5A1D32;
		/* Dark red color */
	}

	.navbar-brand span {
		color: lightgray;
		/* Light color for faded "X" */
	}

	.search-container {
		width: 250px;
	}

	.btn-login {
		border: 1px solid #5A1D32;
		color: #5A1D32;
		background: white;
	}

	.btn-login:hover {
		background: #5A1D32;
		color: white;
	}

	.btn-membership {
		background-color: #5A1D32;
		color: white;
	}

	.btn-membership:hover {
		background-color: #771F3F;
	}

	.nav-link.active {
		border-bottom: 2px solid #771F3F !important;
		/* Bootstrap primary */
		background: none;
		border: none;
	}

	.nav-link:hover {
		border: none;
	}
</style>
<style>
	.dropdown .btn {
		width: 40px;
		height: 40px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.dropdown-menu {
		min-width: 200px;
		font-size: 14px;
	}
</style>

<?php
$this->load->helper('url');
$total_segments = $this->uri->total_segments();
$second_to_last_segment = $this->uri->segment($total_segments - 1);
$activePage = $this->uri->segment($total_segments);
?>
<nav class="navbar navbar-expand-lg bg-white shadow-sm d-none d-lg-block sticky-top">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url('home') ?>"><img src="<?= base_url('assets/avator/logo.png') ?>" style="height: 60px;" class="img-fluid logo" alt="brand-logo"></a>


		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav d-flex flex-row justify-content-between w-100 text-center nav-tabs border-0" style="max-width: 600px; margin: auto;">
				<li class="nav-item flex-fill">
					<a class="nav-link py-2 <?= ($activePage == 'home') ? 'active' : '' ?>" href="<?= base_url('home') ?>">
						<i class="fa-solid fa-house d-block mb-1 <?= ($activePage == 'home') ? 'text-primary' : 'text-muted' ?>"></i>
						<span class="fw-semibold <?= ($activePage == 'home') ? 'text-primary' : 'text-dark' ?>">Home</span>
					</a>
				</li>
				<!-- <li class="nav-item flex-fill">
					<a class="nav-link py-2 <?= ($activePage == 'developers') ? 'active' : '' ?>" href="<?= base_url('developers') ?>">
						<i class="fas fa-flag d-block mb-1 <?= ($activePage == 'developers') ? 'text-primary' : 'text-muted' ?>"></i>
						<span class="fw-semibold <?= ($activePage == 'developers') ? 'text-primary' : 'text-dark' ?>">Developers</span>
					</a>
				</li> -->
				<li class="nav-item flex-fill">
					<a class="nav-link py-2 <?= ($activePage == 'properties') ? 'active' : '' ?>" href="<?= base_url('properties') ?>">
						<i class="fas fa-chart-bar d-block mb-1 <?= ($activePage == 'properties') ? 'text-primary' : 'text-muted' ?>"></i>
						<span class="fw-semibold <?= ($activePage == 'properties') ? 'text-primary' : 'text-dark' ?>">Properties</span>
					</a>
				</li>
				<li class="nav-item flex-fill">
					<a class="nav-link py-2 <?= ($activePage == 'news') ? 'active' : '' ?>" href="<?= base_url('explore') ?>">
						<i class="fa-solid fa-newspaper d-block mb-1 <?= ($activePage == 'news') ? 'text-primary' : 'text-muted' ?>"></i>
						<span class="fw-semibold <?= ($activePage == 'news') ? 'text-primary' : 'text-dark' ?>">Articles/News</span>
					</a>
				</li>
				<li class="nav-item flex-fill">
					<a class="nav-link py-2 <?= ($activePage == 'videos') ? 'active' : '' ?>" href="<?= base_url('videos') ?>">
						<i class="fas fa-play-circle d-block mb-1 <?= ($activePage == 'videos') ? 'text-primary' : 'text-muted' ?>"></i>
						<span class="fw-semibold <?= ($activePage == 'videos') ? 'text-primary' : 'text-dark' ?>">Videos</span>
					</a>
				</li>
				<li class="nav-item flex-fill">
					<a class="nav-link py-2 <?= ($activePage == 'calculator') ? 'active' : '' ?>" href="<?= base_url('calculator') ?>">
						<i class="fa-solid fa-calculator d-block mb-1 <?= ($activePage == 'calculator') ? 'text-primary' : 'text-muted' ?>"></i>
						<span class="fw-semibold <?= ($activePage == 'calculator') ? 'text-primary' : 'text-dark' ?>">Tools</span>
					</a>
				</li>
			</ul>


			<!-- Search Bar -->
			<div class="ms-auto d-flex align-items-center">
				<!-- <div class="input-group mb-4 shadow-sm rounded-4 overflow-hidden py-2 bg-white" onclick="window.location.href='<?= base_url('search') ?>'">
					<span class="input-group-text material-icons border-0 bg-white text-primary readonly">search</span>
					<input type="text" class="form-control border-0 fw-light ps-1" placeholder="Search <?= $site_name ?>">
				</div> -->

				<!-- <div class="search-container me-3">
					<input type="text" class="form-control" placeholder="Search...">
				</div> -->




				<!-- Buttons -->
				<?php if (isset($_SESSION['yid'])) {
					$yid = $_SESSION['yid'];
					$user = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
				?>
					<a href="javascript:void(0)" class="btn btn-login mx-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#postModal">Post +</a>
					<?php if ($user['user_plan'] == '') { ?>

						<a href="<?= base_url('membership') ?>" class="btn btn-membership rounded-pill">Join Membership</a>
					<?php } ?>
				<?php } else { ?>
					<a href="<?= base_url('login') ?>" class="btn btn-login mx-2 rounded-pill">Log in</a>
					<a href="<?= base_url('membership') ?>" class="btn btn-membership rounded-pill">Join Membership X</a>
				<?php } ?>

				<div class="dropdown ms-3 position-relative">
					<button class="btn btn-light border-0 rounded-circle" id="menuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa-solid fa-bars fa-lg"></i>
					</button>
					<ul class="dropdown-menu dropdown-menu-end shadow p-2" aria-labelledby="menuDropdown" style="min-width: 250px;">
						<li><a class="dropdown-item <?= $last_segment == 'explore' ? 'active' : '' ?>" href="<?= base_url('explore') ?>"><span class="material-icons me-2">location_city</span>Articles & News</a></li>
						<li><a class="dropdown-item <?= $last_segment == 'properties' ? 'active' : '' ?>" href="<?= base_url('properties') ?>"><span class="material-icons me-2">real_estate_agent</span>Explore Properties</a></li>
						<li><a class="dropdown-item <?= $last_segment == 'hot-investments' ? 'active' : '' ?>" href="<?= base_url('hot-investments') ?>"><span class="material-icons me-2">domain</span>Hot Investments</a></li>
						<li><a class="dropdown-item <?= $last_segment == 'calculator' ? 'active' : '' ?>" href="<?= base_url('calculator') ?>"><i class="fa-solid fa-calculator me-2"></i>Tools & Calculators</a></li>
						<li><a class="dropdown-item <?= $last_segment == 'message' ? 'active' : '' ?>" href="<?= base_url('message') ?>"><span class="material-icons me-2">explore</span>Messages</a></li>
						<li><a class="dropdown-item <?= $last_segment == 'faq' ? 'active' : '' ?>" href="<?= base_url('faq') ?>"><span class="material-icons me-2">question_answer</span>Foreign Investments</a></li>

						<?php if (isset($_SESSION['yid'])) { ?>
							<li><a class="dropdown-item <?= $last_segment == 'my-property' ? 'active' : '' ?>" href="<?= base_url('my-property') ?>"><i class="fa-solid fa-house-user me-2"></i>My Properties</a></li>
							<li><a class="dropdown-item <?= $last_segment == 'profile' ? 'active' : '' ?>" href="<?= base_url('profile') ?>"><span class="material-icons me-2">account_circle</span>Profile</a></li>
							<li><a class="dropdown-item <?= $last_segment == 'edit' ? 'active' : '' ?>" href="<?= base_url('edit') ?>"><span class="material-icons me-2">manage_accounts</span>Edit Profile</a></li>
							<li><a class="dropdown-item" href="<?= base_url('logout') ?>"><span class="material-icons me-2">logout</span>Logout</a></li>
						<?php } ?>
					</ul>
				</div>
				<?php if (isset($_SESSION['yid'])) { ?>
					<div class="dropdown ms-3 position-relative">
						<button class="btn btn-light border-0 rounded-circle" id="menuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fa-solid fa-bell fa-lg"></i>
						</button>
						<ul class="dropdown-menu dropdown-menu-end shadow p-2" aria-labelledby="menuDropdown" style="min-width: 250px;">
							 <!--<li><a class="dropdown-item <?= $last_segment == 'explore' ? 'active' : '' ?>" href="<?= base_url('explore') ?>"><span class="material-icons me-2">location_city</span>Articles & News</a></li> -->
							 	<?php
                        			$all_blogs = $this->db->query("SELECT * FROM yn_site_blogs ORDER BY blog_id DESC LIMIT 5")->result_array();
                        			if (!empty($all_blogs)) { ?>
                        				<?php foreach ($all_blogs as $news) { // Show only 4 trending news 
                        				?>
                        					<!-- Trending News Item -->
                        					<a href="<?= base_url('blog') ?>/<?= $news['slug'] ?>" target="_blank" class="p-3 border-bottom d-flex align-items-center text-dark text-decoration-none">
                        						<!--<img src="<?= base_url('assets/avator/upload/') . $news['blog_img'] ?>" class="img-fluid rounded-1" alt="news-img" style="width: 70px; height: 60px; object-fit: cover; margin-right:5px;">-->
                        						<div>
                        							<div class="text-muted fw-light d-flex align-items-center">
                        								<small style="    font-size: 8px;margin-left: 10px;"><?= date_format_1($news['blog_time'], 'alpha_date') ?></small><span class="mx-1 material-icons md-3">circle</span>
                        							</div>
                        							<p class="fw-bold mb-0 pe-3" style="  font-size: 9px;margin-left: 10px;"><?= htmlspecialchars($news['title']) ?></p>
                        							<!--<small class="text-muted" style="    font-size: 9px;"><?= strip_tags(trim_text($news['comment'], '100', '...')) ?></small><br>-->
                        						</div>
                        
                        					</a>
                        				<?php } ?>
                        			<?php } else { ?>
                        				<p class="p-3 text-muted">No trending blogs available.</p>
                        			<?php } ?>

						</ul>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
</nav>