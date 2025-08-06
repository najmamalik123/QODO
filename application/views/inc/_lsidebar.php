<?php
$this->load->helper('url');
$total_segments = $this->uri->total_segments();
$second_to_last_segment = $this->uri->segment($total_segments - 1);
$last_segment = $this->uri->segment($total_segments);
?>
<aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
	<!-- <div class="p-2 bg-light offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"> -->
	<div class="p-2 bg-light offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" data-bs-backdrop="false">
		<div class="sidebar-nav mb-3">
			<div class="pb-4">
				<a href="<?= base_url('home') ?>" class="text-decoration-none">
					<img src="<?= base_url('assets/avator/logo.png') ?>" class="img-fluid logo" alt="brand-logo">
				</a>
			</div>
			<ul class="navbar-nav p-2 justify-content-end flex-grow-1">
				<li class="nav-item px-2">
					<a href="<?= base_url('home') ?>" class="nav-link <?= $last_segment == '' ? 'active' : '' ?>"><span class="material-icons me-3">house</span> <span>Home</span></a>
				</li>
				<li class="nav-item px-2">
					<a href="<?= base_url('explore') ?>" class="nav-link <?= $last_segment == 'explore' ? 'active' : '' ?>"><span class="material-icons me-3">location_city</span><span>Articles & News</span></a>
				</li>
				<li class="nav-item px-2">
					<a href="<?= base_url('properties') ?>" class="nav-link <?= $last_segment == 'properties' ? 'active' : '' ?>"><span class="material-icons me-3">real_estate_agent</span> <span>Explore Properties</span></a>
				</li>
				<li class="nav-item px-2">
					<a href="<?= base_url('hot-investments') ?>" class="nav-link <?= $last_segment == 'hot-investments' ? 'active' : '' ?>"><span class="material-icons me-3">domain</span> <span>Hot Investments</span></a>
				</li>
				<!--<li class="nav-item px-2">-->
				<!--	<a href="<?= base_url('calculator') ?>" class="nav-link <?= $last_segment == 'calculator' ? 'active' : '' ?>"><i class="fa-solid fa-calculator me-3"></i> <span>Tools & Calculators</span></a>-->
				<!--</li>-->


				<li class="nav-item px-2">
					<a href="<?= base_url('message') ?>" class="nav-link <?= $last_segment == 'message' ? 'active' : '' ?>"><span class="material-icons me-3">explore</span> <span>Messages</span></a>
				</li>
				<li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'developers' ? 'active' : '' ?>" href="<?= base_url('developers') ?>"><span class="material-icons me-3">manage_accounts</span> <span>Developers</span></a></li>
			
				<!-- <li class="nav-item px-2">
					<a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#languageModal"><span class="material-icons me-3">translate</span> <span>Language</span></a>
				</li> -->
				<li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'foreign-investments' ? 'active' : '' ?>" href="<?= base_url('foreign-investments') ?>"><span class="material-icons me-3">question_answer</span> <span>Foreign Investments</span></a></li>
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
	<!-- Sidebar -->
	<div class="ps-0 m-none fix-sidebar">
		<div class="sidebar-nav mb-1">
			<!-- <div class="">
				<a href="<?= base_url('home') ?>" class="text-decoration-none">
					<img src="<?= base_url('assets/avator/logo.png') ?>" class="img-fluid logo" alt="brand-logo">
				</a>
			</div> -->
			<ul class="navbar-nav p-2 justify-content-end flex-grow-1 bg-white" style="border-radius: 11px;">
				<li class="nav-item px-2">
					<a href="<?= base_url('home') ?>" class="nav-link <?= $last_segment == '' ? 'active' : '' ?>"><span class="material-icons me-3">house</span> <span>Home</span></a>
				</li>
				<li class="nav-item px-2">
					<a href="<?= base_url('explore') ?>" class="nav-link <?= $last_segment == 'explore' ? 'active' : '' ?>"><span class="material-icons me-3">location_city</span><span>Articles & News</span></a>
				</li>
				<li class="nav-item px-2">
					<a href="<?= base_url('properties') ?>" class="nav-link <?= $last_segment == 'properties' ? 'active' : '' ?>"><span class="material-icons me-3">real_estate_agent</span> <span>Explore Properties</span></a>
				</li>
				<li class="nav-item px-2">
					<a href="<?= base_url('hot-investments') ?>" class="nav-link <?= $last_segment == 'hot-investments' ? 'active' : '' ?>"><span class="material-icons me-3">domain</span> <span>Hot Investments</span></a>
				</li>
				<li class="nav-item px-2">
					<a href="<?= base_url('calculator') ?>" class="nav-link <?= $last_segment == 'calculator' ? 'active' : '' ?>"><i class="fa-solid fa-calculator me-3"></i> <span>Tools & Calculators</span></a>
				</li>


				<li class="nav-item px-2">
					<a href="<?= base_url('message') ?>" class="nav-link <?= $last_segment == 'message' ? 'active' : '' ?>"><span class="material-icons me-3">explore</span> <span>Messages</span></a>
				</li>
					<li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'developers' ? 'active' : '' ?>" href="<?= base_url('developers') ?>"><span class="material-icons me-3">manage_accounts</span> <span>Developers</span></a></li>
			
				<!-- <li class="nav-item px-2">
					<a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#languageModal"><span class="material-icons me-3">translate</span> <span>Language</span></a>
				</li> -->
				<li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'foreign-investments' ? 'active' : '' ?>" href="<?= base_url('foreign-investments') ?>"><span class="material-icons me-3">question_answer</span> <span>Foreign Investments</span></a></li>
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

		<!-- <?php if (!isset($_SESSION['yid'])) {  ?>
			<a href="javascript:void(0)" class="btn btn-primary w-100 text-decoration-none rounded-4 py-3 fw-bold text-uppercase m-0" data-bs-toggle="modal" data-bs-target="#signModal">Sign In +</a>
		<?php } else { ?>
			<a href="javascript:void(0)" class="btn btn-primary w-100 text-decoration-none rounded-4 py-3 fw-bold text-uppercase m-0" data-bs-toggle="modal" data-bs-target="#postModal">Post +</a>
		<?php } ?> -->

		<!-- <ul class="p-0 d-flex justify-content-between mt-3" style="list-style: none;">
			<li class="nav-item px-2">
				<a class="nav-link text-muted" href="<?= base_url('privacy') ?>">Privacy Policy</a>
			</li>
			<li class="nav-item px-2">
				<a class="nav-link text-muted" href="<?= base_url('privacy') ?>">Privacy Policy</a>
			</li>
			<li class="nav-item px-2">
				<a class="nav-link text-muted" href="<?= base_url('privacy') ?>">Privacy Policy</a>
			</li>
		</ul> -->

		<div class="bg-white rounded-4 overflow-hidden shadow-sm mb-1 mt-1 pb-2">
		    <div class="d-flex justify-content-between align-items-center border-bottom">
			<h6 class="fw-bold text-body p-3 mb-0 ">Recommended Developers</h6>
			<a class="px-2" href="<?= base_url('developers')?>">See All</a>
			</div>

			<?php
			$all_dev = $this->db->query("SELECT * FROM yn_site_mem WHERE is_vendor='1' LIMIT 3")->result_array();
			if (!empty($all_dev)) { ?>
				<?php foreach ($all_dev as $developer) {

				?>
					<!-- Trending News Item -->
					<a href="<?= base_url('developer') ?>/<?= $developer['mid'] ?>/<?= url_smart($developer['name']) ?>" target="_blank" class="px-3 py-1 border-bottom d-flex align-items-center text-dark text-decoration-none">
						<img src="<?= base_url('assets') ?>/mem/<?= @$developer['mid'] ?>/img/<?= @$developer['photo'] ?>" class="img-fluid rounded-1" alt="news-img" style="width: 50px; height: 40px; object-fit: cover; margin-right:5px;">
						<div>

							<p class="fw-bold mb-0 pe-3" style=" font-size: 15px;margin-left: 20px;"><?= $developer['name'] ?></p>

						</div>

					</a>
				<?php } ?>
			<?php } else { ?>
				<p class="p-3 text-muted">No videos available.</p>
			<?php } ?>
		</div>

		<div class="bg-white rounded-4 overflow-hidden shadow-sm mb-1 mt-1 pb-2">
		    <div class="d-flex justify-content-between align-items-center border-bottom">
			<h6 class="fw-bold text-body p-3 mb-0 border-bottom">Recommended Blog Posts</h6>
			<a class="px-2" href="<?= base_url('explore')?>">See All</a>
			</div>

			<?php
			$all_blogs = $this->db->query("SELECT * FROM yn_site_blogs ORDER BY blog_id DESC LIMIT 1")->result_array();
			if (!empty($all_blogs)) { ?>
				<?php foreach ($all_blogs as $news) { // Show only 4 trending news 
				?>
					<!-- Trending News Item -->
					<a href="<?= base_url('blog') ?>/<?= $news['slug'] ?>" target="_blank" class="px-3 py-1 border-bottom d-flex align-items-center text-dark text-decoration-none">
						<img src="<?= base_url('assets/avator/upload/') . $news['blog_img'] ?>" class="img-fluid rounded-1" alt="news-img" style="width: 50px; height: 40px; object-fit: cover; margin-right:5px;">
						<div>
							<div class="text-muted fw-light d-flex align-items-center">
								<small style="    font-size: 8px;margin-left: 10px;"><?= date_format_1($news['blog_time'], 'alpha_date') ?></small><span class="mx-1 material-icons md-3">circle</span>
							</div>
							<p class="fw-bold mb-0 pe-3" style="  font-size: 15px;margin-left: 10px;"><?= htmlspecialchars($news['title']) ?></p>
							<!--<small class="text-muted" style="    font-size: 9px;"><?= strip_tags(trim_text($news['comment'], '100', '...')) ?></small><br>-->
						</div>

					</a>
				<?php } ?>
			<?php } else { ?>
				<p class="p-3 text-muted">No trending blogs available.</p>
			<?php } ?>
		</div>


		<div class="bg-white rounded-4 overflow-hidden shadow-sm mb-1 mt-1 pb-2">
		    <div class="d-flex justify-content-between align-items-center border-bottom">
			<h6 class="fw-bold text-body p-3 mb-0 border-bottom">Recommended Videos</h6>
			<a class="px-2" href="<?= base_url('videos')?>">See All</a>
			</div>

			<?php
			$all_videos = $this->db->query("SELECT * FROM yn_site_gallery LIMIT 1")->result_array();
			if (!empty($all_videos)) { ?>
				<?php foreach ($all_videos as $news) {
					preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]+)/', $news['ygl_img'], $match);
					$youtube_id = $match[1] ?? '';
					$thumbnail_url = "https://img.youtube.com/vi/{$youtube_id}/hqdefault.jpg";

				?>
					<!-- Trending News Item -->
					<a href="<?= base_url('video') ?>/<?= $news['ygl_id'] ?>" target="_blank" class="px-3 py-1 border-bottom d-flex align-items-center text-dark text-decoration-none">
						<img src="<?= $thumbnail_url ?>" class="img-fluid rounded-1 ms-auto" alt="news-img" style="width: 50px; height: 40px; object-fit: cover; margin-right:5px;">
						<div>

							<p class="fw-bold mb-0 pe-3" style="    font-size: 10px;"><?= htmlspecialchars($news['ygl_name']) ?></p>

						</div>

					</a>
				<?php } ?>
			<?php } else { ?>
				<p class="p-3 text-muted">No videos available.</p>
			<?php } ?>
		</div>
	</div>
</aside>

<style>
aside	[class*="fa-"] {
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