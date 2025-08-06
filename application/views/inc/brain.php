<!--hero section start-->
<section class="gshop-hero pt-120 bg-white position-relative z-1 overflow-hidden">
   
    <div class="container">
        <div class="gshop-hero-slider swiper">
            <div class="swiper-wrapper">
            <?php
      $get_sliders = $this->db->query("select * from yn_site_img where img_place='slider1' and img_status='1' order by img_sort asc limit 10");
      $allsliedsrs = $get_sliders->result_array();
       $i = 'active';
                foreach ($allsliedsrs as $slidersr) {
      ?>
                <div class="swiper-slide gshop-hero-single">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-5 col-lg-8">
                            <div class="hero-left-content">
                                <span class="gshop-subtitle fs-5 text-secondary mb-2 d-block"><?= $slidersr['img_sort'] ?></span>
                                <h1 class="display-4 mb-3"><?= $slidersr['img_link'] ?> </h1>
                                <p class="mb-7 fs-6"><?= $slidersr['img_text'] ?></p>
                                <div class="hero-btns d-flex align-items-center gap-3 gap-sm-5 flex-wrap">
                                    <a href="<?=base_url('shop')?>" class="btn btn-secondary">Shop Now<span class="ms-2"><i
                                                class="fa-solid fa-arrow-right"></i></span></a>
                                    <a href="<?=base_url('about')?>" class="btn btn-primary">About Us<span class="ms-2"><i
                                                class="fa-solid fa-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="hero-right text-center position-relative z-1 mt-8 mt-xl-0">
                                <img src="<?= base_url('assets/avator/upload/') ?><?= $slidersr['img_name'] ?>" alt="fruits" class="img-fluid position-absolute end-0 top-50 hero-img">
                                <!-- <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/tree.png" alt="tree"
                                    class="img-fluid position-absolute tree z-1"> -->
                                <!-- <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/orange-1.png" alt="orange"
                                    class="position-absolute orange-1 z-1"> -->
                                <!-- <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/orange-2.png" alt="orange"
                                    class="position-absolute orange-2 z-1"> -->
                                <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/hero-circle-lg.png"
                                    alt="circle shape" class="img-fluid hero-circle">
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="at-header-social d-none d-sm-flex align-items-center position-absolute">
        <span class="title fw-medium">Follow on</span>
        <ul class="social-list ms-3">
            <li><a href="<?=$social_fb?>"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="<?=$social_tw?>"><i class="fab fa-twitter"></i></a></li>
            <li><a href="<?=$social_linkedin?>"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a href="<?=$social_in?>"><i class="fab fa-instagram"></i></a></li>
        </ul>
    </div>
    <div class="gshop-hero-slider-pagination theme-slider-control position-absolute top-50 translate-middle-y z-5">
    </div>
</section>
<!--hero section end-->