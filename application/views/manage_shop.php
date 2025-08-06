<?php
$yid = $profile_data['mid'];
$getUserShop = $this->db->query("SELECT * FROM x_vendor_shop WHERE shop_user_id = '$yid' ORDER BY shop_id DESC");
$shop = $getUserShop->row_array();

if (!empty($shop)) {
	$what = "update";
} else {
	$what = "add";
}
?>
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
							<h5 class="lead fw-bold text-body mb-0">Become a Vendor</h5>
						</div>
						<div class="row justify-content-center">
							<?php
							$kyc_status = $profile_data['kyc_status'];

							if ($kyc_status == '1') { ?>
								<form action="<?= base_url('index.php/action/create_shop') ?>" method="post" enctype="multipart/form-data" onsubmit="return uploadandform('<?= base_url('index.php/action/create_shop') ?>','post',this,'cover_image_90_2','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='fomr_id_proile2'>
									<div class="row">
										<input type="hidden" name="what" value="<?= $what ?>">
										<input type="hidden" name="shop_id" value="<?= @$shop['shop_id'] ?>">
										<!-- Shop Name -->
										<div class="col-12">
											<div class="form-group mb-2">
												<label for="shopname">Shop name</label>
												<input type="text" class="form-control" name="shop_name" value="<?= @$shop['shop_name'] ?>" placeholder="Shop Name" />
											</div>
										</div>

										<!-- Shop State -->
										<div class="col-md-4 col-12">
											<div class="form-group mb-2">
												<label for="shopstate">State</label>
												<select name="shop_state" id="shopstate" class="form-control" onchange="load_new_citys(this)">
													<?= getState('101', '1', @$shop['shop_state']); ?>
												</select>
											</div>
										</div>

										<!-- Shop City -->
										<div class="col-md-4 col-12">
											<div class="form-group mb-2">
												<label for="get_cities_data">City</label>
												<select name="shop_city" id="get_cities_data" class="form-control">
													<?php if (isset($shop) && $shop['shop_city'] != '') {
														$selectedState = $shop['shop_state'];
														$getCities = $this->db->query("SELECT * FROM yn_site_cities WHERE state_id = '$selectedState'");
														foreach ($getCities->result_array() as $city) { ?>
															<option value="<?= $city['city_id'] ?>" <?= ($shop['shop_city'] == $city['city_id']) ? 'selected' : '' ?>><?= $city['city_name'] ?></option>
													<?php }
													} ?>
												</select>
											</div>
										</div>

										<!-- Shop Postal/Zip -->
										<div class="col-md-4 col-12">
											<div class="form-group mb-2">
												<label for="shopzip">Postal/Zip</label>
												<input type="text" name="shop_zip" id="shopzip" class="form-control" value="<?= @$shop['shop_zip'] ?>" placeholder="Postal/Zip">
											</div>
										</div>

										<!-- Shop Address -->
										<div class="col-12">
											<div class="form-group mb-2">
												<label for="shopaddr">Address</label>
												<input type="text" class="form-control" id="shopaddr" name="shop_address" value="<?= @$shop['shop_address'] ?>" placeholder="Address">
											</div>
										</div>

										<!-- Shop Description -->
										<div class="col-12">
											<div class="form-group mb-2">
												<label for="shopdesc">Description</label>
												<textarea name="shop_desc" id="shopdesc" class="form-control" placeholder="About your business" maxlength="300" oninput="countCharacters(this)"><?= @$shop['shop_desc'] ?></textarea>
												<small id="charCount">300 characters remaining</small>
											</div>
										</div>


										<!-- Shop Logo -->
										<div class="col-12">
											<div class="form-group mb-2">
												<label for="shop_logo">Logo</label>
												<input type="file" name="file_name" id="shop_logo" class="form-control" onchange="previewImage(event, 'logo-preview')">
												<input type="hidden" class="form-control" name="existing_logo" value="<?= @$shop['shop_logo'] ?>">
												<img id="logo-preview" src="<?= !empty($shop['shop_logo']) ? base_url('assets/avator/upload/' . $shop['shop_logo']) : '#' ?>" alt="Preview" style="<?= !empty($shop['shop_logo']) ? 'display:block;' : 'display:none;' ?> width:100px; height:auto; margin-top:10px;">
											</div>
										</div>
									</div>

									<div class="prog_ups col-12 round1 my-3 mx-0 px-0">
										<div id="progress_value_sc" style="background:green;height:15px;width:0px; position: relative;text-align: center;">
											<span id="prog_valie_text" class="text-white"></span>
										</div>
									</div>

									<!-- Submit Button-->
									<div class="d-grid">
										<button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Submit</button>
									</div>
								</form>

							<?php } else { ?>
								<div class="col-12">
									<div class="card border-0 shadow-lg">
										<div class="card-body p-5">
											<h4 class="text-center text-warning">KYC Required!</h4>
											<div class="text-center my-3">
												<i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
											</div>
											<p class="text-center text-muted">Your account verification is required before you can proceed.</p>
											<hr class="my-4">
											<p class="text-center">To access all features, including creating a shop, you need to complete your KYC verification.</p>
											<p class="text-center">Please submit your KYC documents as soon as possible. Once verified, you will be notified via email.</p>

											<div class="text-center mt-4">
												<a href="<?= base_url('kyc') ?>" class="btn btn-primary">Complete KYC</a>
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
							<?php } ?>
						</div>
					</div>
				</div>

			</main>
			<?php include 'inc/_lsidebar.php' ?>
			<?php include 'inc/_rsidebar.php' ?>
		</div>
	</div>
</div>

<script>
	function previewImage(event, previewId) {
		var input = event.target;
		var output = document.getElementById(previewId);

		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				output.src = e.target.result;
				output.style.display = "block";
			};
			reader.readAsDataURL(input.files[0]);
		} else {
			output.src = "#";
			output.style.display = "none";
		}
	}
</script>

<script>
	function countCharacters(textarea) {
		let maxLength = 300;
		let currentLength = textarea.value.length;
		let remaining = maxLength - currentLength;
		document.getElementById("charCount").textContent = remaining + " characters remaining";
	}
</script>