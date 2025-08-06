<style>
	.avatar-upload {
		position: relative;
		max-width: 205px;
		margin: 50px auto;
	}

	.avatar-upload .avatar-edit {
		position: absolute;
		right: 12px;
		z-index: 1;
		top: 10px;
	}

	.avatar-upload .avatar-edit input {
		display: none;
	}

	.avatar-upload .avatar-edit input+label {
		display: inline-block;
		width: 34px;
		height: 34px;
		margin-bottom: 0;
		border-radius: 100%;
		background: #FFFFFF;
		border: 1px solid transparent;
		box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
		cursor: pointer;
		font-weight: normal;
		transition: all 0.2s ease-in-out;
	}

	.avatar-upload .avatar-edit input+label:hover {
		background: #f1f1f1;
		border-color: #d6d6d6;
	}

	.avatar-upload .avatar-edit input+label:after {
		content: "\f040";
		font-family: 'FontAwesome';
		color: #757575;
		position: absolute;
		top: 10px;
		left: 0;
		right: 0;
		text-align: center;
		margin: auto;
	}

	.avatar-upload .avatar-preview {
		width: 192px;
		height: 192px;
		position: relative;
		border-radius: 100%;
		border: 6px solid #F8F8F8;
		box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
	}

	.avatar-upload .avatar-preview>div {
		width: 100%;
		height: 100%;
		border-radius: 100%;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
	}

	.file_input {

		border: 2px solid #959595;
		border-radius: 50%;
		height: 30px;
		width: 30px;
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 5px;
		cursor: pointer;
	}
</style>

<div class="py-4">
	<div class="container-fluid">
		<div class="row position-relative">
			<!-- Main Content -->
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="feeds" id="load_dert">
					<!-- Feed Item -->
					<div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page">
						<?php include('inc/inc_account_setting_nav.php'); ?>
						<div class="mb-3">
							<h5 class="lead fw-bold text-body mb-0">Account Settings</h5>
						</div>
						<div class="row justify-content-center">
							<div class="col-lg-12">
								<!-- PROFILE PICTURE UPLOAD FORM -->
								<form action="<?= base_url('index.php/action/photo') ?>"
									method="post"
									enctype="multipart/form-data"
									onsubmit="return uploadAndSubmit(event);"
									id="form_profile_picture">

									<input type="file" name="file_name" id="file_input"
										style="display: none;"
										onchange="previewImage(this);" />
									<input type="hidden" name="cvr_prf" value="photo" />
								</form>

								<!-- PROFILE PICTURE UI -->
								<div class="avatar-upload">
									<div class="avatar-edit">
										<!-- Clicking label triggers hidden file input -->
										<label for="file_input" class="file_input">
											<i class="fa-solid fa-pencil text-gray" style="font-size: 15px;"></i> <!-- Icon or styling as needed -->
										</label>
									</div>

									<div class="avatar-preview">
										<div id="imagePreview"
											style="background-image: url('<?= base_url('assets/mem/' . $profile_data['mid'] . '/img/' . $profile_data['photo']) ?>');
											width: 183px;
											height: 183px;
											background-size: cover;
											border-radius: 50%;">
										</div>
									</div>

									<div class="prog_ups col-12 round1 mt-1 mx-0 px-0">
										<div id="progress_value_sc"
											style="background:green;height:15px;width:0px; position: relative;text-align: center;">
											<span id="prog_valie_text" class="text-white"></span>
										</div>
									</div>
								</div>
								<script>
									function previewImage(input) {
										if (input.files && input.files[0]) {
											const reader = new FileReader();
											reader.onload = function(e) {
												document.getElementById('imagePreview').style.backgroundImage = 'url(' + e.target.result + ')';
											};
											reader.readAsDataURL(input.files[0]);

											// Submit after preview
											document.getElementById("form_profile_picture").dispatchEvent(new Event("submit"));
										}
									}

									function uploadAndSubmit(event) {
										event.preventDefault(); // Stop default form submission

										const form = document.getElementById("form_profile_picture");
										const formData = new FormData(form);

										const xhr = new XMLHttpRequest();
										xhr.open("POST", form.action, true);

										// Progress bar
										xhr.upload.onprogress = function(e) {
											if (e.lengthComputable) {
												const percent = Math.round((e.loaded / e.total) * 100);
												document.getElementById("progress_value_sc").style.width = percent + "%";
												document.getElementById("prog_valie_text").innerText = percent + "%";
											}
										};

										// On success
										xhr.onload = function() {
											if (xhr.status === 200) {
												const res = JSON.parse(xhr.responseText);
												if (res.status === 'success') {
													// Force refresh new image with timestamp
													const newImgUrl = '<?= base_url('assets/mem/' . $profile_data['mid'] . '/img/') ?>' + res.filename;
													document.getElementById('imagePreview').style.backgroundImage = 'url(' + newImgUrl + '?' + new Date().getTime() + ')';
												} else {
													alert("Error: " + res.message);
												}
											} else {
												alert("Upload failed.");
											}

											// Reset progress
											document.getElementById("progress_value_sc").style.width = "0%";
											document.getElementById("prog_valie_text").innerText = "";
										};

										xhr.send(formData);
										return false;
									}
								</script>


								<form class="form-floating-space" action="<?= base_url('index.php/action/edit') ?>" method="post" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/edit') ?>',this,'error_div','loder_div','#','1','editsave_2');">
									<!-- Name input-->
									<div class=" form-floating mb-3">
										<input class="form-control rounded-5" id="name" value="<?= $profile_data['name'] ?>" type="text" name="name" placeholder="Enter your name..." data-sb-validations="required">
										<label for="name">Full name</label>
									</div>
									<!-- Email address input -->
									<div class="form-floating mb-3 position-relative">
										<input class="form-control rounded-5" id="useremail" type="email" name="email" placeholder="name@example.com" required value="<?= $profile_data['email'] ?>">
										<label for="useremail">Email address</label>
										<small id="email-status" class="position-absolute end-0 top-50 translate-middle-y pe-3"></small>
									</div>
									<!-- Phone number input-->
									<div class="form-floating mb-3">
										<input class="form-control rounded-5" id="phone" type="tel" name="phone" placeholder="(123) 456-7890" data-sb-validations="required" value="<?= $profile_data['contact'] ?>" readonly>
										<label for="phone">Phone number</label>
									</div>
									<?php if($profile_data['is_vendor'] == '1') { ?>
									<div class="form-floating mb-3">
										<input class="form-control rounded-5" id="phone" type="text" name="cover2" placeholder="Intro Video " data-sb-validations="required" value="<?= $profile_data['cover2'] ?>" >
										<label for="phone">Intro Video Link</label>
									</div>
									<div class="form-floating mb-3">
										<input class="form-control rounded-5" id="phone" type="text" name="address" placeholder="Your Address " data-sb-validations="required" value="<?= $profile_data['address'] ?>" >
										<label for="phone">City, State</label>
									</div>
									<?php } ?>
									
									<!-- About input-->
									<div class="form-floating mb-3">
										<textarea class="form-control rounded-5" id="about" name="about" placeholder="Write something about yourself" style="height: 10rem" data-sb-validations="required" required><?= $profile_data['about'] ?></textarea>
										<label for="about">About Yourself</label>
									</div>
									<!-- Submit Button-->
									<div class="d-grid"><button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Update Profile</button></div>
								</form>
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