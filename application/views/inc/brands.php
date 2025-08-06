        <?php 
            $the_image=get_web_img('list','partner');
        ?>

        <section class="brands-section ptb-120 position-relative z-1 overflow-hidden service-section">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/bg-shape-4.png" alt="bg shape"
                class="position-absolute start-0 bottom-0 w-100 z--1 bg-shape">
            <div class="container">
                <div class="brand-wrapper px-5 rounded-4">
                    <h4 class="section-title mb-0">The Most Popular Brands</h4>
                    <div class="brands-slider swiper px-2 pt-4 pb-7">
                        <div class="swiper-wrapper">
                            <?php foreach($the_image as $brands){ ?>
                            <div class="swiper-slide brand-item rounded">
                                <img src="<?=base_url('assets/avator/upload/')?><?=$brands['img_name']?>" alt="brand"
                                    class="img-fluid">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section