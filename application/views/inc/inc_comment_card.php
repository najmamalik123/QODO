<style>
	@media only screen and (min-width: 992px) {
		.p-content {
			padding-left: 18px;
			padding-bottom: 12px;
		}
	}
</style>

<!-- Comment Modal -->
<div class="modal fade" id="commentModal<?= $post['p_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content rounded-4 overflow-hidden border-0">
			<div class="modal-header d-none">
				<h5 class="modal-title" id="exampleModalLabel2">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-0">
				<div class="row m-0">
					<?php if ($post['p_image'] != '') {
						$class = 'col-sm-5 col-12'; ?>
						<div class="col-sm-7 col-12 px-0 d-none d-sm-block">
							<!-- Image Slider -->
							<div class="image-slider">
								<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
									<!-- <div class="carousel-indicators">
										<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
										<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
										<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
									</div> -->
									<div class="carousel-inner">
										<div class="carousel-item active">
											<img src="<?= base_url('assets/avator/upload/' . $post['p_image']) ?>" class="d-block w-100" alt="...">
										</div>
									</div>
									<!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Previous</span>
									</button>
									<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Next</span>
									</button> -->
								</div>
							</div>
						</div>
					<?php } else {
						$class = 'col-sm-12 col-12';
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
									<div class="small dropdown">
										<a href="#" class="text-muted text-decoration-none material-icons ms-2 md-" data-bs-dismiss="modal">close</a>
									</div>
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
										<div class="col-12 my-3 d-sm-none d-block">
											<div class="img-post-phone">
												<img src="<?= base_url('assets/avator/upload/' . $post['p_image']) ?>" class="d-block w-100" alt="...">
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="comments comments-container p-3" id="comments-<?= $post['p_id'] ?>">
								<!-- Comments will be loaded here dynamically -->
							</div>
							<div class="border-top p-3 mt-auto">
								<div class="d-flex align-items-center justify-content-between mb-2">
									<div>
                    					<a href="javascript:void(0)" class="noload text-decoration-none like-btn <?= has_liked_post($post['p_id'], @$_SESSION['yid']) ? 'text-primary' : 'text-muted'; ?> like-btn-count<?= $post['p_id'] ?>" data-id="<?= $post['p_id'] ?>">
                    						<span class="material-icons md-20 me-2">thumb_up_off_alt</span>
                    						<?= ($post['p_likes_count'] == 0) ? '' : $post['p_likes_count'] ?>
                    					</a>
                    				</div>
									<div>
                    					<a href="javascript:void(0)" data-id="<?= $post['p_id'] ?>" class="repeat-btn <?= has_repeated_post($post['p_id'], @$_SESSION['yid']) ? 'text-success' : 'text-muted'; ?> noload text-decoration-none retweet-btn-<?= $post['p_id'] ?>">
                    						<span class="material-icons md-20 me-2">repeat</span>
                    						<?= ($post['p_share_count'] == 0) ? '' : $post['p_share_count'] ?>
                    					</a>
                    				</div>
    								<div>
                                      <a href="javascript:void(0)" class="text-muted text-decoration-none noload" data-bs-toggle="modal" data-bs-target="#shareModal">
                                        <span class="material-icons md-18 me-2">share</span>Share
                                      </a>
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
			<div class="modal-footer d-none">
			</div>
		</div>
	</div>
</div>
