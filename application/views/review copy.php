<div class="course__review">
   <h3>Reviews</h3>
   <p>Gosh william I'm telling crikey burke I don't want no agro A bit of how's your father bugger all mate off his nut that, what a plonker cuppa owt to do</p>

   <div class="course__review-rating mb-50">
      <div class="row g-0">
         <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="course__review-rating-info grey-bg text-center">
               <h5><?php echo $overall = get_overall_rating($all_reviews_are, $review_count); ?></h5>
               <ul>
                  <?= ratings_star($overall, 'star') ?>
               </ul>
               <p><?= $review_count ?> Ratings</p>
            </div>
         </div>
         <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8">
            <div class="course__review-details grey-bg">
               <h5>Detailed Rating</h5>
               <div class="course__review-content mb-20">
                  <?php for ($r = 5; $r > 0; $r--) {
                     $count = get_review_count($all_reviews_are, $r);
                     if ($review_count == '0') {
                        $review_per = '0';
                     } else {
                        $review_per = ($count / $review_count) * 100;
                     } ?>
                     <div class="course__review-item d-flex align-items-center justify-content-between">
                        <div class="course__review-text">
                           <span><?= $r ?> stars</span>
                        </div>
                        <div class="course__review-progress">
                           <div class="single-progress" data-width="<?= $review_per ?>%"></div>
                        </div>
                        <div class="course__review-percent">
                           <h5><?= number_format($review_per, 2) ?>%</h5>
                        </div>
                     </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php if (count($all_reviews_are) > '0') { ?>
      <div class="course__comment mb-75">
         <h3>Total <?= count($all_reviews_are) ?> Reviews</h3>

         <ul>
            <?php
            $z = 0;
            foreach ($all_reviews_are as $review) {
               $z++;
               if ($z < 4) {
            ?>
                  <li>
                     <div class="course__comment-box ">
                        <div class="course__comment-thumb float-start">
                           <img src="<?= base_url('assets/mem/') ?><?= $review['mid'] ?>/img/<?= $review['photo'] ?>" alt="">
                        </div>
                        <div class="course__comment-content">
                           <div class="course__comment-wrapper ml-70 fix">
                              <div class="course__comment-info float-start">
                                 <h4><?= $review['name'] ?></h4>
                                 <span><?= date_format_1($review['cr_date'], '1') ?></span>
                              </div>
                              <div class="course__comment-rating float-start float-sm-end">
                                 <ul>
                                    <?= ratings_star($review['cr_rating'], 'star') ?>
                                 </ul>
                              </div>
                           </div>
                           <div class="course__comment-text ml-70">
                              <p><?= trim_text($review['cr_message'], 100, '...') ?></p>
                           </div>
                        </div>
                     </div>
                  </li>
            <?php }
            } ?>
         </ul>
      </div>
   <?php } ?>
   <div class="course__form">
      <h3>Write a Review</h3>
      <div class="course__form-inner">
         <form method="post" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/post_review') ?>',this,'error_div','loder_div','#','1','posted');" class="js-validate">
            <input type="hidden" name="type" value="review">
            <input type="hidden" name="type_id" value="<?= @$id ?>">
            <input type="hidden" name="rating" id="rating" value="">
            <div class="row">
               <div class="col-xxl-6">
                  <div class="course__form-input">
                     <input type="text" placeholder="Your Name" name="name" value="<?= @$_SESSION['name'] ?>">
                  </div>
               </div>
               <div class="col-xxl-6">
                  <div class="course__form-input">
                     <input type="email" placeholder="Your Email" name="email" value="<?= @$_SESSION['email'] ?>">
                  </div>
               </div>

               <div class="col-xxl-12">
                  <div class="course__form-input">
                     <div class="course__form-rating">
                        <span>Rating : </span>
                        <ul>
                           <!-- <li><a href="#"> <i class="icon_star"></i> </a></li>
                           <li><a href="#"> <i class="icon_star"></i> </a></li>
                           <li><a href="#"> <i class="icon_star"></i> </a></li>
                           <li><a href="#" class="no-rating"> <i class="icon_star"></i> </a></li>
                           <li><a href="#" class="no-rating"> <i class="icon_star"></i> </a></li> -->
                           <?php for ($r = 1; $r <= 5; $r++) { ?>
                              <li class="icon_star" id="star<?= $r ?>" onmouseover="rating_stars(<?= $r ?>);"></li>
                           <?php } ?>
                        </ul>
                     </div>
                     <textarea class="form-control" rows="3" name="desc"></textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xxl-12">
                  <div class="course__form-btn mt-10 mb-55">
                     <button type="submit" class="e-btn">Add Review</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>