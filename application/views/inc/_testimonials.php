<section class="ptb-120 bg-shade position-relative overflow-hidden z-1 feedback-section">
    <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/bg-shape-5.png" alt="bg shape"
        class="position-absolute start-0 bottom-0 z--1 w-100">
    <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/map-bg.png" alt="map"
        class="position-absolute start-50 top-50 translate-middle z--1">
    <img src="<?=base_url('assets/theme/gostore')?>/img/shape/1.png" width="50px" alt="shape"
        class="position-absolute z--1 fd-1">
    <img src="<?=base_url('assets/theme/gostore')?>/img/shape/2.png" width="50px" alt="shape"
        class="position-absolute z--1 fd-2">
    <img src="<?=base_url('assets/theme/gostore')?>/img/shape/3.png" width="50px" alt="shape"
        class="position-absolute z--1 fd-3">
    <img src="<?=base_url('assets/theme/gostore')?>/img/shape/4.png" width="50px" alt="shape"
        class="position-absolute z--1 fd-4">
    <img src="<?=base_url('assets/theme/gostore')?>/img/shape/5.png" width="50px" alt="shape"
        class="position-absolute z--1 fd-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="section-title text-center">
                    <h2 class="mb-6">What Our Clients Say</h2>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="gshop-feedback-slider-wrapper">
                    <div class="swiper gshop-feedback-thumb-slider">
                        <div class="swiper-wrapper">
                            
                         <?php
                        $testimonials=get_web_elements('testi','1','4');
                        foreach($testimonials as $testimon){
                         ?>
                            <div class="swiper-slide control-thumb">
                                <img src="<?= base_url('assets/avator/webimg/t/') ?><?= $testimon['image'] ?>"
                                    alt="clients" class="img-fluid rounded-circle">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="swiper gshop-feedback-slider mt-4">
                        <div class="swiper-wrapper">
                        <?php 
                        foreach($testimonials as $testimon2){
                         ?>
                            <div class="swiper-slide feedback-single text-center">
                                <p class="mb-5">“<?=trim_text(nl2br($testimon2['text']),'190')?>” </p>
                                <span
                                    class="clients_name text-dark fw-bold d-block mb-1"><?=$testimon2['name']?></span>
                                <?= ratings_star($testimon2['star'],'star'); ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>