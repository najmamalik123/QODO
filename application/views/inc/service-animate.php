		<link rel='stylesheet' type='text/css' href="<?=$flink?>/addons/animation/jquery.kwicks.css" />
		<ul class='kwicks kwicks-vertical'>
			<li>
				<ul class='kwicks kwicks-horizontal'>
					<li>
                    <img src="avator/laptoprepair.jpg" class='theanimated_image'/>
                    </li><li>
                    <img src="avator/cache_3747165904.jpg" class='theanimated_image'/>
                    </li><li><img src="avator/laptoprepair.webp" class='theanimated_image'/></li>
				</ul>
			</li>
			<li>
				<ul class='kwicks kwicks-horizontal'>
					<li>
                    <img src="avator/MTTC growth.jpg" class='theanimated_image'/>
                    </li><li>
                    <img src="avator/free_pick_up_and_drop_off_0.png" class='theanimated_image'/>
                    </li><li><img src="avator/cmsImage.jpg" class='theanimated_image'/></li>
				</ul>
			</li>
			<li>
				<ul class='kwicks kwicks-horizontal'>
					<li>
                    <img src="avator/Mac Repair.jpg" class='theanimated_image'/>
                    </li><li>
                    <img src="avator/iphone_repair.jpg" class='theanimated_image'/>
                    </li><li><img src="avator/MacBookPro_Slide.jpg" class='theanimated_image'/></li>
				</ul>
			</li>
		</ul>
		<script src="<?=$flink?>/addons/animation/jquery-1.8.1.min.js" type='text/javascript'></script>
		<script src="<?=$flink?>/addons/animation/jquery.kwicks.js" type='text/javascript'></script>
		
		<script type='text/javascript'>
			$(function() {
				$('.kwicks-vertical').kwicks({
					maxSize : 295,
					spacing : 5,
					isVertical: true,
					behavior: 'menu',
					selectOnClick: false
				});

				$('.kwicks-horizontal').kwicks({
					maxSize: 295,
					spacing: 5,
					behavior: 'menu',
					selectOnClick: false
				});
			});
		</script>