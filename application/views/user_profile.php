<div class="py-4">
	<div class="container-fluid">
		<div class="row position-relative">
			<!-- Main Content -->
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="main-content">
					<div class="mb-4 d-flex align-items-center">
						<div class="d-flex align-items-center">
							<a href="javascript:history.back()" class="material-icons text-dark text-decoration-none m-none me-3">
								arrow_back
							</a>
							<?php if ($profile_data) { ?>
								<p class="ms-2 mb-0 fw-bold text-body fs-6"><?= $profile_data['name'] ?></p>
							<?php } ?>
						</div>
						<!-- <a href="#" class="text-decoration-none material-icons md-20 ms-auto text-muted">share</a> -->
					</div>
					<div class="bg-white rounded-4 shadow-sm profile">
						<div class="d-flex align-items-center px-3 pt-3">
							<?php if ($profile_data['photo']) {
								$imageUrl = base_url('assets/mem/' . $profile_data['mid'] . '/img/' . $profile_data['photo']);
							} else {
								$imageUrl = base_url('assets/avator/noprofile.png');
							} ?>
							<img src="<?= $imageUrl ?>" class="img-fluid rounded-circle" alt="profile-img">
							<?php if ($profile_data) { ?>
								<div class="ms-3">
									<h6 class="mb-0 d-flex align-items-start text-body fs-6 fw-bold"><?= $profile_data['name'] ?>
										<?php if ($profile_data['user_status'] == '9') { ?>
											<span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
										<?php } ?>
									</h6>
									<p class="text-muted mb-0 <?= ($profile_data['username'] != '') ? '' : 'd-none' ?>">@<?= $profile_data['username'] ?></p>
								</div>
								<div class="ms-auto btn-group" role="group">
								    <?php $chat = rand(0000,99999); ?>
								    <a href="<?= base_url('message') ?>?chat=<?= $chat ?>&user=<?= $profile_data['mid'] ?>">
										<label class="btn btn-outline-primary btn-sm px-3 rounded-pill" >
											<span class="follow">Message</span>
										</label>
										</a>
									</div>
								<?php if (@$_SESSION['yid'] != $profile_data['mid']) { ?>
									<div class="ms-auto btn-group" role="group">
										<input type="checkbox" class="btn-check follow-toggle" id="followBtn<?= $profile_data['mid'] ?>" data-user-id="<?= $profile_data['mid'] ?>" <?= favourite_me_user($profile_data['mid']) ? 'checked' : '' ?>>
										<label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="followBtn<?= $profile_data['mid'] ?>">
											<span class="follow <?= favourite_me_user($profile_data['mid']) ? 'd-none' : '' ?>">+ Follow</span>
											<span class="following <?= favourite_me_user($profile_data['mid']) ? '' : 'd-none' ?>">Following</span>
										</label>
									</div>
								<?php } ?>
							<?php } else { ?>
								<h4 class="m-auto text-dark">This user doesn't exist.</h4>
							<?php } ?>
						</div>
						<?php if ($profile_data) { ?>
							<div class="p-3">
								<p class="mb-2 fs-6"><?= $profile_data['about'] ?></p>
								<p class="d-flex align-items-center mb-3">
									<span class="material-icons me-2 rotate-320 text-muted md-16">link</span><a href="<?= base_url('userprofile/' . $profile_data['username']) ?>" class="text-decoration-none">profile/<?= $profile_data['username'] ?></a>
									<span class="material-icons me-2 text-muted md-16 ms-4">calendar_today</span><span>Joined on <span class="d-block d-sm-none"></span> <?= date_format_1($profile_data['date'], 'alpha_month_year') ?> </span>
								</p>
								<div class="d-flex followers" id="followers">
									<div>
										<p class="mb-0"><?= get_followers_count($profile_data['mid']) ?> <span class="text-muted">Followers</span></p>

									</div>
									<div class="ms-5 ps-5">
										<p class="mb-0"><?= get_following_count($profile_data['mid']) ?> <span class="text-muted">Following</span></p>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<?php if ($profile_data) { ?>
						<?php include('inc/_userprofile_menu.php'); ?>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
								<!-- Follow People -->
								<div class="ms-1">
									<!-- Feeds -->
									<!-- <div class="feeds" id="postContainer">
								</div> -->
									<div class="feeds">
										<!-- Feed Item -->
										<?php if (count($posts) > 0) {
											foreach ($posts as $post) {
												include('inc/inc_main_post_card.php');
												include('inc/inc_comment_card.php');
												include('inc/inc_post_card_edit.php');
											}
										} else { ?>
											<div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm d-flex justify-content-center align-items-center text-center" style="min-height: 50px;">
												<p class="text-dark m-0">No post found</p>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</main>
			<?php include 'inc/_lsidebar.php' ?>
			<?php include 'inc/_rsidebar.php' ?>
		</div>
	</div>
</div>

<!-- <script>
	$(document).ready(function() {
		let offset = 0;
		let limit = 5;
		let isLoading = false;

		function loadPosts() {
			if (isLoading) return;
			isLoading = true;
			$("#loader").show();

			$.ajax({
				url: "<?= base_url('main/fetch_my_posts') ?>",
				type: "POST",
				data: {
					offset: offset
				},
				dataType: "json",
				success: function(response) {
					if (response.length > 0) {
						response.forEach(post => {
							let postHTML = `
                            <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                                <div class="d-flex">
                                    <img src="<?= base_url('home') ?>${post.user_image}" class="img-fluid rounded-circle user-img" alt="profile-img">
                                    <div class="d-flex ms-3 align-items-start w-100">
                                        <div class="w-100">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <a href="#" class="text-decoration-none d-flex align-items-center">
                                                    <h6 class="fw-bold mb-0 text-body">${post.name}</h6>
                                                    <small class="text-muted ms-2">@${post.username}</small>
                                                </a>
                                            </div>
                                            <div class="my-2">
                                                <p class="mb-3 text-primary">${post.p_content}</p>
                                                <img src="${post.p_image ? '<?= base_url('assets/avator/upload/') ?>' + post.p_image : '<?= base_url('assets/avator/default.jpg') ?>'}" class="img-fluid rounded mb-3" alt="post-img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
							$("#postContainer").append(postHTML);
						});

						offset += limit;
					}
					isLoading = false;
					$("#loader").hide();
				}
			});
		}

		loadPosts();

		$(window).scroll(function() {
			if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
				loadPosts();
			}
		});
	});
</script> -->