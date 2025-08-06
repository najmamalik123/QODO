    <!--====== Service Section Start ======-->
    <section class="service-section section-gap">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center both-border mb-50">
                <span class="title-tag">Company Services</span>
                <h2 class="title">We Provide Most Exclusive <br> Service For Business</h2>
            </div>
            <!-- Services Boxes -->
            <div class="row service-boxes justify-content-center">
            <?php 
                        foreach($services as $service){
                            $service_url=base_url('services/').$service['service_id'].'/'.url_smart($service['service_name']);
                            ?>
                <div class="col-lg-3 col-sm-6 col-10 wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="400ms">
                    <div class="service-box-three">
                        <div class="pb-3">
                            <a href="<?=$service_url?>">
                            <img width="100%" src="<?=base_url('assets/avator/upload/')?><?=$service['service_image']?>"></a>
                        </div>
                        <h3><a href="<?=$service_url?>"><?=$service['service_name']?></a></h3>
                        <p class="px-2 text-left"><?=$service['service_meta_desc']?></p>
                        <a href="<?=$service_url?>" class="main-btn main-btn-4 my-3">View <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <?php } ?>
         
            
              
            </div>
        </div>
    </section>
    <!--====== Service Section End ======-->