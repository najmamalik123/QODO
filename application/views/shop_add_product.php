<?php

$what = 'add_product';
@$the_product = xss_clean($_GET['id']);
$product_data = get_product_data($the_product);
if (@$_GET['id'] != '') {
	$send_product = 'edit_product';
	$text = "Update Product";
} else {
	$send_product = 'add_product';
	$text = "Add Product";
}

?>

<div class="py-4">
	<div class="container">
		<div class="row position-relative">
			<!-- Main Content -->
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="main-content">
					<div class="mb-5">
						<h1 class="fw-bold text-black mb-1"><?= $text ?></h1>
					</div>
					<!-- Feeds -->
					<div class="feeds">
						<!-- Feed Item -->
						<div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page">
							<div class="row justify-content-center">
								<div class="col-lg-12">
									<form action="<?= base_url('index.php/action/add_product') ?>" method="post" enctype="multipart/form-data" onsubmit="return uploadandform('<?= base_url('index.php/action/add_product') ?>','post',this,'cover_image_90_2','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='fomr_id_proile2'>
										<div class="row">
											<input type="hidden" name="what" value="<?= $what ?>">
											<input type="hidden" name="product_id" value="<?= @$product_data['p_id'] ?>">
											<!-- Product Name -->
											<div class="col-12">
												<div class="form-group mb-2">
													<label for="prodname">Product Name</label>
													<input type="text" class="form-control" id="prodname" name="p_name" value="<?= @$product_data['p_name'] ?>" placeholder="Product Name" />
												</div>
											</div>

											<!-- Product Category -->
											<div class="col-md-4 col-12">
												<div class="form-group mb-2">
													<label for="prodcat">Categories</label>
													<select name="p_category" id="prodcat" class="form-control">
														<option value="" selected disabled>Select Category</option>
														<?php
														$getCategories = $this->db->query("SELECT * FROM yn_site_catagory ORDER BY ctid DESC");
														foreach ($getCategories->result_array() as $category) { ?>
															<option value="<?= $category['ctid'] ?>" <?= ($category['ctid'] == @$product_data['p_category']) ? 'selected' : '' ?>><?= $category['name'] ?></option>
														<?php } ?>
													</select>
												</div>
											</div>

											<!-- Product SKU -->
											<div class="col-md-4 col-12">
												<div class="form-group mb-2">
													<label for="prodsku">SKU</label>
													<input type="text" name="p_sku" class="form-control" id="prodsku" value="<?= @$product_data['p_sku'] ?>" placeholder="SKU">
												</div>
											</div>

											<!-- Product Stock -->
											<div class="col-md-4 col-12">
												<div class="form-group mb-2">
													<label for="prodstock">Stock</label>
													<input type="text" name="p_stock" class="form-control" id="prodstock" value="<?= @$product_data['p_stock'] ?>" placeholder="Stock">
												</div>
											</div>

											<!-- Product Price -->
											<div class="col-md-4 col-12">
												<div class="form-group mb-2">
													<label for="prodprice">Price</label>
													<input type="text" name="p_price" class="form-control" id="prodprice" value="<?= @$product_data['p_price'] ?>" placeholder="Price">
												</div>
											</div>

											<!-- Product Price Type -->
											<div class="col-md-4 col-12">
												<div class="form-group mb-2">
													<label for="prodpricetype">Price Type</label>
													<select name="p_price_type" class="form-control" id="prodpricetype">
														<option value="" disabled selected>Select Type</option>
														<?php $getType = $this->db->query("SELECT * FROM yn_site_tags WHERE stg_type = 'product_type' ORDER BY stg_tgid DESC");
														foreach ($getType->result_array() as $type) { ?>
															<option value="<?= $type['stg_name'] ?>" <?= ($type['stg_name'] == @$product_data['p_price_type']) ? 'selected' : '' ?>><?= $type['stg_name'] ?></option>
														<?php } ?>
													</select>
												</div>
											</div>

											<!-- Product Price Show -->
											<div class="col-md-4 col-12">
												<div class="form-group mb-2">
													<label class="mb-2">Show Price</label><br />
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" value="1" name="p_price_show" id="yes" <?= (isset($product_data['p_price_show']) && $product_data['p_price_show'] == '1') ? 'checked' : '' ?>>
														<label class="form-check-label" for="yes">Yes</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="radio" value="0" name="p_price_show" id="no" <?= (!isset($product_data['p_price_show']) || $product_data['p_price_show'] == '0') ? 'checked' : '' ?>>
														<label class="form-check-label" for="no">No</label>
													</div>
												</div>
											</div>

											<!-- Product Description -->
											<div class="col-12">
												<div class="form-group mb-2">
													<label for="shopdesc">Description</label>
													<textarea name="p_descp" id="shopdesc" class="form-control" placeholder="Product Description" maxlength="300" oninput="countCharacters(this)"><?= @$product_data['p_descp'] ?></textarea>
													<small id="charCount">300 characters remaining</small>
												</div>
											</div>


											<!-- Product Logo -->
											<div class="col-12">
												<div class="form-group mb-2">
													<label for="thumbnail">Product Image</label>
													<input type="file" name="file_name" id="thumbnail" class="form-control" accept=".png, .jpg, .jpeg" onchange="previewImage(event, 'img-preview')">
													<input type="hidden" class="form-control" name="existing_img" value="<?= @$product_data['p_cover'] ?>">
													<img id="img-preview" src="<?= !empty($product_data['p_cover']) ? base_url('assets/avator/upload/' . $product_data['p_cover']) : '#' ?>" alt="Preview" style="<?= !empty($product_data['p_cover']) ? 'display:block;' : 'display:none;' ?> width:100px; height:auto; margin-top:10px;">
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
											<button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit"><?= $text ?></button>
										</div>
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