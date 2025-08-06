<div class="py-4">
	<div class="container">
		<div class="row position-relative bg-white">
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<form class="form-floating-space" action="<?= base_url('index.php/action/update_user_categories') ?>" method="post" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/update_user_categories') ?>',this,'error_div','loder_div','<?= base_url('profile') ?>','0');">
					<div class="row py-3 gy-3 m-0">
						<div class="col-12">
							<h2 class="fw-bold text-body fs-10 d-flex justify-content-center">Choose Categories</h2>
						</div>
						<!-- Category Item -->
						<?php foreach ($categories as $category) { ?>
							<div class="langauge-item col-6 col-md-3 px-1 mt-2">
								<input type="checkbox" class="btn-check" name="categories[]" id="cat<?= $category['ctid'] ?>" value="<?= $category['ctid'] ?>" <?= isset($profile_data['user_categories']) && in_array($category['ctid'], explode(',', $profile_data['user_categories'])) ? 'checked' : '' ?>>
								<label class="btn btn-language btn-sm px-2 py-2 rounded-5 d-flex align-items-center justify-content-between" for="cat<?= $category['ctid'] ?>">
									<span class="text-start d-grid">
										<small class="ln-18"><?= $category['name'] ?></small>
									</span>
									<span class="material-icons text-muted md-20">check_circle</span>
								</label>
							</div>
						<?php } ?>
						<div class="d-grid">
							<button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Continue</button>
						</div>
					</div>
				</form>
			</main>
			<?php include 'inc/_lsidebar.php' ?>
			<?php include 'inc/_rsidebar.php' ?>
		</div>
	</div>
</div>