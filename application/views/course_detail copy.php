<?php 
$theEnrollments=getEnrolledMembers($id);
?>
<main>
<section class="page__title-area pt-130 pb-90">
   <div class="container">
      <div class="row">
         <div class="col-xxl-8 col-xl-8 col-lg-8">
            <div class="course__wrapper">
               <div class="page__title-content mb-25">
                  <span class="page__title-pre"><?=$thiscourse['course_category']?></span>
                  <h5 class="page__title-3"><?=$thiscourse['course_name']?></h5>
               </div>
               <div class="course__meta-2 d-sm-flex mb-30">
                  <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                     <div class="course__teacher-thumb-3 mr-15">
                        <img src="<?=base_url('assets/avator/favicon_original.png')?>" alt="">
                     </div>
                     <div class="course__teacher-info-3">
                        <h5>Teacher</h5>
                        <p><a href="#">AyuScholar</a></p>
                     </div>
                  </div>
                  <!-- <div class="course__update mr-80 mb-30">
                     <h5>Last Update:</h5>
                     <p>July 24, 2022</p>
                  </div> -->
                  <div class="course__rating-2 mb-30">
                     <h5>Review:</h5>
                     <div class="course__rating-inner d-flex align-items-center">
                        <ul>
                           <?=ratings_star($thiscourse['course_rating'], 'star');?>
                        </ul>
                        <p><?=$thiscourse['course_rating']?></p>
                     </div>
                  </div>
               </div>
               <div class="course__img w-img mb-30">
                  <img src="<?=base_url('assets/avator/upload/courses/')?><?=$thiscourse['course_img']?>" alt="">
               </div>
               <div class="course__tab-2 mb-45">
                  <ul class="nav nav-tabs" id="courseTab" role="tablist">
                     <li class="nav-item" role="presentation">
                       <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true"> <i class="icon_ribbon_alt"></i> <span>Discription</span> </button>
                     </li>
                     
                     <li class="nav-item" role="presentation">
                       <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false"> <i class="icon_star_alt"></i> <span>Reviews</span> </button>
                     </li>
                     <li class="nav-item" role="presentation">
                       <button class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab" aria-controls="member" aria-selected="false"> <i class="fal fa-user"></i> <span>Members</span> </button>
                     </li>
                   </ul>
               </div>
               <div class="course__tab-content mb-95">
                  <div class="tab-content" id="courseTabContent">
                     <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <div class="course__description">
                           <h3>Course Overview</h3>
                           <p><?=$thiscourse['course_desc']?></p>
                           <?php if($thiscourse['course_tags'] !=''){?>
                           <div class="course__tag-2 mb-35 mt-35">
                              <i class="fal fa-tag"></i>
                              <?=@$thiscourse['course_tags']?>
                           </div>
                           <?php }?>
                        </div>
                     </div>
                     
                     <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <?php include_once('review.php');?>
                     </div>
                     <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
                        <div class="course__member mb-45">
                           <?php 
                           $z=0;
                           $enrolled_students=$theEnrollments->result_array();
                           foreach ($enrolled_students as $member) {$z++;
                              if($z<=10){
                           ?>
                           <div class="course__member-item">
                              <div class="row align-items-center">
                                 <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6">
                                    <div class="course__member-thumb d-flex align-items-center">
                                       <img src="<?=base_url('assets/mem/')?><?=$member['mid']?>/img/<?=$member['photo']?>" alt="<?=$member['name']?>">
                                       <div class="course__member-name ml-20">
                                          <h5><?=$member['name']?></h5>
                                          <!-- <span>Engineer</span> -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="course__member-info pl-45">
                                       <h5>Enrolled on: </h5>
                                       <span><?=date_format_1($member['co_start_date'],'1')?></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php } }?>
                        </div>
                     </div>
                     <div class="course__share">
                        <h3>Share :</h3>
                        <ul>
                           <li><a href="#" class="fb"><i class="social_facebook"></i></a></li>
                           <li><a href="#" class="tw"><i class="social_twitter"></i></a></li>
                           <li><a href="#" class="pin"><i class="social_pinterest"></i></a></li>
                        </ul>
                     </div>
                   </div>
               </div>
               <div class="course__related">
                  <div class="row">
                     <div class="col-xxl-12">
                        <div class="section__title-wrapper mb-40">
                           <h2 class="section__title">Featured <span class="yellow-bg yellow-bg-big">Courses<img src="<?=base_url('assets/theme/img')?>/shape/yellow-bg.png" alt=""></span></h2>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xxl-12">
                        <div class="course__slider swiper-container pb-60">
                           <div class="swiper-wrapper">
                              <?php
            $allcourses=$this->db->query("select * from x_edu_courses where course_status='1' and course_featured='1' order by course_id desc  limit 10");
            $fea_courses=$allcourses->result_array();
            foreach($fea_courses as $thecourse){
               $thecourse_url=base_url('course_detail/').$thecourse['course_id'].'/'.$thecourse['course_name'];
            ?>
                              <div class="course__item course__item-3 swiper-slide white-bg mb-30 fix">
                                 <?php include('inc/inc_course_card.php');?>
                              </div>
                              <?php }?>
                           </div>
                           <!-- Add Pagination -->
                           <div class="swiper-pagination"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xxl-4 col-xl-4 col-lg-4">
            <div class="course__sidebar pl-70 p-relative">
               <div class="course__shape">
                  <img class="course-dot" src="<?=base_url('assets/theme/img')?>/course/course-dot.png" alt="">
               </div>
               <div class="course__sidebar-widget-2 white-bg mb-20">
                  <div class="course__video">
                     <div class="course__video-thumb w-img mb-25">
                        <img src="<?=base_url('assets/theme/img')?>/course/video/course-video.jpg" alt="">
                        <div class="course__video-play"> 
                           <?=convertYoutube($thiscourse['course_video'])?>">
                        </div>
                     </div>
                     <div class="course__video-meta mb-25 d-flex align-items-center justify-content-between">
                        <div class="course__video-price">
                           <h5><?php if($thiscourse['course_price']=='0'){ echo 'Free Course';}else{echo money_show($thiscourse['course_price']);}?> </h5>
                        </div>
                     </div>
                     <div class="course__video-content mb-35">
                        <ul>
                           <li class="d-flex align-items-center">
                              <div class="course__video-icon">
                                 <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                    <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z"></path>
                                    <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 "></polyline>
                                 </svg>
                              </div>
                              <div class="course__video-info">
                                 <h5><span>Instructor :</span> Eleanor Fant</h5>
                              </div>
                           </li>
                           <li class="d-flex align-items-center">
                              <div class="course__video-icon">
                                 <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                    
                                    <path class="st0" d="M4,19.5C4,18.1,5.1,17,6.5,17H20"></path>
                                    <path class="st0" d="M6.5,2H20v20H6.5C5.1,22,4,20.9,4,19.5v-15C4,3.1,5.1,2,6.5,2z"></path>
                                 </svg>
                              </div>
                              <div class="course__video-info">
                                 <h5><span>Lectures :</span><?=@$thiscourse['course_lessons']?></h5>
                              </div>
                           </li>
                           <li class="d-flex align-items-center">
                              <div class="course__video-icon">
                                 <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                    <circle class="st0" cx="8" cy="8" r="6.7"></circle>
                                    <polyline class="st0" points="8,4 8,8 10.7,9.3 "></polyline>
                                 </svg>
                              </div>
                              <div class="course__video-info">
                                 <h5><span>Duration :</span><?=$thiscourse['course_dur']?></h5>
                              </div>
                           </li>
                           <li class="d-flex align-items-center">
                              <div class="course__video-icon">
                                 <svg>
                                    <path class="st0" d="M13.3,14v-1.3c0-1.5-1.2-2.7-2.7-2.7H5.3c-1.5,0-2.7,1.2-2.7,2.7V14"></path>
                                    <circle class="st0" cx="8" cy="4.7" r="2.7"></circle>
                                 </svg>
                              </div>
                              <div class="course__video-info">
                                 <?php 
                                 $enrollments=$theEnrollments->num_rows();
                                 if($enrollments=='0'){
                                    $enrollments='New Course';
                                 }else{
                                    $enrollments=$enrollments.' students';
                                 }
                                 ?>
                                 <h5><span>Enrolled :</span><?=$enrollments?></h5>
                              </div>
                           </li>
                           <li class="d-flex align-items-center">
                              <div class="course__video-icon">
                                 <svg>
                                    <circle class="st0" cx="8" cy="8" r="6.7"></circle>
                                    <line class="st0" x1="1.3" y1="8" x2="14.7" y2="8"></line>
                                    <path class="st0" d="M8,1.3c1.7,1.8,2.6,4.2,2.7,6.7c-0.1,2.5-1,4.8-2.7,6.7C6.3,12.8,5.4,10.5,5.3,8C5.4,5.5,6.3,3.2,8,1.3z"></path>
                                 </svg>
                              </div>
                              <div class="course__video-info">
                                 <h5><span>Language :</span><?=$thiscourse['course_lang']?></h5>
                              </div>
                           </li>
                        </ul>
                     </div>
                     <div class="course__payment mb-35">
                        <h3>Payment:</h3>
                        <a href="#">
                           <img src="<?=base_url('assets/theme/img')?>/course/payment/payment-1.png" alt="">
                        </a>
                     </div>
                     <div class="course__enroll-btn">
                        <a href="<?=base_url('checkout?courseID=')?><?=$thiscourse['course_id']?>" class=""> <i class="far fa-arrow-right"></i></a>
                        <form action="<?=base_url('action/enroll')?>" method="post" >
                           <input type="hidden" name="amount" value="<?=$thiscourse['course_price']?>">
                           <input type="hidden" name="courseID" value="<?=$thiscourse['course_id']?>">
                           <input type="hidden" name="courseName" value="<?=$thiscourse['course_name']?>">
                           <?php $course_dur=$thiscourse['course_dur'];
                           $course_end = date( "Y-m-d", strtotime('+'.$course_dur) );?>
                           <input type="hidden" name="course_end" value="<?=$course_end?>">
                           <?php if($material_count>'0' && $thiscourse['course_lessons']>'0' && $enrolled=='0'){?>
                           <button type="submit" class="e-btn e-btn-7 w-100">Enroll</button>
                           <?php }elseif($enrolled=='1'){?>
                           <button type="button" class="e-btn e-btn-7 w-100">Enrolled</button>
                           <?php }else{?>
                           <small style="font-size:11px;">This Course has no Study materials or lectures. </small>
                           <button type="button" class="e-btn bg-info e-btn-7 w-100">Not Available</button>
                           <?php }?>   
                        </form>
                     </div>
                  </div>
               </div>
               <div class="course__sidebar-widget-2 white-bg mb-20">
                  <div class="course__sidebar-course">
                     <h3 class="course__sidebar-title">Related courses</h3>
                     <ul>
                        <?php
            $allcourses=$this->db->query("select * from x_edu_courses where course_status='1' and course_featured='1' order by course_id desc  limit 10");
            $fea_courses=$allcourses->result_array();
            foreach($fea_courses as $course){
               $curl=base_url('course_detail/').$course['course_id'].'/'.$course['course_name'];
            ?>
                        <li>
                           <div class="course__sm d-flex align-items-center mb-30">
                              <div class="course__sm-thumb mr-20">
                                 <a href="<?=$curl?>">
                                    <img src="<?=base_url('assets/avator/upload/courses/')?><?=$course['course_img']?>" alt="">
                                 </a>
                              </div>
                              <div class="course__sm-content">
                                 <div class="course__sm-rating">
                                    <ul>
                                       <?=ratings_star($course['course_rating'], 'star');?>
                                    </ul>
                                 </div>
                                 <h5><a href="<?=base_url('search')?>"><?=$course['course_category']?></a></h5>
                                 <div class="course__sm-price">
                                    <span><?php if($course['course_price']=='0'){ echo 'Free';}else{echo money_show($course['course_price']);}?></span>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <?php }?>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- page title area end -->


<!-- cta area start -->
<section class="cta__area mb--120">
   <div class="container">
      <div class="cta__inner blue-bg fix">
         <div class="cta__shape">
            <img src="<?=base_url('assets/theme/img')?>/cta/cta-shape.png" alt="">
         </div>
         <div class="row align-items-center">
            <div class="col-xxl-7 col-xl-7 col-lg-8 col-md-8">
               <div class="cta__content">
                  <h3 class="cta__title">You can be your own Guiding star with our help</h3>
               </div>
            </div>
            <div class="col-xxl-5 col-xl-5 col-lg-4 col-md-4">
               <div class="cta__more d-md-flex justify-content-end p-relative z-index-1">
                  <a href="<?=base_url('accounts')?>" class="e-btn e-btn-white">Get Started</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- cta area end -->
</main>