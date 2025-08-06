<div class="col-xxl-4 col-xl-4 col-lg-4">
	<div class="course__sidebar pl-70">
	   <div class="course__sidebar-search mb-50">
		  <form action="<?=base_url('action/smart_search')?>" method="get">
			 <input type="text" placeholder="Search for courses..." name="q" value="<?=@$_GET['q']?>">
			 <button type="submit">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 584.4 584.4" style="enable-background:new 0 0 584.4 584.4;" xml:space="preserve">
				   <g>
					  <g>
						 <path class="st0" d="M565.7,474.9l-61.1-61.1c-3.8-3.8-8.8-5.9-13.9-5.9c-6.3,0-12.1,3-15.9,8.3c-16.3,22.4-36,42.1-58.4,58.4    c-4.8,3.5-7.8,8.8-8.3,14.5c-0.4,5.6,1.7,11.3,5.8,15.4l61.1,61.1c12.1,12.1,28.2,18.8,45.4,18.8c17.1,0,33.3-6.7,45.4-18.8    C590.7,540.6,590.7,499.9,565.7,474.9z"/>
						 <path class="st1" d="M254.6,509.1c140.4,0,254.5-114.2,254.5-254.5C509.1,114.2,394.9,0,254.6,0C114.2,0,0,114.2,0,254.5    C0,394.9,114.2,509.1,254.6,509.1z M254.6,76.4c98.2,0,178.1,79.9,178.1,178.1s-79.9,178.1-178.1,178.1S76.4,352.8,76.4,254.5    S156.3,76.4,254.6,76.4z"/>
					  </g>
				   </g>
				</svg>
			 </button>
	   </div>
	   <?php 
	 	$cat=array();
        if(isset($_GET['cat']) && $_GET['cat']!='')
            $cat=@explode(",",$_GET['cat']);
	 	$categories=@$_SESSION['categories'];
	 	if(is_array($categories) && count($categories)>'0'){?>
		   <div class="course__sidebar-widget grey-bg scrollClass">
			  <div class="course__sidebar-info">
				 <h3 class="course__sidebar-title">Categories</h3>
				 <ul>
				 	<?php
				 	foreach($categories as $category){
				 		if(@$category['type']=='courses'){?>
					<li>
					   <div class="course__sidebar-check mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="checkbox" id="m-eng<?=$category['ctid']?>" name="cat[]" value="<?=$category['ctid']?>" <?php if(in_array($category['ctid'], $cat)){echo'checked';} ?>>
						  <label class="m-check-label" for="m-eng<?=$category['ctid']?>"><?=$category['name']?></label>
					   </div>
					</li>
					<?php }}?>
				 </ul>
			  </div>
		   </div>
			<?php }?>
		   <!-- <div class="course__sidebar-widget grey-bg">
			  <div class="course__sidebar-info">
				 <h3 class="course__sidebar-title">Language</h3>
				 <ul>
					<li>
					   <div class="course__sidebar-check mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="checkbox" id="m-all">
						  <label class="m-check-label" for="m-all">All Language</label>
					   </div>
					</li>
					<li>
					   <div class="course__sidebar-check mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="checkbox" id="m-eng-2">
						  <label class="m-check-label" for="m-eng-2">English</label>
					   </div>
					</li>
					<li>
					   <div class="course__sidebar-check mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="checkbox" id="m-russ">
						  <label class="m-check-label" for="m-russ">Russian</label>
					   </div>
					</li>
				 </ul>
			  </div>
		   </div> -->
		   <div class="course__sidebar-widget grey-bg">
			  <div class="course__sidebar-info">
				 <h3 class="course__sidebar-title">Price Filter</h3>
				 <ul>

					<li>
					   <div class="mr-1 mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="radio" id="m-all-course" name="price" value=""<?php if(!isset($_GET['price']) ){echo 'checked';}?> style="margin-right: 10px;">
						  <label class="m-check-label" for="m-all-course">All</label>
					   </div>
					</li>
					<li>
					   <div class="mr-1 mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="radio" id="m-free" name="price" value="0" <?php if(isset($_GET['price']) && $_GET['price']=='0'){echo 'checked';}?> style="margin-right: 10px;">
						  <label class="m-check-label ml" for="m-free">Free Courses</label>
					   </div>
					</li>
					
				 </ul>
			  </div>
		   </div>
		   <!-- <div class="course__sidebar-widget grey-bg">
			  <div class="course__sidebar-info">
				 <h3 class="course__sidebar-title">Skill level</h3>
				 <ul>
					<li>
					   <div class="course__sidebar-check mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="checkbox" id="m-level">
						  <label class="m-check-label" for="m-level">All Levels</label>
					   </div>
					</li>
					<li>
					   <div class="course__sidebar-check mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="checkbox" id="m-beginner">
						  <label class="m-check-label" for="m-beginner">Beginner</label>
					   </div>
					</li>
					<li>
					   <div class="course__sidebar-check mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="checkbox" id="m-intermediate">
						  <label class="m-check-label" for="m-intermediate">Intermediate</label>
					   </div>
					</li>
					<li>
					   <div class="course__sidebar-check mb-10 d-flex align-items-center">
						  <input class="m-check-input" type="checkbox" id="m-expert">
						  <label class="m-check-label" for="m-expert">Expert</label>
					   </div>
					</li>
				 </ul>
			  </div>
		   </div> -->
		   <div class="course__sidebar-widget grey-bg"><button type="submit" class="e-btn"> Search</button></div>
		</form>
	   <div class="course__sidebar-widget grey-bg">
		  <div class="course__sidebar-course">
			 <h3 class="course__sidebar-title">Featured courses</h3>
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
							   <!-- <li><a href="#"> <i class="icon_star"></i> </a></li> -->
							   <?=ratings_star($course['course_rating'], 'star');?>
							</ul>
						 </div>
						 <h5><a href="<?=base_url('search')?>"><?=$course['course_category']?></a></h5>
						 <div class="course__sm-price">
							<span><?=money_show($course['course_price'])?></span>
						 </div>
					  </div>
				   </div>
				</li>
				<?php }	?>
			 </ul>
		  </div>
	   </div>
	</div>
 </div>