<div class="py-4">
	<div class="container-fluid">
		<div class="row position-relative">
			<!-- Main Content -->
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="main-content">
					<div class="mb-5">
						<div class="feature bg-primary bg-gradient text-white rounded-4 mb-3"><i class="icofont-envelope"></i></div>
						<?php if (isset($_GET['property'])) { ?>
							<h1 class="fw-bold text-black mb-1">Need more details?</h1>
							<p class="lead fw-normal text-muted mb-0">Please fill in your details.</p>
						<?php } else { ?>
							<h1 class="fw-bold text-black mb-1">How can we help?</h1>
							<p class="lead fw-normal text-muted mb-0">We'd love to hear from you</p>
						<?php } ?>
					</div>
					<!-- Feeds -->
					<div class="feeds">
						<!-- Feed Item -->
						<div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page">
							<div class="mb-3">
								<?php if (isset($_GET['property'])) { ?>
									<h5 class="lead fw-bold text-body mb-0">Inquiry Form</h5>
								<?php } else { ?>
									<h5 class="lead fw-bold text-body mb-0">Contact Form</h5>
								<?php } ?>
							</div>
							<div class="row justify-content-center">
								<div class="col-lg-12">
									<form class="form-floating-space" action="<?= base_url('index.php/action/contact') ?>" method="post" id="contactForm" novalidate="novalidate" onsubmit="return uploadandform('<?= base_url('index.php/action/contact') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
										<!-- Name input-->
										<div class=" form-floating mb-3">
											<input class="form-control rounded-5" id="name" type="text" name="name" placeholder="Enter your name..." value="<?= @$_SESSION['name'] ?>" data-sb-validations="required">
											<label for="name">Full name</label>
										</div>
										<!-- Email address input-->
										<div class="form-floating mb-3 position-relative">
											<input class="form-control rounded-5" id="useremail" type="email" name="email" placeholder="name@example.com" value="<?= @$_SESSION['email'] ?>" required>
											<label for="useremail">Email address</label>
										</div>
										<!-- Phone number input-->
										<div class="form-floating mb-3">
											<input class="form-control rounded-5" id="phone" type="tel" name="phone" placeholder="(123) 456-7890" value="<?= @$_SESSION['phone'] ?>" data-sb-validations="required">
											<label for="phone">Phone number</label>
										</div>

										<?php if (isset($_GET['property'])) { ?>
											<div class="form-floating mb-3">
												<select name="property" class="form-control rounded-5">
													<?php
													$property = $this->db->query("SELECT * FROM x_home_property WHERE prop_id='" . $_GET['property'] . "'")->row_array();
													echo '<option value="' . $property['prop_name'] . '">' . $property['prop_name'] . '</option>';
													?>
												</select>
												<label for="property">Property</label>
											</div>

											<div class="form-floating mb-3">
												<input type="text" class="form-control rounded-5" name="budget" placeholder="Enter your budget" required>
												<label for="budget">Budget</label>
											</div>

											<div class="form-floating mb-3">
												<input type="text" class="form-control rounded-5" name="preferences" placeholder="Enter your preferences" required>
												<label for="preferences">Preferences</label>
											</div>

											<!-- Multiple Document Upload Field -->
											<div class="mb-3">
												<label for="documents" class="form-label">Upload Documents</label>
												<input type="file" class="form-control" name="documents[]" id="documents" multiple>
											</div>

											<input type="hidden" name="property_id" value="<?= $_GET['property'] ?>">
										<?php } ?>

										<!-- Subject input-->
										<div class="form-floating mb-3">
											<input class="form-control rounded-5" id="subject" type="text" name="subject" placeholder="Subject" data-sb-validations="required">
											<label for="subject">Subject</label>
										</div>
										<!-- Message input-->
										<div class="form-floating mb-3">
											<textarea class="form-control rounded-5" id="message" name="mess" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
											<label for="message">Message</label>
										</div>
										<!-- Captcha-->
										<div class="col-sm-12">
											<?php echo get_captcha('caprght_oplkion', 'sign9_form_90_feed'); ?>
										</div>
										<!-- Submit Button-->
										<div class="d-grid"><button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Submit</button></div>
									</form>
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