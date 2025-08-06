<div class="py-4">
	<div class="container">
		<div class="row position-relative">
			<!-- Main Content -->
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="feeds" id="load_dert">
					<!-- Feed Item -->
					<div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page">
						<?php include('inc/inc_account_setting_nav.php'); ?>
						<div class="mb-3">
							<h5 class="lead fw-bold text-body mb-0">KYC Verification</h5>
						</div>
						<div class="row justify-content-center">
							<?php
							$user_id = $profile_data['mid'];
							$getKycStatus = $this->db->query("SELECT kyc_status FROM x_kyc WHERE kyc_user_id ='$user_id'");
							$kycStatus = $getKycStatus->row_array();
							$kyc_status = $kycStatus['kyc_status'];

							switch ($kyc_status) {
								case '0': ?>
									<div class="col-12">
										<div class="card border-0 shadow-lg">
											<div class="card-body p-5">
												<h4 class="text-center text-info">KYC Verification in Progress</h4>
												<div class="text-center my-3">
													<i class="fas fa-clock fa-2x animated-checkmark text-info"></i>
												</div>
												<p class="text-center">Verification Pending!</p>
												<hr class="my-4">
												<p class="text-center">Our team is reviewing your KYC documents. Once verified, you will be able to create your shop. You will receive an email notification once your KYC is approved.</p>
												<p class="text-center">In the meantime, you can log in and use your account, but you won’t be able to create a shop until your KYC verification is completed.</p>

												<div class="text-center mt-4">
													<a href="<?= base_url('home') ?>" class="text-info text-decoration-none">Go Back to Homepage</a>
												</div>

												<div class="text-center mt-4">
													<a href="<?= base_url('logout') ?>" class="text-danger text-decoration-none">Logout</a>
												</div>
											</div>
										</div>
									</div>
								<?php break;

								case '1': ?>
									<div class="col-12">
										<div class="card border-0 shadow-lg">
											<div class="card-body p-5">
												<h4 class="text-center text-success">KYC Verified Successfully</h4>
												<div class="text-center my-3">
													<i class="fas fa-check-circle fa-2x text-success"></i>
												</div>
												<p class="text-center">Congratulations! Your KYC verification is complete.</p>
												<hr class="my-4">
												<p class="text-center">You can now create your shop and start listing your products. If you have any questions, feel free to contact support.</p>

												<div class="text-center mt-4">
													<a href="<?= base_url('become-investor') ?>" class="btn btn-success text-decoration-none">Become Investor</a>
												</div>
												<div class="text-center mt-4">
													<a href="<?= base_url('home') ?>" class="text-info text-decoration-none">Go Back to Homepage</a>
												</div>
												<div class="text-center mt-4">
													<a href="<?= base_url('logout') ?>" class="text-danger text-decoration-none">Logout</a>
												</div>
											</div>
										</div>
									</div>

								<?php break;
								default: ?>
									<div class="col-lg-12">
										<?php if ($kyc_status == '2') { ?>
											<div class="alert alert-danger" role="alert">
												<strong>KYC Rejected!</strong> Your KYC verification has been rejected. Please review your submitted documents and update them accordingly.
											</div>
										<?php } ?>
										<form action="<?= base_url('index.php/action/kyc_verification') ?>" method="post" enctype="multipart/form-data" onsubmit="return uploadandform('<?= base_url('index.php/action/kyc_verification') ?>','post',this,'cover_image_90_2','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='fomr_id_proile2'>

											<div class="form-group mb-4">
												<label for="adhar-front" class="text-black">Aadhaar Card (front)</label>
												<input type="file" name="aadhar_front" id="adhar-front" class="form-control" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'preview-front')">
												<img id="preview-front" src="#" alt="Preview" style="display:none; width:100px; height:auto; margin-top:10px;">
											</div>

											<div class="form-group">
												<label for="adhar-back" class="text-black">Aadhaar Card (back)</label>
												<input type="file" name="aadhar_back" id="adhar-back" class="form-control" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'preview-back')">
												<img id="preview-back" src="#" alt="Preview" style="display:none; width:100px; height:auto; margin-top:10px;">
											</div>

											<div class="prog_ups col-12 round1 mt-1 mx-0 px-0">
												<div id="progress_value_sc" style="background:green;height:15px;width:0px; position: relative;text-align: center;">
													<span id="prog_valie_text" class="text-white"></span>
												</div>
											</div>

											<!-- Submit Button-->
											<div class="d-grid">
												<button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Submit Documents</button>
											</div>

											<script>
												function previewImage(event, previewId) {
													var input = event.target;
													var output = document.getElementById(previewId);

													if (input.files && input.files[0]) {
														var reader = new FileReader();
														reader.onload = function() {
															output.src = reader.result;
															output.style.display = "block";
														};
														reader.readAsDataURL(input.files[0]);
													} else {
														output.src = "#";
														output.style.display = "none";
													}
												}

												// Clear preview when input is cleared
												document.getElementById("adhar-front").addEventListener("input", function() {
													if (!this.value) {
														document.getElementById("preview-front").style.display = "none";
													}
												});

												document.getElementById("adhar-back").addEventListener("input", function() {
													if (!this.value) {
														document.getElementById("preview-back").style.display = "none";
													}
												});
											</script>
										</form>
									</div>
							<?php break;
							} ?>
						</div>
					</div>
				</div>

			</main>
			<?php include 'inc/_lsidebar.php' ?>
			<?php include 'inc/_rsidebar.php' ?>
		</div>
	</div>
</div>