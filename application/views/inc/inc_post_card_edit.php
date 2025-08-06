<!-- Post Modal -->
<div class="modal fade" id="postModalEdit<?= $post['p_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content rounded-4 p-4 border-0 bg-light">
			<div class="modal-header d-flex align-items-center justify-content-start border-0 p-0 mb-3">
				<a href="#" class="text-muted text-decoration-none material-icons" data-bs-dismiss="modal">arrow_back_ios_new</a>
				<h5 class="modal-title text-muted ms-3 ln-0" id="staticBackdropLabel">
					<?php if (isset($_SESSION['yid']) && $_SESSION['yid'] != '') {
						$user = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
						$profile_pic = base_url('assets/mem/' . $user['mid'] . '/img/' . $user['photo']);
						$img = "<img src='$profile_pic' class='img-fluid' style='height:40px;border-radius:20px;background:#fffe'>";
					} else {
						$img = '<span class="material-icons md-32">account_circle</span>';
					}
					echo $img;
					?>
				</h5>
			</div>
			<form method="post" action="<?= base_url('index.php/action/edit_post') ?>" onsubmit="return uploadandform('<?= base_url('index.php/action/edit_post') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
				<div class="modal-body p-0 mb-3">
					<div class="form-floating">
						<input type="hidden" name="p_id" value="<?= $post['p_id'] ?>">
						<textarea class="form-control rounded-5 border-0 shadow-sm" id="postText<?= $post['p_id'] ?>" placeholder="Leave a comment here" id="floatingTextareaEdit" name="post" style="height: 200px"><?= $post['p_content'] ?></textarea>
						<label for="floatingTextareaEdit" class="h6 text-muted mb-0">What's on your mind...</label>
					</div>
				</div>
				<div class="modal-footer justify-content-start px-1 py-1 bg-white shadow-sm rounded-5">
					<div class="rounded-4 m-0 px-3 py-2 d-flex align-items-center justify-content-between w-75">
						<a href="#" class="text-muted text-decoration-none material-icons">insert_link</a>

						<a href="javascript:void(0)" class="text-muted text-decoration-none material-icons" onclick="$('#post-image').click()">image</a>
						<input type="file" name="post_image" style="display:none" id="post-image" />
						<input type="hidden" name="old_image" value="<?= $post['p_image'] ?>">

						<a href="#" class="text-muted text-decoration-none material-icons" onclick="$('#post-video').click()">smart_display</a>
						<input type="file" name="post_video" style="display:none" id="post-video" />
						<input type="hidden" name="old_video" value="<?= $post['p_video'] ?>">

						<span id="wordCount<?= $post['p_id'] ?>" class="text-muted">0/500</span>

					</div>
					<div class="ms-auto m-0">
						<button class="btn btn-primary rounded-5 fw-bold px-3 py-2 fs-6 mb-0 d-flex align-items-center"><span class="material-icons me-2 md-16">send</span>Post</button>
					</div>
				</div>
				<div class="prog_ups col-12 round1 mt-1 mx-0 px-0">
					<div id="progress_value_sc" style="background:green;height:15px;width:0px; position: relative;text-align: center;">
						<span id="prog_valie_text" class="text-white"></span>
					</div>
				</div>
			</form>
			<button class="d-none" id="cloaseModal" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		let textarea = document.getElementById("postText<?= $post['p_id'] ?>");
		let wordCountDisplay = document.getElementById("wordCount<?= $post['p_id'] ?>");
		let submitButton = document.querySelector("button[type='submit']");
		let maxChars = 500;

		textarea.addEventListener("input", function() {
			let charCount = this.value.length;

			// Update the display
			wordCountDisplay.textContent = `${charCount}/${maxChars}`;

			if (charCount > maxChars) {
				this.value = this.value.substring(0, maxChars); // Trim excess characters
				wordCountDisplay.textContent = `${maxChars}/${maxChars}`;
			}

			// Add 'text-danger' if max limit is exceeded
			if (charCount >= maxChars) {
				wordCountDisplay.classList.add("text-danger");
				submitButton.disabled = true; // Disable submit button
			} else {
				wordCountDisplay.classList.remove("text-danger");
				submitButton.disabled = false; // Enable submit button
			}
		});
	});
</script>