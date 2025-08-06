<section class="about__area pt-70 pb-10">
   <div class="container">
	  <div class="row justify-content-center">
		 <div class="col-xxl-5 offset-xxl-1 col-xl-6 col-lg-6">
			<div class="about__thumb-wrapper">

			   <!-- <div class="about__review">
				  <h5> <span>8,200+</span> five ster reviews</h5>
			   </div> -->
			   <div class="about__thumb">
				  <img src="<?=base_url('assets/theme/img')?>/about/about.jpg" alt="">
			   </div>
			   <!-- <div class="about__banner mt--210">
				  <img src="<?=base_url('assets/theme/img')?>/about/about-banner.jpg" alt="">
			   </div>
			   <div class="about__student ml-270 mt--80">
				  <a href="#">
					 <img src="<?=base_url('assets/theme/img')?>/about/student-4.jpg" alt="">
					 <img src="<?=base_url('assets/theme/img')?>/about/student-3.jpg" alt="">
					 <img src="<?=base_url('assets/theme/img')?>/about/student-2.jpg" alt="">
					 <img src="<?=base_url('assets/theme/img')?>/about/student-1.jpg" alt="">
				  </a>
				  <p>Join over <span>4,000+</span> students</p>
			   </div> -->
			</div>
		 </div>
		 <div class="col-xxl-6 col-xl-6 col-lg-6">
			<div class="about__content pl-70 pr-60 pt-25">
			   <div class="section__title-wrapper mb-25">
				  <h2 class="section__title">Achieve Success with <br><span class="yellow-bg-big"><?=$site_name?> <img src="<?=base_url('assets/theme/img')?>/shape/yellow-bg-2.png" alt=""></span> </h2>
				  <br><h4>India’s First & Largest Edtech Platform of Ayurveda  </h4>
			   </div>
			   <p><?php $page_data=get_page_data('about','na'); 
					echo trim_text($page_data['content'],300,'...'); ?></p>
			   <a href="<?=base_url('about')?>" class="e-btn e-btn-border">Know More</a>
			</div>
		 </div>
	  </div>
   </div>
</section>