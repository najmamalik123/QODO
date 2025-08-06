<div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
	<?php if (!empty($post['retweeted_by'])): ?>
		<small class="text-muted">Reposted by @<?= get_user_name($post['retweeted_by']) ?></small>
	<?php endif; ?>

	<div class="d-flex align-items-center">
		<!-- Profile Image (Left Side) -->
		<div class="me-3">
			<a href="<?= base_url('userprofile/' . $post['username']) ?>" class="text-decoration-none">
				<img src="<?= base_url('assets/mem/' . $post['p_user_id'] . '/img/' . $post['photo']) ?>" class="img-fluid rounded-circle user-img" alt="profile-img" style="width: 40px; height: 40px;">
			</a>
		</div>

		<!-- Right Side Content -->
		<div class="w-100">
			<!-- User Info -->
			<div class="d-flex align-items-center justify-content-between">
				<div class="ms-0">
					<a href="<?= base_url('userprofile/' . $post['username']) ?>" class="text-decoration-none">
						<h6 class="mb-0 d-flex align-items-start text-body fs-6 fw-bold"><?= $post['name'] ?>
							<?php if ($post['user_status'] == '9') { ?>
								<span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
							<?php } ?>
						</h6>
						<p class="text-muted mb-0">@<?= $post['username'] ?></p>
					</a>
				</div>

				<div class="d-flex align-items-center small">
					<p class="text-muted mb-0"><?= date("d M", strtotime($post['p_created'])) ?></p>
					<?php if (isset($_SESSION['yid']) && $_SESSION['yid'] == $post['p_user_id']) { ?>
						<div class="dropdown">
							<a href="javascript:void(0)" class="noload text-muted text-decoration-none material-icons ms-2 md-20 rounded-circle bg-light p-1" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">more_vert</a>
							<ul class="dropdown-menu fs-13 dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
								<!--<li><span class="dropdown-item text-muted" data-bs-toggle="modal" data-bs-target="#postModalEdit<?= $post['p_id'] ?>"><span class="material-icons md-13 me-1">edit</span>Edit</span></li>-->
								<li><a class="dropdown-item text-muted" href="<?= base_url('action/delete_post/' . $post['p_id']) ?>"><span class="material-icons md-13 me-1">delete</span>Delete</a></li>
							</ul>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="d-flex">
		<div class="w-100">

			<!-- Post Content (Starts Below Profile Image) -->
			<div class="mt-2">
				<p class="mb-3 text-black"><?= formatPostContent($post['p_content']) ?></p>
				<?php if (!empty($post['p_image'])) { ?>
					<a href="javascript:void(0)" class="noload" onclick="openModal(<?= $post['p_id'] ?>)">
						<img src="<?= base_url('assets/avator/upload/' . $post['p_image']) ?>" class="img-fluid rounded mb-3" alt="post-img">
					</a>
				<?php } ?>
				<?php if (!empty($post['p_video'])) { ?>
                    <a href="javascript:void(0)" class="noload" onclick="openModal(<?= $post['p_id'] ?>)">
                        <video class="img-fluid w-100 rounded mb-3" controls>
                            <source src="<?= base_url('assets/avator/upload/' . $post['p_video']) ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </a>
                <?php } ?>
			</div>
			<!-- Display Poll if Available -->
			<?php if ($post['is_poll'] == 1 && !empty($post['poll_data'])): ?>
				<?php
				$poll_id = $post['p_id'];
				$polls_options = $this->db->query("SELECT * FROM x_polls WHERE post_id = ?", [$poll_id])->result_array();
				// $poll_options = json_decode($post['poll_data'], true);
				?>
				<div class="mt-3">
					<strong>Poll:</strong>

					<?php if (isset($_SESSION['yid'])): ?>
						<?php
						$yid = $_SESSION['yid'];
						$user_voted = $this->db->query("SELECT * FROM x_votes WHERE user_id ='$yid' AND post_id = ?", [$poll_id])->row();

						if ($user_voted) {
							// User has already voted - Display results
							$total_votes = $this->db->select_sum('votes')
								->where('post_id', $poll_id)
								->get('x_polls')
								->row()
								->votes;

							foreach ($polls_options as $option):
								// Fetching the vote count directly from the x_polls table
								$option_votes = $option['votes'];
								$percentage = ($total_votes > 0) ? round(($option_votes / $total_votes) * 100, 2) : 0;
								$user_voted_option = ($user_voted->option_id == $option['id']);
						?>

								<div class="d-flex align-items-center mb-2">
									<div class="w-100">
										<div class="progress" style="height: 20px;">
											<div class="progress-bar <?= $user_voted_option ? 'bg-success' : 'bg-primary' ?>"
												role="progressbar"
												style="width: <?= $percentage ?>%;"
												aria-valuenow="<?= $percentage ?>"
												aria-valuemin="0"
												aria-valuemax="100">
												<?= $option['option_text'] ?> - <?= $percentage ?>% (<?= $option_votes ?> votes)
											</div>
										</div>
									</div>
								</div>

							<?php endforeach; ?>

							<p class="text-muted mt-2">Total Votes: <?= $total_votes ?></p>

						<?php } else { ?>
							<!-- User has not voted - Display voting form -->
							<form method="POST" action="<?= base_url('action/vote_poll') ?>">
								<input type="hidden" name="post_id" value="<?= $poll_id ?>">

								<?php foreach ($polls_options as $option): ?>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="poll_option" value="<?= $option['id'] ?>" id="option_<?= $poll_id ?>_<?= md5($option['option_text']) ?>">
										<label class="form-check-label" for="option_<?= $poll_id ?>_<?= md5($option['option_text']) ?>">
											<?= $option['option_text'] ?>
										</label>
									</div>
								<?php endforeach; ?>

								<button type="submit" class="btn btn-primary mt-2 rounded-pill">Vote</button>
							</form>
						<?php } ?>
					<?php else: ?>
						<p class="text-muted">Please <a href="<?= base_url('login') ?>">log in</a> to participate in the poll.</p>
					<?php endif; ?>
				</div>


			<?php endif; ?>

			<!-- Buttons Section -->
			<div class="d-flex align-items-center justify-content-between mb-2">
				<div>
					<a href="javascript:void(0)" class="noload text-decoration-none like-btn <?= has_liked_post($post['p_id'], @$_SESSION['yid']) ? 'text-primary' : 'text-muted'; ?> like-btn-count<?= $post['p_id'] ?>" data-id="<?= $post['p_id'] ?>">
						<span class="material-icons md-20 me-2">thumb_up_off_alt</span>
						<?= ($post['p_likes_count'] == 0) ? '' : $post['p_likes_count'] ?>
					</a>
				</div>
				<div>
					<a href="javascript:void(0)" onclick="openModal(<?= $post['p_id'] ?>)" class="text-muted noload text-decoration-none comment-btn-count<?= $post['p_id'] ?>">
						<span class="material-icons md-20 me-2">chat_bubble_outline</span>
						<?= ($post['p_comments_count'] == 0) ? '' : $post['p_comments_count'] ?>
					</a>
				</div>
				<div>
					<a href="javascript:void(0)" data-id="<?= $post['p_id'] ?>" class="repeat-btn <?= has_repeated_post($post['p_id'], @$_SESSION['yid']) ? 'text-success' : 'text-muted'; ?> noload text-decoration-none retweet-btn-<?= $post['p_id'] ?>">
						<span class="material-icons md-20 me-2">repeat</span>
						<?= ($post['p_share_count'] == 0) ? '' : $post['p_share_count'] ?>
					</a>
				</div>
				<!-- Share Button -->
                <div>
                  <a href="javascript:void(0)" class="text-muted text-decoration-none noload" data-bs-toggle="modal" data-bs-target="#shareModal">
                    <span class="material-icons md-18 me-2">share</span>Share
                  </a>
                </div>
                
               

			</div>
		</div>
	</div>
</div>