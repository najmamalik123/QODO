<style>
	.form-control {
		height: 50px !important;
	}
	@media only screen and (max-width: 768px) {
    .mobile-small-text {
        font-size: 9px !important;
    }
}

</style>
<div class="py-4">
	<!--<div class="container my-5 d-none d-lg-block" style="    height: 70vh; align-items: center; display: flex;">-->
	<!--	<div class="row align-items-center justify-content-between h-100">-->
	<!--		<div class="col-lg-7">-->
	<!--			<h1 class="fw-bold text-dark" style="color: #5A1D32;">-->
	<!--				Premium Real Estate <br> Investment Insights-->
	<!--			</h1>-->
	<!--			<p class="text-muted fs-5">-->
	<!--				Join our exclusive community of real estate investors for premium content,-->
	<!--				investment opportunities, and expert networking.-->
	<!--			</p>-->

	<!--			<div class="mt-4">-->
	<!--				<a href="<?= base_url('membership') ?>" class="btn px-4 py-2 text-white rounded-pill" style="background-color: #5A1D32;">-->
	<!--					Join Membership X-->
	<!--				</a>-->
	<!--				<a href="<?= base_url('explore') ?>" class="btn px-4 py-2 ms-3 rounded-pill border" style="color: #5A1D32; border-color: #5A1D32;">-->
	<!--					Explore Content-->
	<!--				</a>-->
	<!--			</div>-->
	<!--		</div>-->

	<!--		 Right-side circle shape (decorative) -->
	<!--		<div class="col-lg-4 d-none bg-white d-lg-block position-relative p-4 shadow rounded-4">-->
	<!--			<div class="row justify-content-center">-->
	<!--				<div class="col-lg-12">-->
	<!--					<form class="form-floating-space" action="<?= base_url('index.php/action/contact') ?>" method="post" id="contactForm" novalidate="novalidate" onsubmit="return uploadandform('<?= base_url('index.php/action/contact') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">-->
	<!--						 Name input-->
	<!--						<div class=" form-floating mb-3">-->
	<!--							<input class="form-control rounded-5" id="name" type="text" name="name" placeholder="Enter your name..." value="<?= @$_SESSION['name'] ?>" data-sb-validations="required">-->
	<!--							<label for="name">Full name</label>-->
	<!--						</div>-->
	<!--						 Email address input-->
	<!--						<div class="form-floating mb-3 position-relative">-->
	<!--							<input class="form-control rounded-5" id="useremail" type="email" name="email" placeholder="name@example.com" value="<?= @$_SESSION['email'] ?>" required>-->
	<!--							<label for="useremail">Email address</label>-->
	<!--						</div>-->
	<!--						 Phone number input-->
	<!--						<div class="form-floating mb-3">-->
	<!--							<input class="form-control rounded-5" id="phone" type="tel" name="phone" placeholder="(123) 456-7890" value="<?= @$_SESSION['phone'] ?>" data-sb-validations="required">-->
	<!--							<label for="phone">Phone number</label>-->
	<!--						</div>-->
	<!--						 Message input-->
	<!--						<div class="form-floating mb-3">-->
	<!--							<textarea class="form-control rounded-5 overflow-hidden" id="message" name="mess" placeholder="Enter your message here..." style="" data-sb-validations="required"></textarea>-->
	<!--							<label for="message">Message</label>-->
	<!--						</div>-->
	<!--						 Captcha-->
	<!--						<div class="col-sm-12">-->
	<!--							<?php echo get_captcha('caprght_oplkion', 'sign9_form_90_feed'); ?>-->
	<!--						</div>-->
	<!--						 Submit Button-->
	<!--						<div class="d-grid"><button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Submit</button></div>-->
	<!--					</form>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--			 <div class="position-absolute end-0 top-50 translate-middle-y" style="width: 150px; height: 150px; background-color: #EDEDED; border-radius: 50%;">-->
	<!--			</div> -->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	<div class="container-fluid">
		<div class="row position-relative">
			<!-- Main Content -->
			<?php

			// Fetch the latest data from the database using CodeIgniter query builder
			$this->db->select('*');
			$this->db->from('market_data');
			$getMarketData = $this->db->get();

			// Check if the query returned any results
			if ($getMarketData->num_rows() > 0) {
				// Fetch the results as an array
				$results = $getMarketData->result_array();
			} else {
				// Handle no results
				$results = [];
			}
			?>
			<style>
				.marquee-container {
					width: 100%;
					background-color: #5a1d32;
					/* padding: 10px 0; */
					border-radius: 5px;
					overflow: hidden;
				}

				.marquee {
					display: flex;
					justify-content: flex-start;
					align-items: center;
					white-space: nowrap;
					animation: marquee 30s linear infinite;
				}

				.market-item {
					margin-right: 30px;
					/* Space between each item */
					font-size: 16px;
					color: white;
					font-family: 'Arial', sans-serif;
					display: flex;
					flex-direction: column;
					min-width: 150px;
					border-left: 1px solid gray;
					padding: 10px;
				}

				.market-item .symbol {
					font-weight: bold;
				}

				.market-item .price {
					font-weight: normal;
					margin: 0 5px;
				}

				.market-item .change {
					font-weight: bold;
				}

				.market-item .positive {
					color: #27ae60;
					/* Green color for positive percentage */
				}

				.market-item .negative {
					color: #e74c3c;
					/* Red color for negative percentage */
				}

				.market-item p {
					margin: 0;
				}

				/* Animation to move the marquee */
				@keyframes marquee {
					from {
						transform: translateX(100%);
					}

					to {
						transform: translateX(-100%);
					}
				}
			</style>
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="main-content">
					<?php include('inc/_home_nav.php') ?>

					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">


							<!-- Display Corporate Actions Before Posts -->
							<?php include('inc/inc_post_card.php'); ?>

							<div class="marquee-container mb-3">
								<div class="marquee">
									<!-- First Set of Market Items -->
									<div class="marquee-duplicate d-flex ">
										<?php foreach ($results as $row) { ?>
											<div class="market-item">
												<p class="d-flex justify-content-between"><span class="symbol"><?= $row['symbol'] ?></span>
													<span class="price"><?= $row['price'] ?></span>
												</p>
												<span class="change <?= $row['percent_change'] < 0 ? 'negative' : 'positive' ?>">
													(<?= $row['percent_change'] ?>%)
												</span>
											</div>
										<?php } ?>
									</div>
									<!-- Second Set of Market Items for Seamless Loop -->
									<div class="marquee-duplicate d-flex ">
										<?php foreach ($results as $row) { ?>
											<div class="market-item">
												<p class="d-flex justify-content-between"><span class="symbol"><?= $row['symbol'] ?></span>
													<span class="price"><?= $row['price'] ?></span>
												</p>
												<span class="change <?= $row['percent_change'] < 0 ? 'negative' : 'positive' ?>">
													(<?= $row['percent_change'] ?>%)
												</span>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<!-- Follow People Section -->
							<div>
								<div class="d-flex align-items-center justify-content-between mb-1">
									<h6 class="mb-0 fw-bold text-body">Follow People</h6>
									<a href="<?= base_url('investors') ?>" class="text-dark text-decoration-none material-icons">east</a>
								</div>

								<!-- Rest of the Content -->
								<!-- Slider Accounts -->
								<?php if (count($vendors) > 0) { ?>
									<div class="account-slider">
										<?php foreach ($vendors as $vendor) { ?>
											<div class="account-item">
												<div class="me-2 bg-white shadow-sm rounded-4 px-1 py-3 p-md-3 user-list-item d-flex justify-content-center my-2">
													<div class="text-center">
														<div class="position-relative d-flex justify-content-center">
															<a href="<?= base_url('userprofile/' . $vendor['username']) ?>" class="text-decoration-none">
																<img src="<?= base_url('assets/mem/' . $vendor['mid'] . '/img/' . $vendor['photo']) ?>" class="img-fluid rounded-circle mb-3" alt="profile-img">
																<?php if ($vendor['user_status'] == '9') { ?>
																	<div class="position-absolute">
																		<span class="material-icons bg-primary small p-1 fw-bold text-white rounded-circle">done</span>
																	</div>
																<?php } ?>
															</a>
														</div>
														<p class="fw-bold text-dark m-0"><?= $vendor['name'] ?></p>
														<p class="small text-muted">Investor</p>
														<div class="btn-group" role="group">
															<input type="checkbox" class="btn-check follow-toggle" id="followBtn<?= $vendor['mid'] ?>" data-user-id="<?= $vendor['mid'] ?>" <?= favourite_me_user($vendor['mid']) ? 'checked' : '' ?>>
															<label class="btn btn-outline-primary btn-sm px-3 rounded-pill" style="    font-size: 12px;" for="followBtn<?= $vendor['mid'] ?>">
																<span class="follow <?= favourite_me_user($vendor['mid']) ? 'd-none' : '' ?>">+ Follow</span>
																<span class="following <?= favourite_me_user($vendor['mid']) ? '' : 'd-none' ?>">Following</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								<?php } ?>

								<!-- Feeds -->
								<div class="pt-1 feeds" id="feed">
									<?php if (count($posts) > 0) {
										foreach ($posts as $post) { ?>
											<?php include('inc/inc_main_post_card.php'); ?>
											<?php include('inc/inc_comment_card.php'); ?>
											<?php include('inc/inc_post_card_edit.php'); ?>
										<?php }
									} else { ?>
										<div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm d-flex justify-content-center align-items-center text-center" style="min-height: 50px;">
											<p class="text-dark m-0">No post found</p>
										</div>
									<?php } ?>
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