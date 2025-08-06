						<div class="edu-course course-style-4 course-style-14 mb-sm-4 m">
							<div class="inner">
								<div class="thumbnail" style="width:200px;overflow: hidden;">
									<a href="<?= base_url('course_detail/' . $course_id . '/' . $course_name) ?>">
										<img src="<?= base_url('assets/avator/upload/courses/' . $course['course_img']) ?>" alt="<?= $course['course_name'] ?>">
									</a>
									<div class="time-top">
										<span class="duration"><i class="icon-61"></i><?= $course['course_dur'] ?></span>
									</div>
								</div>
								<div class="content">
									<div class="course-price"><?= money_show($course['course_price']) ?></div>
									<h6 class="title my-0">
										<a href="<?= base_url('course_detail/' . $course_id . '/' . $course_name) ?>"><?= $course['course_name'] ?></a>
									</h6>
									<div class="course-rating my-0">
										<div class="rating">
											<?= ratings_star($course['course_rating'], 'star'); ?>
										</div>
										<span class="rating-count">(<?= $course['course_rating']; ?> /5 Rating)</span>
									</div>
									<?= strip_tags(trim_text($course['course_desc'], 260, '...')) ?>
								</div>
							</div>
						</div>