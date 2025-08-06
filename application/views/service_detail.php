
    <section class="appie-service-details-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 d-none d-sm-block">
                    <div class="service-details-sidebar mr-50">
                        <div class="service-category-widget">
                            <h4 class="mb-3">Our Service List</h4>
                            <ul>
                                <?php
                                $theservices=get_web_elements('services','1','19');
                                foreach($theservices as $services){
                                 ?>
                                <li style="border-bottom: 1px solid #eee;" class="pb-1">
                                    <a href="<?=base_url('service')?>/<?=$services['slug']?>" style="line-height: 17px !important;font-weight: bold;color: #333;"><?=trim_text($services['service_name'],90)?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="service-download-widget">
                            <a href="#">
                                <i class="fal fa-download"></i>
                                <span>Download Brochure</span>
                            </a>
                        </div>
                        <div class="service-download-widget">
                            <a href="#">
                                <i class="fal fa-file-pdf"></i>
                                <span>Check our Reviews</span>
                            </a>
                        </div>

                        <div class="mt-3">
                            <?=widget(4)?>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="service-details-content">
                        <div class="thumb bg-light shadow_1">
                            <img src="<?= base_url('assets/avator/upload/') ?><?= $theService['service_image'] ?>" alt="" class='img-fluid' >
                        </div>
                        <div class="content">
                            <h2><?=$theService['service_name']?></h2>
                            <?=$theService['service_description']?>
                        </div>
                    </div>

                    <div class="contact-form p-0">
                        <hr/>
                        <h4>Let’s Connect</h4>
                        <p>Integer at lorem eget diam facilisis lacinia ac id massa.</p>
                        <?php include_once('inc/contact.php'); ?>
                    </div>

                </div>
                


                <section class="appie-sponser-area pt-90 pb-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="appie-section-title text-center">
                                    <h3 class="appie-title">We Work with following tech Stack<br> Our Tech stack is flexible and Reliable. </h3>
                                    <p>Join over 40,000 businesses worldwide.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="appie-sponser-box d-flex justify-content-center">
                                    <?php

                                    $theservices=get_web_elements('partnr','1','9');
                                    foreach($theservices as $partners){
                                     ?>
                                    <div class="sponser-item p-2">
                                        <img src="<?= base_url('assets/avator/upload/') ?><?= $partners['img_name'] ?>" alt="">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sponser-shape">
                        <img src="<?=base_url('assets/theme/ynaps/')?>images/sponser-shape.png" alt="">
                    </div>
                </section>
                
            </div>
        </div>
    </section>

    <!--====== APPIE SERVICE DETAILS PART ENDS ======-->

    <!--====== APPIE PROJECT PART START ======-->
    
    <section class="appie-project-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appie-project-box wow animated slideInUp" data-wow-duration="1000ms" data-wow-delay="0ms">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="appie-project-content">
                                    <h3 class="title">Start your project with YNAPS.</h3>
                                    <p>Leave your Phone Number and we will call you back.</p>
                                    <form action="#">
                                        <div class="input-box mt-30">
                                            <input type="text" placeholder="Your Phone Number">
                                            <button>CallBack</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="appie-project-thumb">
                            <img src="<?=base_url('assets/theme/ynaps/')?>images/project-thumb.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    