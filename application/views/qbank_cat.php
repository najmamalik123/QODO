<?php include('inc/banner.php');?>
<section class="teacher__area pt-35 pb-30">
   <div class="container">
      <div class="row">
         <div class="col-xxl-6 offset-xxl-3">
            <div class="section__title-wrapper text-center mb-60">
               <!-- <h2 class="section__title">Our Question Bank </h2> -->
               <p><img src="<?=base_url('assets/avator/')?>logo.png" alt="logo" style='height: 90px;'  ></p>
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
                  <?php foreach($show_courses as $course){
                     if($course['display']=='1' && $course['type']=='qbank'){?>
                  <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6">
                     <a href="<?=base_url('qbank-series?cat=')?><?=$course['ctid']?>" class='d-block' >
                        <div class="teacher__item text-center grey-bg-5 transition-3 mb-30" style="min-height:200px;">
                           <div class=" w-img fix">
                              <img src="<?=base_url('assets/avator/upload/')?><?=$course['img']?>" alt="" style='width: 60px;' >
                           </div>
                           <div class="teacher__content" style="font-size: 14px;color: black;font-weight: 600;">
                              <a href="<?=base_url('qbank-series?cat=')?><?=$course['ctid']?>"><?=$course['name']?></a>
                           </div>
                        </div>
                     </a>
                  </div>
                  <?php }}?>
                </div>
              </div>
            </div>
         </div><?php //echo $this->pagination->create_links(); ?>
       </div>
     </div>
   </div>
</section>