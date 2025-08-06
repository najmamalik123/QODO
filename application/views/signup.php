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
		position: relative;
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

<div class="py-4">
	<div class="container">
		<div class="d-flex justify-content-center align-items-center mt-1">
			<div class="row position-relative">
				<div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page">

					<div class=" text-center">
							<a class="navbar-brand" href="<?= base_url('home') ?>"><img src="<?= base_url('assets/avator/logo.png') ?>" style="height: 60px;" class="img-fluid logo" alt="brand-logo"></a>
					</div>


					<div class="mb-3 text-center">
						<h3 class="lead fw-bold text-black mb-1">Create a New Account</h3>
					</div>
					<div class="mb-3 text-center">
						<p class="text-body mb-0">Enter your details to sign up</p>
					</div>
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<form class="form-floating-space" action="<?= base_url('index.php/action/profile') ?>" method="post" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/signup') ?>',this,'error_div','loder_div','<?= base_url('index.php/main/otp-verify') ?>','0');">
								<!-- Username input -->
								<div class="form-floating mb-3 position-relative">
									<input class="form-control rounded-5" id="username" type="text" name="username" placeholder="Username" required onkeyup="checkUsername(this.value)">
									<label for="username">Username</label>
									<small id="username-status" class="position-absolute end-0 top-50 translate-middle-y pe-3"></small>
								</div>

								<!-- Name input-->
								<div class=" form-floating mb-3">
									<input class="form-control rounded-5" id="name" type="text" name="name" placeholder="Enter your name..." data-sb-validations="required" required>
									<label for="name">Full name</label>
								</div>

								<!-- Email address input -->
								<div class="form-floating mb-3 position-relative">
									<input class="form-control rounded-5" id="useremail" type="email" name="email" placeholder="name@example.com" required onkeyup="checkEmail(this.value)">
									<label for="useremail">Email address</label>
									<small id="email-status" class="position-absolute end-0 top-50 translate-middle-y pe-3"></small>
								</div>

								<!-- Phone number input-->
								<div class="form-floating mb-3">
									<input type="hidden" name="country_code" name="country_code" value="+91">
									<input type="text" name="phone" class="form-control rounded-5" id="floatingName" value="<?= @$_SESSION['phone'] ?>" placeholder="Enter Mobile Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
									<label for="phone">Phone number</label>
									<div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
								</div>

								<!-- Submit Button-->
								<div class="col-sm-12">
									<?php echo get_captcha('caprght_oplkion', 'sign9_form_90_feed'); ?>
								</div>
								<div class="d-grid">
									<button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Signup</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// USERNAME VALIDATION
	function checkUsername(username) {
		// Only "_" allowd
		username = username.replace(/[^a-zA-Z0-9_]/g, '');
		$("#username").val(username); // remove invalic characters

		if (username.length < 3) {
			$("#username-status").html('<span class="text-danger">❌ Too short</span>');
			$("#submitButton").prop("disabled", true);
			return;
		}

		$.ajax({
			url: "<?= base_url('index.php/action/check_username') ?>",
			type: "POST",
			data: {
				username: username
			},
			dataType: "json",
			success: function(response) {
				if (response.status === "available") {
					$("#username-status").html('<span class="text-success">✔️ Available</span>');
					$("#submitButton").prop("disabled", false);
				} else {
					$("#username-status").html('<span class="text-danger">❌ Not Available</span>');
					$("#submitButton").prop("disabled", true);
				}
			}
		});
	}

	// Prevent spaces and special characters except "_" in real-time
	$(document).ready(function() {
		$("#username").on("input", function() {
			let sanitizedValue = $(this).val().replace(/[^a-zA-Z0-9_]/g, '');
			$(this).val(sanitizedValue);
		});
	});

	// EMAIL
	function checkEmail(email) {
		if (email.length < 5 || !email.includes("@")) {
			$("#email-status").html('<span class="text-danger">❌ Invalid email</span>');
			$("#submitButton").prop("disabled", true);
			return;
		}

		$.ajax({
			url: "<?= base_url('index.php/action/check_email') ?>",
			type: "POST",
			data: {
				email: email
			},
			dataType: "json",
			success: function(response) {
				if (response.status === "available") {
					$("#email-status").html('<span class="text-success">✔️ Available</span>');
					$("#submitButton").prop("disabled", false);
				} else {
					$("#email-status").html('<span class="text-danger">❌ Already registered</span>');
					$("#submitButton").prop("disabled", true);
				}
			}
		});
	}
</script>