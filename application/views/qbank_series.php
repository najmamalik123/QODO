<?php include('inc/banner.php');?>
<section class="teacher__area pt-35 pb-10">
   <div class="container">
      <div class="row">
         <div class="col-xxl-11 offset-xxl-1">
            <div class="section__title-wrapper text-center mb-60">
               <!-- <p><img src="<?=base_url('assets/avator/')?>logo.png" alt="logo" style='height: 90px;'  ></p> -->
               <?php $c=$cat-1;
               $theCat=$_SESSION['categories'][$c];?>
               <h2><?=@$theCat['name']?></h2>
               <!-- <p><?=@$theCat['desc']?></p> -->
            </div>
         </div>
      </div>
   </div>
</section>
<section class="course__area pb-120">
   <div class="container">
     <div class="row">
      <?php //include_once('inc/qbank_cat_sidebar.php');?>
      <div class="col-xxl-12 col-xl-12 col-lg-12">
         <div class="course__tab-conent">
            <div class="tab-content" id="courseTabContent">
              <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                <div class="row justify-content-center">
                  <?php 
                  if(count($show_series)>'0'){
                  foreach($show_series as $course){
                     //$totalQues=total_series_ques($course['series_id']);?>
                     <!-- <a href="<?=base_url('qbanks?sid=')?><?=$course['series_id']?>"> -->
                     <div class="row border m-0 p-0 mb-3" >
                        <div class="col-12">
                           <div class="text-center green-bg">
                              <h6 style="font-size: 30px;"><?=@$course['series_title']?> </h6>
                           </div>
                        </div>
                        <div class="col-6 border-right text-center border-bottom my-2"><h6>Starts From</h6><span style="color: red"><?=@$course['series_start_date']?></span></div>
                        <div class="col-6 text-center border-bottom my-2"><h6>End On</h6><span style="color: red"><?=@$course['series_start_date']?></span></div>
                        <div class="col-12 border-bottom my-2">
                           <div class="section__title-wrapper text-center">
                              <?=trim_text(strip_tags(@$course['series_desc']),'80', '...')?>
                           </div>
                        </div>
                        <div class="col-4 border-right text-center my-2"><h6>Total Tests</h6><span style="color: red"><?=@$course['series_qbanks_num']?></span></div>
                        <div class="col-4 text-center my-2"><h6>Schedule</h6><span style="color: red"><?php if($course['series_schedule']!=''){?><a href="<?=base_url('assets/avator/upload/series_schedule/')?><?=$course['series_schedule']?>" target="_blank">Schedule</a><?php }?></span></div>
                        <div class="col-4 text-center my-2"><h6>Students Enrolled</h6><span style="color: red"><?=@$course['series_attempted']?></span></div>

                        
                      <div class="col-6">
                        <?php if(isset($_SESSION['yid']) && $_SESSION['yid']==$course['se_user_id']){?>
                         <a class="e-btn mb-2 bg-info  btn-block col-12 text-capitalize" <?php if($course['series_discussion']!=''){?>target="_blank" href="<?=@$course['series_discussion']?>"<?php }else{?> href="#"<?php }?>> <span class="fa fa-comment mr-2"></span> Discussion</a>
                        <?php }?>
                      </div>
                      <div class="col-6">
                       <!-- <span class="e-btn mb-2 bg-primary text-capitalize">Enroll</span> -->
                       <form action="<?=base_url('action/series_enroll')?>" method="post" >
                           <input type="hidden" name="amount" value="<?=$course['series_amount']?>">
                           <input type="hidden" name="cat" value="<?=$course['series_cat']?>">
                           <input type="hidden" name="seriesID" value="<?=$course['series_id']?>">
                           <input type="hidden" name="series_name" value="<?=$course['series_title']?>">
                           <input type="hidden" name="series_start" value="<?=$course['series_start_date']?>">
                           <input type="hidden" name="series_end" value="<?=$course['series_end_date']?>">
                           <?php if(isset($_SESSION['yid']) && $_SESSION['yid']==$course['se_user_id']){?>
                              <a class="e-btn mb-2 bg-primary text-capitalize col-12 btn-block" href="<?=base_url('qbanks?sid=')?><?=$course['series_id']?>&cat=<?=$cat?>">Solve Test</a>
                           <?php }else{?>
                              <button type="submit" class="e-btn mb-2 bg-primary col-12 text-capitalize"> <span class="fa fa-rupee mr-2"></span> Enroll</button>
                           <?php }?>   
                        </form>
                      </div>
                     

                     </div>
                  <!-- </a> -->
                     
                  <?php }}else{echo 'No Series Available';}?>
                </div>
              </div>
            </div>
         </div><?php //echo $this->pagination->create_links(); ?>
       </div>
     </div>
   </div>
</section>