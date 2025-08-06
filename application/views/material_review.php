<div class="course__review">
   <h3>Doubts</h3>
   <p>Gosh william I'm telling crikey burke I don't want no agro A bit of how's your father bugger all mate off his nut that, what a plonker cuppa owt to do</p>
   <?php if(count($all_reviews_are)>'0'){?>
   <div class="course__comment mb-75">
      <h3>Total <?=count($all_reviews_are)?> Doubts</h3>
      <ul>
         <?php 
         $z=0;
         foreach($all_reviews_are as $review){$z++;if($z<4){
         ?>
         <li>
            <div class="course__comment-box ">
               <div class="course__comment-thumb float-start">
                  <img src="<?=base_url('assets/mem/')?><?=$review['mid']?>/img/<?=$review['photo']?>" alt="">
               </div>
               <div class="course__comment-content">
                  <div class="course__comment-wrapper ml-70 fix">
                     <div class="course__comment-info float-start">
                        <h4><?=$review['name']?></h4>
                        <span><?=date_format_1($review['mr_date'], '1')?></span>
                     </div>
                  </div>
                  <div class="course__comment-text ml-70">
                     <p><?=trim_text($review['mr_message'], 100, '...')?></p>
                  </div>
                  <?php if($review['mr_reply']!=''){?>
                  <div class="course__comment-text ml-70">
                     <p>Reply: <?=trim_text(strip_tags(@$review['mr_reply']), 100, '...')?></p>
                  </div>
                  <?php }?>
               </div>
            </div>
         </li>
         <?php } }?>
      </ul>
   </div>
   <?php }?>
   <div class="course__form">
      <h3>Ask your Doubt</h3>
      <div class="course__form-inner">
         <form method="post" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/post_review') ?>',this,'error_div','loder_div','#','1','doubt');" class="js-validate">
            <input type="hidden" name="type" value="rmaterial">
            <input type="hidden" name="type_id" value="<?=@$enrol?>">
            <input type="hidden" name="smid" value="<?=@$smid?>">
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
                     <textarea class="form-control" rows="3" name="desc"></textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xxl-12">
                  <div class="course__form-btn mt-10 mb-55">
                     <button type="submit" class="e-btn">Ask Doubt</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>