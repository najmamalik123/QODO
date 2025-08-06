<div class="py-4">
	<div class="container">
		<div class="row position-relative">
			<!-- Main Content -->
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="main-content">
					<!-- Feeds -->
					<div class="feeds">
						<!-- Feed Item -->
						<!-- <div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page"> -->
						<div class="bg-white py-2 px-2 feed-item rounded-4 shadow-sm faq-page">
							<div class="row m-0 justify-content-center">
								<?php if ($post['p_image'] != '') {
									$class = 'col-sm-5 col-12'; ?>
									<div class="col-sm-7 col-12 px-0 d-none d-sm-block rounded-4">
										<!-- Image Slider -->
										<div class="image-slider">
											<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
												<div class="carousel-inner">
													<div class="carousel-item active">
														<img src="<?= base_url('assets/avator/upload/' . $post['p_image']) ?>" class="d-block w-100 rounded-4" alt="...">
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php } else {
									$class = 'col-sm-12 col-12 rounded-4';
								} ?>
								<div class="<?= $class ?> content-body px-web-0">
									<div class="d-flex flex-column h-600">
										<div class="d-flex p-3">
											<img src="<?= base_url('assets/mem/' . $post['p_user_id'] . '/img/' . $post['photo']) ?>" class="img-fluid rounded-circle user-img" alt="profile-img" style="height:50px">
											<div class="d-flex align-items-center justify-content-between w-100">
												<a href="<?= base_url('userprofile/' . $post['username']) ?>" class="text-decoration-none ms-3">
													<div class="d-flex align-items-center">
														<h6 class="fw-bold text-body mb-0"><?= $post['name'] ?></h6>
														<?php if ($post['user_status'] == '9') { ?>
															<p class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon mb-0">done</p>
														<?php } ?>
													</div>
													<p class="text-muted mb-0 small">@<?= $post['username'] ?></p>
												</a>
											</div>
										</div>
										<div class="container border-bottom">
											<div class="row">
												<div class="col-12 text-black p-content"><?= formatPostContent($post['p_content']) ?></div>
												<?php if ($post['p_image'] != '') { ?>
													<style>
														.img-post-phone {
															width: 100%;
															height: 300px;
															overflow: hidden;
															display: flex;
															align-items: center;
															justify-content: center;
														}

														.img-post-phone img {
															width: 100%;
															height: 100%;
															object-fit: cover;
														}

														.comments-container {
															max-height: 350px !important;
															overflow-y: auto;
														}
													</style>
													<div class="col-12 my-3 d-sm-none d-block rounded-4">
														<div class="img-post-phone">
															<img src="<?= base_url('assets/avator/upload/' . $post['p_image']) ?>" class="d-block w-100" alt="...">
														</div>
													</div>
												<?php } ?>
											</div>
										</div>
										<div class="comments comments-container p-3" id="comments-<?= $post['p_id'] ?>"></div>

										<div class="border-top p-3 mt-auto">
											<div class="d-flex align-items-center justify-content-between mb-2">
												<div>
													<a href="javascript:void(0)" class="like-btn text-decoration-none d-flex align-items-start fw-light noload text-decoration-none 
               								<?php echo has_liked_post($post['p_id'], @$_SESSION['yid']) ? 'text-primary' : 'text-muted'; ?>"
														data-id="<?= $post['p_id'] ?>">
														<span class="material-icons md-20 me-2">thumb_up_off_alt</span>
														<span class="like-count-<?= $post['p_id'] ?>"><?= ($post['p_likes_count'] == 0) ? '' : $post['p_likes_count'] == 0 ?></span>
													</a>
												</div>
												<div>
													<a href="javascript:void(0)" data-id="<?= $post['p_id'] ?>" class="retweet_btn noload text-decoration-none d-flex align-items-start fw-light <?php echo has_repeated_post($post['p_id'], @$_SESSION['yid']) ? 'text-success' : 'text-muted'; ?>">
														<span class="material-icons md-20 me-2">repeat</span>
														<?= ($post['p_share_count'] == 0) ? '' : $post['p_share_count'] ?>
														<span class="retweet-btn-<?= $post['p_id'] ?>"><?= ($post['p_share_count'] == 0) ? '' : $post['p_share_count'] == 0 ?></span>
													</a>
												</div>
												<div>
													<a href="#" class="text-muted text-decoration-none d-flex align-items-start fw-light"><span class="material-icons md-18 me-2">share</span><span>Share</span></a>
												</div>
											</div>
											<div class="d-flex align-items-center">
												<span class="material-icons bg-white border-0 text-primary pe-2 md-36">account_circle</span>
												<form class="col-11" action="<?= base_url('index.php/action/add_comment') ?>" method="post" id="contactForm" novalidate="novalidate" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/add_comment') ?>',this,'error_div','loder_div','#','1','add_comment');">
													<!-- <form id="comment-form" method="post"> -->
													<div class="d-flex align-items-center border rounded-4 px-3 py-1 w-100 comment-div" id="comment-div"> <!-- make this entire div outline red -->
														<input type="hidden" name="post_id" value="<?= $post['p_id'] ?>">
														<input type="text" class="form-control form-control-sm p-0 rounded-3 fw-light border-0 comment-input" placeholder="Write your comment" name="comment-text">
														<button type="submit" class="bg-white border-0 text-primary ps-2 text-decoration-none post-comment-btn">Post</button>
													</div>
												</form>
											</div>
										</div>
									</div>
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