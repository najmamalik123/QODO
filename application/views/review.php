<!-- New  -->
<div class="course-tab-content">
   <div class="course-review">
      <h3 class="heading-title">Course Rating</h3>
      <p><?= $overall ?> average rating based on 5 rating</p>
      <div class="row g-0 align-items-center">
         <div class="col-sm-4">
            <div class="rating-box">
               <div class="rating-number"><?= $overall ?></div>
               <div class="rating">
                  <i class="icon-23"></i>
                  <i class="icon-23"></i>
                  <i class="icon-23"></i>
                  <i class="icon-23"></i>
                  <i class="icon-23"></i>
               </div>

               <span>(<?= $overall; ?> Review)</span>
            </div>
         </div>
         <div class="col-sm-8">
            <div class="review-wrapper">
               <?php for ($r = 5; $r > 0; $r--) {
                  $count = get_review_count($all_reviews_are, $r);
                  if ($review_count == '0') {
                     $review_per = '0';
                  } else {
                     $review_per = ($count / $review_count) * 100;
                  } ?>
                  <div class="single-progress-bar">
                     <div class="rating-text">
                        <?= $r ?> <i class="icon-23"></i>
                     </div>
                     <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?= $review_per ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                     <span class="rating-value"><?= $review_per ?>%</span>
                  </div>
               <?php } ?>
            </div>
         </div>
      </div>

      <!-- Start Comment Area  -->
      <?php if (count($all_reviews_are) > 0) { ?>
         <div class="comment-area">
            <h3 class="heading-title">Reviews</h3>
            <div class="comment-list-wrapper">
               <!-- Start Single Comment  -->
               <?php foreach ($all_reviews_are as $review) { ?>
                  <div class="comment">
                     <div class="thumbnail">
                        <img src="<?= base_url('assets/mem/' . $review['cr_user'] . '/img/' . $review['photo']) ?>" alt="Comment Images">
                     </div>
                     <div class="comment-content">
                        <div class="rating">

                        </div>
                        <h5 class="title"><?= $review['cr_name'] ?></h5>
                        <!-- <span class="date">Oct 10, 2021</span> -->
                        <span class="date"><?= date('M d, Y') ?></span>
                        <p><?= $review['cr_message'] ?></p>
                     </div>
                  </div>
               <?php } ?>
               <!-- End Single Comment  -->
            </div>
         </div>
      <?php } ?>
      <!-- End Comment Area  -->
      <div class="comment-form-area">
         <h3 class="heading-title">Write a Review</h3>
         <form method="post" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/post_review') ?>',this,'error_div','loder_div','#','1','posted');" class="comment-form">

            <input type="hidden" name="type" value="review">
            <input type="hidden" name="type_id" value="<?= @$id ?>">
            <input type="hidden" name="rating" id="rating" value="">


            <div class="rating-icon">
               <h6 class="title">Rating Here</h6>
               <div class="rating">
                  <?php for ($r = 1; $r <= 5; $r++) { ?>
                     <i class="icon-23" id="star<?= $r ?>" onmouseover="rating_stars(<?= $r ?>);"></i>
                  <?php } ?>
                  <!-- <i class="icon-23"></i>
                  <i class="icon-23"></i>
                  <i class="icon-23"></i>
                  <i class="icon-23"></i>
                  <i class="icon-23"></i> -->
               </div>
            </div>
            <div class="row g-5">
               <div class="form-group col-lg-6">
                  <input type="text" name="name" id="comm-name" value="<?= @$_SESSION['name'] ?>" placeholder="Reviewer name">
               </div>
               <div class="form-group col-lg-6">
                  <input type="email" name="email" id="comm-email" value="<?= @$_SESSION['email'] ?>" placeholder="Reviewer email">
               </div>
               <div class="form-group col-12">
                  <textarea name="desc" id="comm-message" cols="30" rows="5" placeholder="Review summary"></textarea>
               </div>
               <div class="form-group col-12">
                  <button type="submit" class="edu-btn submit-btn">Submit Review <i class="icon-4"></i></button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>