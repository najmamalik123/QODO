               <!-- Start Single Course  -->
               <div class="col-12 col-xl-4 col-lg-6 col-md-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
               	<div class="edu-course course-style-5 inline" data-tipped-options="inline: 'inline-tooltip-<?= $rcid ?>'">
               		<div class="inner">
               			<div class="thumbnail">
               				<a href="<?= $url ?>">
               					<img src="<?= base_url('assets/avator/upload/courses/' . $r_course['course_img']) ?>" alt="Course Meta">
               				</a>
               			</div>
               			<div class="content">
               				<div class="course-price price-round"><?= money_show($r_course['course_price']) ?></div>
               				<span class="course-level"><?= $r_course['name'] ?></span>
               				<h5 class="title">
               					<a href="<?= $url ?>"><?= $r_course['course_name'] ?></a>
               				</h5>
               				<div class="course-rating">
               					<div class="rating">
               						<?= ratings_star($overall, 'star'); ?>
               						<!-- <i class="icon-23"></i>
                                 <i class="icon-23"></i>
                                 <i class="icon-23"></i>
                                 <i class="icon-23"></i>
                                 <i class="icon-23"></i> -->
               					</div>
               					<span class="rating-count">(<?= $overall ?>)</span>
               				</div>
               				<p><?= strip_tags(trim_text($r_course['course_desc'], 70, '...')) ?></p>
               				<ul class="course-meta">
               					<li><i class="icon-24"></i><?= $r_course['course_lessons'] ?> Lessons</li>
               					<li><i class="icon-25"></i>
               						<?php
										$enrollments = $theEnrollments->num_rows();
										if ($enrollments == '0') {
											$enrollments = 'New Course';
										} else {
											$enrollments = $enrollments . ' students';
										}
										echo $enrollments;
										?>
               					</li>
               				</ul>
               			</div>
               		</div>
               	</div>
               </div>
               <!-- End Single Course  -->