<?php include('inc/banner.php');?>
<section class="teacher__area pt-25 pb-110">
   <div class="container">
      <div class="row">
         <div class="col-xxl-6 offset-xxl-3">
            <div class="section__title-wrapper text-center mb-60">
               <h2 class="section__title">Modes of Content </h2>
               <!-- <p>You don't have to struggle alone, you've got our assistance and help.</p> -->
            </div>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6" style="min-height:200px;">
            <div class="teacher__item text-center grey-bg-5 transition-3 mb-30">
               <div class="teacher__thumb w-img fix">
                  <a href="<?=base_url('qbanks?mode=1&cat=')?><?=$cat?>">
                     <img src="<?=base_url('assets/avator/webimg/AIJPETCT.png')?>" alt="" style='width: 70px;' >
                  </a>
               </div>
               <div class="teacher__content">
                  <h3 class="teacher__title"><a href="<?=base_url('qbanks?mode=1&cat=')?><?=$cat?>">AIJPETCT Mode</a></h3> 
               </div>
            </div>
         </div>
         <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6" style="min-height:200px;">
            <div class="teacher__item text-center grey-bg-5 transition-3 mb-30">
               <div class="teacher__thumb w-img fix">
                  <a href="<?=base_url('qbanks?mode=2&cat=')?><?=$cat?>">
                     <img src="<?=base_url('assets/avator/webimg/AIAPEGT.png')?>" alt="" style='width: 70px;'>
                  </a>
               </div>
               <div class="teacher__content">
                  <h3 class="teacher__title"><a href="<?=base_url('qbanks?mode=2&cat=')?><?=$cat?>">AIAPEGT and Assessment Mode</a></h3> 
               </div>
            </div>
         </div>
         
      </div>
   </div>
</section>