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

	#signup-container {
		max-height: 90vh;
		overflow-y: auto;
	}
</style>

<div class="py-4">
	<div class="container">
		<div class="d-flex justify-content-center align-items-center vh-100">
			<div class="row position-relative col-md-4 col-12">
				<div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page">
					<div class="mb-3 text-center">
						<h3 class="lead fw-bold text-black mb-1">Verify Your Account</h3>
					</div>
					<div class="mb-3 text-center">
						<p class="text-body mb-0">Enter the OTP sent to your phone</p>
					</div>
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<form class="form-floating-space" action="<?= base_url('index.php/action/login_otp_verify') ?>" method="post" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/login_otp_verify') ?>',this,'error_div','loder_div','<?= base_url('home') ?>','0');">
								<!-- Username input -->
								<div class="form-floating mb-3 position-relative">
									<input class="form-control rounded-5" id="otp" type="number" min="0" maxlength="4" name="motp" placeholder="Enter OTP" value="<?= @$_SESSION['login_otp_phone']; ?>" required>
									<label for="otp">OTP</label>
									<a href="<?= base_url('action/otp_resend?type=2') ?>" class="fs-sm text-decoration-none">Resend OTP</a>
								</div>

								<!-- Submit Button-->
								<div class="d-grid">
									<button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Verify</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>