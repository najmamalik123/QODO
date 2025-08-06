<style>
	.mobile-header,
	.mobile-footer {
		display: none !important
	}

	html,
	body {
		height: 100%;
		overflow: hidden;
	}

	body {
		
		background-image: url(<?= base_url('assets/avator/b3.jpg') ?>);
		background-repeat: no-repeat;
		background-size: cover;
		background-attachment: fixed;
	}

	body::before {
		content: "";
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.5);
		/* Adjust opacity */
		z-index: -1;
		/* Ensures it stays behind all content */
	}


	#signup-container {
		max-height: 90vh;
		overflow-y: auto;
	}
</style>

<div class="">
	<div class="container">
		<div class="d-flex justify-content-center align-items-center vh-100">
			<div class="row position-relative">
				<!-- Main Content -->
				<main class="col-12">
					<div class="main-content">
						<!-- Feeds -->
						<div class="feeds">
							<!-- Feed Item -->
							<div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page">

								<div class="mb-2 text-center">
									<a class="navbar-brand" href="<?= base_url('home') ?>"><img src="<?= base_url('assets/avator/logo.png') ?>" style="height: 60px;" class="img-fluid logo" alt="brand-logo"></a>
								</div>

								<div class="mb-3 text-center">
									<h3 class="lead fw-bold text-black mb-1">Login with Phone Number</h3>
								</div>
								<div class="mb-3 text-center">
									<p class="text-body mb-0">Enter your phone number to continue</p>
								</div>
								<div class="row justify-content-center">
									<div class="col-lg-12">
										<form class="form-floating-space" action="<?= base_url('index.php/action/login_phone') ?>" method="post">
											<!-- Phone number input-->
											<div class="row mx-0 mb-3">
												<div class="col-12 p-1">
													<div class="form-floating">
														<select class="form-select rounded-5" name="country_code" id="floatingSelect" aria-label="Floating label select example">
															<option selected="">+91</option>
														</select>
														<label for="floatingSelect">Code</label>
													</div>
												</div>
												<div class="col-12 p-1">
													<div class="form-floating d-flex align-items-end">
														<input type="text" name="phone" class="form-control rounded-5"
															id="floatingName" value="" placeholder="Enter Mobile Number"
															maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
														<label for="floatingName">Enter Mobile Number</label>
													</div>
												</div>
											</div>
											<!-- Submit Button-->
											<div class="d-grid"><button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Login</button></div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</main>
				<?php //include 'inc/_lsidebar.php' 
				?>
				<?php //include 'inc/_rsidebar.php' 
				?>
			</div>
		</div>
	</div>
</div>