   <section class="pt-100 pb-100 my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appie-section-title mb-30">
                        <h3 class="appie-title">We do things that matters <br>
                         Checkout some of our services </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $theservices=get_web_elements('services','1','12');
                $theclass='col-lg-7';
                foreach($theservices as $services){
                    $theclass=$services['ser_class'];
                    if($theclass=='col-lg-7'){$num_s='160';}else{$num_s='110';}
                 ?>
                <div class="<?=$theclass?> mb-3">
                    <div class="appie-about-8-box">
                        <h3 class="title">
                            <?=$services['service_name']?>
                        </h3>
                        <p>
                            <?= trim_text(strip_tags($services['service_description']), $num_s) ?> 
                            <a href="<?=base_url('service')?>/<?=$services['slug']?>" >Learn More </a>
                        </p>
                        <a class="main-btn" href="<?=base_url('service')?>/<?=$services['slug']?>">Get Quote <i class="fal fa-arrow-right"></i></a>
                        <div class="thumb">
                            <img src="<?= base_url('assets/avator/upload/') ?><?= $services['service_image'] ?>" alt="" style='width: 200px;' class='pull-right' >
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>


<?php include('inc/_testimonials.php') ?>
<?php include('inc/_subscribe_card.php') ?>