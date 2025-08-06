<div class="py-4">
	<div class="container">
		<div class="row position-relative">
			<!-- Main Content -->
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="main-content">
					<div class="mb-4 d-flex align-items-center">
						<div class="d-flex align-items-center">
							<a href="javascript:history.back()" class="material-icons text-dark text-decoration-none m-none me-3">
								arrow_back
							</a>
							<p class="ms-2 mb-0 fw-bold text-body fs-6"><?= $profile_data['shop_name'] ?></p>
						</div>
						<!-- <a href="#" class="text-decoration-none material-icons md-20 ms-auto text-muted">share</a> -->
					</div>
					<div class="bg-white rounded-4 shadow-sm profile">
						<div class="d-flex align-items-center px-3 pt-3">
							<img src="<?= base_url('assets/avator/upload/' . $profile_data['shop_logo']) ?>" class="img-fluid rounded-circle" alt="profile-img">
							<div class="ms-3">
								<h6 class="mb-0 d-flex align-items-start text-body fs-6 fw-bold"><?= $profile_data['shop_name'] ?>
									<?php if ($profile_data['shop_status'] == '1') { ?>
										<span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
									<?php } ?>
								</h6>
								<p class="text-muted mb-0">@<?= $profile_data['shop_uniq_id'] ?></p>
							</div>
							<?php if (@$_SESSION['yid'] != $profile_data['shop_user_id']) { ?>
								<!-- <div class="ms-auto btn-group" role="group">
									<input type="checkbox" class="btn-check follow-toggle" id="followBtn<?= $profile_data['mid'] ?>" data-user-id="<?= $profile_data['mid'] ?>" <?= favourite_me_user($profile_data['mid']) ? 'checked' : '' ?>>
									<label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="followBtn<?= $profile_data['mid'] ?>">
										<span class="follow <?= favourite_me_user($profile_data['mid']) ? 'd-none' : '' ?>">+ Follow</span>
										<span class="following <?= favourite_me_user($profile_data['mid']) ? '' : 'd-none' ?>">Following</span>
									</label>
								</div> -->
							<?php } ?>
						</div>
						<div class="p-3">
							<p class="mb-2 fs-6"><?= $profile_data['shop_desc'] ?></p>
							<div class="d-flex followers d-none" id="followers">
								<div>
									<p class="mb-0"><?= get_followers_count($profile_data['mid']) ?> <span class="text-muted">Followers</span></p>

								</div>
								<div class="ms-5 ps-5">
									<p class="mb-0"><?= get_following_count($profile_data['mid']) ?> <span class="text-muted">Following</span></p>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content mt-2" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
							<!-- Follow People -->
							<div class="ms-1">
								<!-- Feeds -->
								<div class="feeds" id="feed">
									<!-- Feed Item -->
									<?php if (count($products) > 0) {
										foreach ($products as $row) {
											include('inc/inc_shop_product_card.php');
										}
									} else { ?>
										<div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm d-flex justify-content-center align-items-center text-center" style="min-height: 50px;">
											<p class="text-dark m-0">No products found</p>
										</div>
									<?php } ?>

									<div class="container mb-3">
										<nav aria-label="...">
											<ul class="pagination justify-content-center">
												<?php echo $this->pagination->create_links(); ?>
											</ul>
										</nav>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?php include 'inc/_lsidebar.php' ?>
			<?php include 'inc/_rsidebar.php' ?>
		</div>
	</div>
</div>