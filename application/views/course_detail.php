<?php
$theEnrollments = getEnrolledMembers($id);
$overall = get_overall_rating($all_reviews_are, $review_count);
$theoption = $this->uri->segment(1);
?>

<!--=====================================-->
<!--=       Breadcrumb Area Start      =-->
<!--=====================================-->


<div class="edu-breadcrumb-area breadcrumb-style-3">
   <div class="container">
      <div class="breadcrumb-inner pt-4">
         <div class="page-title">
            <h1 class="title text_shadow"><?= $thiscourse['course_name'] ?></h1>
         </div>
         <ul class="course-meta">
            <li><i class="icon-58 text_shadow"></i>by <?= $site_name ?></li>
            <li><i class="icon-59"></i><?= $thiscourse['course_lang'] ?></li>
            <li class="course-rating">
               <div class="rating">
                  <?= ratings_star($overall, 'star'); ?>
               </div>
               <span class="rating-count">(<?= $overall ?> Rating)</span>
            </li>
         </ul>

         <div class="col-sm-8" style="color:#000;font-size: 14px;">
            We provide complete course in real Time with Practical training and on LIVE platforms, We do not care much about theory, All Live Practical knowledge on latest tech will get you direct to working experience. 
         </div>

         <hr/>
         <form action="<?= base_url('action/enroll') ?>" method="post">
            <input type="hidden" name="amount" value="<?= $thiscourse['course_price'] ?>">
            <input type="hidden" name="courseID" value="<?= $thiscourse['course_id'] ?>">
            <input type="hidden" name="courseName" value="<?= $thiscourse['course_name'] ?>">
            <?php $course_dur = $thiscourse['course_dur'];
            $course_end = date("Y-m-d", strtotime('+' . $course_dur)); ?>
            <input type="hidden" name="course_end" value="<?= $course_end ?>">
            <button type="submit" class="edu-btn px-5">  Enroll Now</button>
         </form>

      </div>
   </div>
   <ul class="shape-group">
      <li class="shape-1">
         <span></span>
      </li>
      <li class="shape-2 scene"><img data-depth="2" src="<?= base_url('assets/theme/nodlys/images/about') ?>/shape-13.png" alt="shape"></li>
      <li class="shape-3 scene"><img data-depth="-2" src="<?= base_url('assets/theme/nodlys/images/about') ?>/shape-15.png" alt="shape"></li>
      <li class="shape-4">
         <span></span>
      </li>
      <li class="shape-5 scene"><img data-depth="2" src="<?= base_url('assets/theme/nodlys/images/about') ?>/shape-07.png" alt="shape"></li>
   </ul>
</div>
<!--=====================================-->
<!--=     Courses Details Area Start    =-->
<!--=====================================-->
<section class="edu-section-gap course-details-area pt-0">
   <div class="container">
      <div class="row row--30">
         <div class="col-lg-8">
            <div class="course-details-content text-left">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
                  </li>

                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Reviews</button>
                  </li>
               </ul>

               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                     <div class="course-tab-content">
                        <div class="course-overview">
                           <h3 class="heading-title">Course Description</h3>
                           <?= $thiscourse['course_desc'] ?>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                     <?php include('review.php') ?>
                  </div>
               </div>
            </div>

            <?php if (count($related_courses) > 0) { ?>
               <div class="row">
                     <div class="section-title section-left my-0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <h3 class="title mb-0 mt-3">More Courses for You</h3>
                        <small>Similer Skills you may learn.</small>
                     </div>
                     <?php foreach ($related_courses as $course) {
                        $course_id = $course['course_id'];
                        $course_name = url_smart($course['course_name']);
                        //Total Students
                        $total_students = getEnrolledMembers($course_id);
                        include('inc/inc_card1.php');
                     } ?>
               </div>
            <?php } ?>

         </div>
         <div class="col-lg-4  pt-sm-5">
            <div class="course-sidebar-3 sidebar-top-position  pt-sm-5">
               <div class="edu-course-widget widget-course-summery">
                  <div class="inner">
                     <div class="thumbnail">
                        <img src="<?= base_url('assets/avator/upload/courses/'.$thiscourse['co_img_2']) ?>" alt="Courses">
                        <a href="<?= $thiscourse['course_video'] ?>" class="play-btn video-popup-activation"><i class="icon-18"></i></a>
                     </div>
                     <div class="content">
                        <h4 class="widget-title">Course Includes:</h4>
                        <ul class="course-item">
                           <li>
                              <span class="label"><i class="icon-60"></i>Price:</span>
                              <span class="value price"><?= money_show($thiscourse['course_price']) ?></span>
                           </li>
                           <li>
                              <span class="label"><i class="icon-62"></i>Instrutor:</span>
                              <span class="value"><?= $site_name ?></span>
                           </li>
                           <li>
                              <span class="label"><i class="icon-61"></i>Duration:</span>
                              <span class="value"><?= $thiscourse['course_dur'] ?></span>
                           </li>
                           <li>
                              <span class="label">
                                 <img class="svgInject" src="<?= base_url('assets/theme/nodlys/images/svg-icons/') ?>books.svg" alt="book icon">
                                 Total Classes</span>
                              <span class="value"><?= $thiscourse['course_lessons'] ?></span>
                           </li>
                           <li>
                              <span class="label"><i class="icon-63"></i>Enrolled:</span>
                              <span class="value">
                                 <?php
                                 $enrollments = $theEnrollments->num_rows();
                                 if ($enrollments == '0') {
                                    $enrollments = 'New Course';
                                 } else {
                                    $enrollments = $enrollments . ' students';
                                 }
                                 echo $enrollments;
                                 ?>
                              </span>
                           </li>
                           <li>
                              <span class="label"><i class="icon-59"></i>Language:</span>
                              <span class="value"><?= $thiscourse['course_lang'] ?></span>
                           </li>
                           <!-- <li>
                              <span class="label"><i class="icon-64"></i>Certificate:</span>
                              <span class="value">Yes</span>
                           </li> -->
                        </ul>
                        <div class="read-more-btn">
                           <?php //echo add_tocart('Add to cart', $thiscourse['course_id']) 
                           ?>
                           <!-- <a href="<?= base_url('checkout?courseID=') ?><?= $thiscourse['course_id'] ?>" class="edu-btn">Start Now <i class="icon-4"></i></a> -->
                           <form action="<?= base_url('action/enroll') ?>" method="post">
                              <input type="hidden" name="amount" value="<?= $thiscourse['course_price'] ?>">
                              <input type="hidden" name="courseID" value="<?= $thiscourse['course_id'] ?>">
                              <input type="hidden" name="courseName" value="<?= $thiscourse['course_name'] ?>">
                              <?php $course_dur = $thiscourse['course_dur'];
                              $course_end = date("Y-m-d", strtotime('+' . $course_dur)); ?>
                              <input type="hidden" name="course_end" value="<?= $course_end ?>">
                              <button type="submit" class="edu-btn px-5">Enroll</button>
                           </form>
                        </div>
                        <div class="share-area">
                           <h4 class="title">Share On:</h4>
                           <ul class="social-share">
                              <li><a href="#"><i class="icon-facebook"></i></a></li>
                              <li><a href="#"><i class="icon-twitter"></i></a></li>
                              <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                              <li><a href="#"><i class="icon-youtube"></i></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
