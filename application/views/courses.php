<div class="edu-course-area course-area-1 section-gap-equal">
	<div class="container">
		<div class="row g-5">
			<?php include('inc/search_filters.php'); ?>
			<div class="col-lg-9 col-pl--35">
				<div class="edu-sorting-area">
					<div class="sorting-left">
						<h6 class="showing-text">We found <span><?= $total_num ?></span> courses available for you</h6>
					</div>
				</div>

				<?php if (count($show_courses) > 0) {
					foreach ($show_courses as $course) {
						$course_id = $course['course_id'];
						$course_name = url_smart($course['course_name']);
						//Total Students
						$total_students = getEnrolledMembers($course_id);
						include('inc/inc_card1.php');
					}
				} ?>
			</div>
		</div>


		<ul class="edu-pagination ">
			<?php echo $this->pagination->create_links(); ?>
		</ul>

	</div>
</div>
<!-- End Course Area -->