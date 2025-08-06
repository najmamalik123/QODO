<!-- Start Single Course  -->
<div class="col-xl-6" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
	<div class="edu-course course-style-4">
		<div class="inner">
			<div class="thumbnail">
				<a href="<?= base_url('course_detail/' . $course_id . '/' . url_smart($course_name)) ?>">
					<div style="width: 140px;height: 140px;overflow: hidden;">
						<img src="<?= base_url('assets/avator/upload/courses/') ?><?= $feat_course['course_img'] ?>" alt="Course Meta" >
					</div>
				</a>
				<div class="time-top">
					<span class="duration"><i class="icon-61"></i><?= $feat_course['course_dur'] ?></span>
				</div>
			</div>
			<div class="content">
				<div class="course-price"><?= money_show($feat_course['course_price']) ?></div>
				<h6 class="title">
					<a href="<?= base_url('course_detail/' . $course_id . '/' . url_smart($course_name)) ?>"><?= $feat_course['course_name'] ?></a>
				</h6>
				<div class="course-rating">
					<div class="rating">
						<?= ratings_star($overall, 'star'); ?>
					</div>
					<span class="rating-count">(<?= $overall; ?> /5 Rating)</span>
				</div>
				<ul class="course-meta">
					<li><i class="icon-24"></i><?= $feat_course['course_lessons'] ?> Lessons</li>
					<li><i class="icon-25"></i><?= $total_students ?> Students</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- End Single Course  -->