<section class="about__area my-2" style="max-height:500px;overflow: hidden;">
			<?php 
			$option=$this->uri->segment(1);	
			if(strpos($option, 'bank')){
				$banner='qbanner';
			}elseif($option=='courses'){
				$banner='cbanner';
			}else{
				$banner='hbanner';
			}

			$banners_data=get_web_img('list',$banner); 
			//echo trim_text($banner_data['img_text'],300,'...'); 

			if(count($banners_data)>'0'){$b=1;
				$bcount=count($banners_data);
			?>
		   <div class="about__thumb">
		   	<!-- Slideshow container -->
				<div class="slideshow-containers" style="white-space: nowrap;">
				  <?php foreach($banners_data as $banner_data){?>
				  <!-- Full-width images with number and caption text -->
				  <div class="mySlides text-center">
				    <!-- <div class="numbertext"><?=$b?> / <?=$bcount?></div> -->
				    <img src="<?=base_url('assets/avator/upload/')?><?=@$banner_data['img_name']?>" alt="" clas='img-fluid' style="width:100%">
				    <div class="text"><?=@$banner_data['img_head']?></div>
				  </div>
				  <?php $b++;}?>
				  <!-- Next and previous buttons -->
				  <!-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				  <a class="next" onclick="plusSlides(1)">&#10095;</a> -->
				</div>
		   </div>
		   <?php }?>
	 <hr/>
</section>
<script type="text/javascript" src="<?=base_url('assets/js/slider_carousel.js')?>"></script>