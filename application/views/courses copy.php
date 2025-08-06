<main>
<section class="services__area pb-40">
  <div class="container">
	<div class="row mt-3">
		<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
			<a href="<?=$app_and?>" target="_blank"><img src="<?=base_url('assets/avator/webimg/app_slider/app_slider1.png')?>" class="img-fluid"></a>
		</div>
		<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
			<a href="<?=$app_and?>" target="_blank"><img src="<?=base_url('assets/avator/webimg/app_slider/app_slider2.png')?>" class="img-fluid"></a>
		</div>
		<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
			<a href="<?=$app_and?>" target="_blank"><img src="<?=base_url('assets/avator/webimg/app_slider/app_slider3.png')?>" class="img-fluid"></a>
		</div>
		<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
			<a href="<?=$app_and?>" target="_blank"><img src="<?=base_url('assets/avator/webimg/app_slider/app_slider4.png')?>" class="img-fluid"></a>
		</div>
	</div>
 </div>
</section>
<section class="cta__area my-5">
   <div class="container">
	  <div class="cta__inner cta__inner-2 blue-bg fix">
		 <div class="cta__shape">
			<img src="<?=base_url('assets/theme/img')?>/cta/cta-shape.png" alt="">
		 </div>
		 <div class="row align-items-center">
			<div class="col-xxl-7 col-xl-7 col-lg-7 col-md-6">
			   <div class="cta__content">
				  <h3 class="cta__title">for Regular Course Download App</h3>
			   </div>
			</div>
			<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6">
			   <div class="cta__apps d-lg-flex justify-content-end p-relative z-index-1">
				  <a target="_blank" href="<?=$app_ios?>" class="mr-10"><i class="fab fa-apple"></i> Apple Store</a>
				  <a target="_blank" href="<?=$app_and?>" class="active"><i class="fab fa-google-play"></i> Play Store</a>
			   </div>
			</div>
		 </div>
	  </div>
   </div>
</section>
<?php include('inc/banner.php');?>
<section class="course__area pb-120">
   <div class="container">
	  <div class="row">
		 <div class="col-xxl-8 col-xl-8 col-lg-8">
			<div class="course__tab-conent">
			   <div class="tab-content" id="courseTabContent">
				  <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
					 <div class="row justify-content-center">
					 	<?php foreach($show_courses as $thecourse){
					 		$thecourse_url=base_url('course_detail/').$thecourse['course_id'].'/'.url_smart($thecourse['course_name']);
					 		echo '<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">';
					 		include('inc/inc_course_card.php');
					 		echo '</div>';
					 		 }?>
					 </div>
				  </div>
				  
				</div>
				
			</div><?php echo $this->pagination->create_links(); ?>
		 </div>

		 <?php include_once('inc/search_filters.php');?>
	  </div>
   </div>
</section>

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
</main>