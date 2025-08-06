<section class="ftco-section services-section">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-resume"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Up- to-date Exam Content</h3>
                <p>Created by experts, toppers & top faculty across the India.
Comprehensive updated material with latest exam pattern
</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-team"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Extensive Online Test Series</h3>
                <p>High Quality Mock test with thousands of Questions and there interactive Solutions.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-career"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Notification about Exams</h3>
                <p>Get up- to- date exam or job notification through mail or messages</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-employees"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Analytics and Feedback</h3>
                <p>Compare your rank with all India candidates and analyze your weaker areas.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="ftco-section bg-light">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 pr-lg-5">
						<div class="row justify-content-center pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		          	<span class="subheading">Recently Added Mock test</span>
		          	<p>Attempt hundreds of mock tests for all exam categories listed below, check in-depth solutions and receive All India Ranks and feedback on your performance after each test.</p>
		            <h2 class="mb-4">Featured Mock Test For This Week</h2>
		          </div>
		        </div>
						<div class="row">
					<?php
					$getfeatured=$this->db->query("select distinct * from edu_papers,yn_site_catagory where ppr_status !='0' and ppr_cat=ctid limit 12");
					$allpapers=$getfeatured->result_array();
					foreach($allpapers as $papers){
					?>
					<div class="col-md-12 ftco-animate">
		            <div class="job-post-item p-4 d-block d-lg-flex align-items-center">
		              <div class="one-third mb-4 mb-md-0">
		                <div class="job-post-item-header align-items-center">
		                	<span class="subadge"><?=$papers['name']?></span>
		                  <h2 class="mr-3 text-black"><a href="<?=base_url('index.php/main/ques_paper?id=')?><?=$papers['ppr_id']?>"><?=$papers['ppr_name']?></a></h2>
		                </div>
		                <div class="job-post-item-body d-block d-md-flex">
		                  <div class="mr-3"><span class="fa fa-pencil-square-o"></span> <?=$papers['ppr_attempt']?></div>
		                  <div class="mr-3"><span class="fa fa-question-circle-o"></span> <?=$papers['ppr_attempt']?></div>
		                  <div class="mr-3"><span class="fa fa-clock-o"></span> <?=$papers['ppr_tt']?></div>
		                  <div class="mr-3"><span class="fa fa-thumb-tack"></span> <?=$papers['ppr_tm']?></div>
		                  <div><span class="fa fa-calendar-o"></span> <span> <?=date_format_1($papers['ppr_date'],1)?></span></div>
		                </div>
		              </div>

		              <div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
		              	<!-- <div>
			                <a href="#" class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
			                	<span class="icon-heart"></span>
			                </a>
		                </div> -->
		                	<?php if(!isset($_SESSION['yid'])){ ?>
		                	<a href="<?=base_url('index.php/main/login')?>" class="btn btn-primary py-2" >Start Test</a>
		                	<?php }else{ ?>
		                <b class="btn btn-primary py-2" onclick="window.open('<?=base_url('index.php/main/exam?id=')?><?=$papers['ppr_id']?>','window','toolbar=no, menubar=no, resizable=yes');" >Start Test</b>
		            <?php } ?>
		              </div>
		            </div>
		          </div><!-- end -->
		      <?php } ?>
		        </div>
		      </div>
		      <div class="col-lg-3 sidebar p-3" style="background: #fff;">
		        <div class="row justify-content-center pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		            <h2 class="mb-4">Pricing Plans</h2>
		          </div>
		        </div>

            <?php $getallacodes=$this->db->query("select * from edu_pricing limit 4");
            $getallacodes=$getallacodes->result_array();
            foreach ($getallacodes as $data_msg){
                ?>
              <div class="card card-pricing text-center px-3 mb-4 mt-2" style="border-top: 1px solid #ddd;">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm"><?=$data_msg['pr_dur']?> Month</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="45">Rs<span class="price"><?=$data_msg['pr_cost']?></span></h1>
            </div>
            <div class="card-body pt-0">
                <?=nl2br($data_msg['pr_desc'])?>
                <a href="<?=base_url('index.php/main/buy?pl=')?><?=$data_msg['pr_id']?>"><button type="button" class="btn btn-outline-secondary mb-3">Order now</button></a>
            </div>
        </div>
<?php } ?>

		      </div>
				</div>
			</div>
		</section>