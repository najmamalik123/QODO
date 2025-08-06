<aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
	<div class="fix-sidebar">
		<div class="side-trend lg-none">
			<!-- Search Tab -->
			<div class="sticky-sidebar2 mb-3">
				<?php if (!isset($_SESSION['yid']) || $_SESSION['plan'] == '') {  ?>
					<div class="card p-4 text-light mb-1" style="max-width: 320px; border-radius: 16px; background: linear-gradient(to bottom, #5A1D32, #EDEDED);">
						<h5 class="fw-bold text-white" style="font-size: 14px;">Join Richo Club</h5>
						<p class="text-white" style="    font-size: 10px;"> An Invite-Only Circle for <strong style="font-size:13px;"> Top 1% Real Estate Investors </strong>- India’s First Elite Real Estate Club! </p>

						<!-- <ul class="list-unstyled text-dark">
							<li class="mb-2">✅ Exclusive investment deals</li>
							<li class="mb-2">✅ Connect with top investors</li>
							<li class="mb-2">✅ Premium market analysis</li>
						</ul> -->

						<a href="<?= base_url('membership') ?>" class="btn  mt-3 py-2" style="background-color: white; color: #5A1D32; border-radius: 30px; font-weight: bold; font-size:11px;">
							Become a member
						</a>
					</div>

					<!-- <a href="<?= base_url('membership') ?>" class="btn btn-primary w-100 text-decoration-none rounded-4 py-3 fw-bold text-uppercase m-0 mb-2">Become a Member</a> -->
				<?php } ?>
				<div class="input-group mb-1 shadow-sm rounded-4 overflow-hidden py-2 bg-white" onclick="window.location.href='<?= base_url('search') ?>'">
					<span class="input-group-text material-icons border-0 bg-white text-primary readonly">search</span>
					<input type="text" class="form-control border-0 fw-light ps-1" placeholder="Search <?= $site_name ?>">
				</div>
				<?php
				// Fetch the latest news data from the database using CodeIgniter query builder
				$this->db->select('*');
				$this->db->from('news_data');
				$getNewsData = $this->db->get();

				// Check if the query returned any results
				if ($getNewsData->num_rows() > 0) {
					// Fetch the results as an array
					$news_results = $getNewsData->result_array();
				} else {
					// Handle no results
					$news_results = [];
				}
				?>

				<!-- Google News Section -->
				<div class="bg-white rounded-4 overflow-hidden shadow-sm mb-1">
					<h6 class="fw-bold text-body p-3 mb-0 border-bottom">What's happening</h6>

					<?php if (!empty($news_results)) { ?>
						<?php foreach (array_slice($news_results, 0, 4) as $news) { // Show only 4 trending news 
						?>
							<!-- Trending News Item -->
							<a href="<?= htmlspecialchars($news['link']) ?>" target="_blank" class="p-3 border-bottom d-flex align-items-center text-dark text-decoration-none">
								<div>
									<div class="text-muted fw-light d-flex align-items-center">
										<small>Trending News</small><span class="mx-1 material-icons md-3">circle</span><small>Live</small>
									</div>
									<p class="fw-bold mb-0 pe-3" style="    font-size: 10px;"><?= htmlspecialchars($news['title']) ?></p>
									<!--<small class="text-muted"><?= htmlspecialchars($news['snippet']) ?></small><br>-->
								</div>
								<img src="<?= $news['photo_url'] ?>" class="img-fluid rounded-4 ms-auto" alt="news-img" style="width: 60px; height: 60px; object-fit: cover;">
							</a>
						<?php } ?>
					<?php } else { ?>
						<p class="p-3 text-muted">No trending news available.</p>
					<?php } ?>

					<a href="https://news.google.com/home?hl=en-US&gl=US&ceid=US:en" target="_blank" class="text-decoration-none">
						<div class="p-3">Show More</div>
					</a>
				</div>


				<?php
				if (isset($_SESSION['yid']) && $_SESSION['yid'] != '') {
					$yid = $_SESSION['yid'];
					$getVendors = $this->db->query("SELECT * FROM yn_site_mem WHERE mid != '$yid' ORDER BY rand() LIMIT 3");
				} else {
					$getVendors = $this->db->query("SELECT * FROM yn_site_mem ORDER BY rand() LIMIT 3");
				}
				$vendors = $getVendors->result_array();

				if (count($vendors) > 0) { ?>
					<div class="bg-white rounded-4 overflow-hidden shadow-sm account-follow mb-1">
						<h6 class="fw-bold text-body p-3 mb-0 border-bottom">Who to follow</h6>
						<!-- Account Item -->
						<?php foreach ($vendors as $vendor) { ?>
							<div class="p-3 border-bottom d-flex text-dark text-decoration-none account-item">
								<a href="<?= base_url('userprofile/' . $vendor['username']) ?>" style=" margin-right:9px">
									<img src="<?= base_url('assets/mem/' . $vendor['mid'] . '/img/' . $vendor['photo']) ?>" class="img-fluid rounded-circle me-3" style="width:50px ;" alt="profile-img">
								</a>
								<div>
									<p class="fw-bold mb-0 pe-3 d-flex align-items-center"><a class="text-decoration-none text-dark" href="<?= base_url('userprofile/' . $vendor['username']) ?>"><?= $vendor['name'] ?></a>
										<?php if ($vendor['user_status'] == '9') { ?>
											<span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
										<?php } ?>
									</p>
									<div class="text-muted fw-light">
										<p class="mb-1 small">@<?= $vendor['username'] ?></p>
										<!-- <span class="text-muted d-flex align-items-center small"><span class="material-icons me-1 small">open_in_new</span>Promoted</span> -->
									</div>
								</div>
								<div class="ms-auto w-50 d-flex justify-content-end align-items-center">
									<div class="btn-group" role="group">
										<input type="checkbox" class="btn-check follow-toggle" id="followBtn<?= $vendor['mid'] ?>" data-user-id="<?= $vendor['mid'] ?>" <?= favourite_me_user($vendor['mid']) ? 'checked' : '' ?>>
										<label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="followBtn<?= $vendor['mid'] ?>">
											<span class="follow <?= favourite_me_user($vendor['mid']) ? 'd-none' : '' ?>">+ Follow</span>
											<span class="following <?= favourite_me_user($vendor['mid']) ? '' : 'd-none' ?>">Following</span>
										</label>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</aside>