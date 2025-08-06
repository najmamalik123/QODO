        <!--breadcrumb section start-->
        <div class="gstore-breadcrumb position-relative z-1 overflow-hidden mt--50">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/bg-shape-6.png" alt="bg-shape"
                class="position-absolute start-0 z--1 w-100 bg-shape">
                <img src="<?=base_url('assets/theme/gostore')?>/img/shape/1.png" width="40px" alt="pata"
                class="position-absolute pata-xs z--1 vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/2.png" width="40px" alt="onion"
                class="position-absolute z--1 onion start-0 top-0 vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/3.png" width="40px" alt="frame circle"
                class="position-absolute z--1 frame-circle vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/4.png" width="40px" alt="leaf"
                class="position-absolute z--1 leaf vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/5.png" width="40px" alt="garlic"
                class="position-absolute z--1 garlic vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/6.png" width="40px" alt="roll"
                class="position-absolute z--1 roll vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/1.png" width="40px" alt="roll"
                class="position-absolute z--1 roll-2 vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/2.png" width="40px" alt="roll"
                class="position-absolute z--1 pata-xs-2 vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/3.png" width="40px" alt="tomato"
                class="position-absolute z--1 tomato-half vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/4.png" width="40px" alt="tomato"
                class="position-absolute z--1 tomato-slice vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/5.png" width="40px" alt="tomato"
                class="position-absolute z--1 cauliflower vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/6.png" width="40px" alt="tomato"
                class="position-absolute z--1 leaf-gray vector-shape">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h2 class="mb-2 text-center"><?=$product['p_name']?></h2>
                            <nav>
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item fw-bold" aria-current="page"><a
                                            href="<?=base_url()?>">Home</a></li>
                                    <li class="breadcrumb-item fw-bold" aria-current="page"><?=$product['p_name']?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb section end-->

        <!--product details start-->
        <section class="product-details-area ptb-120">
            <div class="container">
                <div class="row g-4">
                    <div class="col-xl-9">
                        <div class="product-details">
                            <div class="gstore-product-quick-view bg-white rounded-3 py-6 px-4">
                                <div class="row align-items-center g-4">
                                    <div class="col-xl-6 align-self-end">
                                        <div class="quickview-double-slider">
                                            <div class="quickview-product-slider swiper">
                                                <div class="swiper-wrapper">
                                                    <?php foreach($prod_img as $img) { ?>
                                                    <div class="swiper-slide text-center">
                                                        <img src="<?= base_url('assets/avator/upload/')?><?=$img['img']?>"
                                                            alt="jam" class="img-fluid">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="product-thumbnail-slider swiper mt-80">
                                                <div class="swiper-wrapper">
                                                    <?php foreach($prod_img as $img) { ?>
                                                    <div
                                                        class="swiper-slide product-thumb-single rounded-2 d-flex align-items-center justify-content-center">
                                                        <img src="<?= base_url('assets/avator/upload/')?><?=$img['img']?>"
                                                            alt="jam" class="img-fluid">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="product-info">
                                            <h4 class="mt-1 mb-3"><?=$product['p_name']?></h4>
                                            <div class="d-flex align-items-center flex-nowrap star-rating fs-xxs mb-2">
                                                <?= ratings_star($product['p_star'], 'star','20px') ?>
                                            </div>
                                            <div class="pricing mt-2">
                                                <span class="fw-bold fs-xs text-danger">₹<?=$product['p_price']?></span>
                                                <span
                                                    class="fw-bold fs-xs deleted ms-1">₹<?=$product['p_mrp']?></span>
                                            </div>
                                            <div class="widget-title d-flex mt-4">
                                                <h6 class="mb-1 flex-shrink-0">Description</h6>
                                                <span
                                                    class="hr-line w-100 position-relative d-block align-self-end ms-1"></span>
                                            </div>
                                            <?= trim_text($product['p_descp'], '280', '...') ?>
                                            <!-- <h6 class="fs-md mb-2 mt-3">Weight:</h6> -->

                                            <?=add_tocart3('Add TO Cart',$product['p_id'])?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-info-tab bg-white rounded-2 overflow-hidden pt-6 mt-4">
                                <ul class="nav nav-tabs border-bottom justify-content-center gap-5 pt-info-tab-nav">
                                    <li><a href="#description" class="active" data-bs-toggle="tab">Description</a></li>
                                    <li><a href="#info" data-bs-toggle="tab">Additional Information</a></li>
                                    <li><a href="#review" data-bs-toggle="tab">Reviews</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active px-4 py-5" id="description">
                                        <?=$product['p_descp']?>
                                    </div>
                                    <div class="tab-pane fade px-4 py-5" id="info">
                                        <h6 class="mb-2">Additional Information:</h6>
                                        <table class="w-100 product-info-table">
                                            <tr>
                                                <td class="text-dark fw-semibold">Colors</td>
                                                <td><?=$product['p_color']?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-semibold">Weight</td>
                                                <td><?=$product['p_weight']?> kg</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade px-4 py-5" id="review">
                                        <div class="review-tab-box bg-white rounded pt-30 pb-40 px-4">
                                            <?=get_web_elements('disqs','1','1');?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-8">
                        <div class="gshop-sidebar">
                            <div class="sidebar-widget info-sidebar bg-white rounded-3 py-3">
                                <div class="sidebar-info-list d-flex align-items-center gap-3 p-4">
                                    <span
                                        class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-primary">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </span>
                                    <div class="info-right">
                                        <h6 class="mb-1 fs-md">Free Shipping</h6>
                                        <span class="fw-medium fs-xs">For orders from ₹50</span>
                                    </div>
                                </div>
                                <div class="sidebar-info-list d-flex align-items-center gap-3 p-4 border-top">
                                    <span
                                        class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-primary">
                                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                    </span>
                                    <div class="info-right">
                                        <h6 class="mb-1 fs-md">100% Money Back</h6>
                                        <span class="fw-medium fs-xs">Guaranteed Product Warranty</span>
                                    </div>
                                </div>
                                <div class="sidebar-info-list d-flex align-items-center gap-3 p-4 border-top">
                                    <span
                                        class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-primary">
                                        <i class="fa-regular fa-heart"></i>
                                    </span>
                                    <div class="info-right">
                                        <h6 class="mb-1 fs-md">Safety & Secure</h6>
                                        <span class="fw-medium fs-xs">Call us Anytime & Anywhere</span>
                                    </div>
                                </div>
                            </div>


                            <div class="sidebar-widget products-widget py-5 px-4 bg-white mt-4">
                                <div class="widget-title d-flex">
                                    <h6 class="mb-0 flex-shrink-0">Featured Products</h6>
                                    <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span>
                                </div>
                                <div class="sidebar-products-list">
                                    <!-- <div
                                        class="horizontal-product-card card-md d-sm-flex align-items-center bg-white rounded-2 gap-3 mt-4">
                                        <div class="thumbnail position-relative rounded-2">
                                            <a href="#"><img
                                                    src="<?=base_url('assets/theme/gostore')?>/img/products/p-sm-1.png"
                                                    alt="product" class="img-fluid"></a>
                                            <div
                                                class="product-overlay position-absolute start-0 top-0 w-100 h-100 d-flex align-items-center justify-content-center gap-2 rounded-2">
                                                <a href="product-details.html" class="rounded-btn"><i
                                                        class="fa-solid fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-content mt-3 mt-sm-0">
                                            <a href="#"
                                                class="d-block fs-sm fw-bold text-heading title d-block">Strawberry
                                                juice Fruit</a>
                                            <div class="pricing mt-0">
                                                <span class="fw-bold fs-xxs text-danger">$140.00</span>
                                            </div>
                                            <div class="d-flex align-items-center flex-nowrap star-rating mt-1">
                                                <ul class="d-flex align-items-center me-2">
                                                    <li class="text-warning"><i class="fa-solid fa-star"></i></li>
                                                    <li class="text-warning"><i class="fa-solid fa-star"></i></li>
                                                    <li class="text-warning"><i class="fa-solid fa-star"></i></li>
                                                    <li class="text-warning"><i class="fa-solid fa-star"></i></li>
                                                    <li class="text-warning"><i class="fa-solid fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> -->

                                    <?php  foreach($featuredProducts as $pro){ ?>
                                        <?php include('inc/product3.php')?>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--product details end-->

        <!--related product slider start -->
        <section class="related-product-slider pb-120">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-8">
                        <div class="section-title text-center text-sm-start">
                            <h2 class="mb-0">You may be interested</h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="rl-slider-btns text-center text-sm-end mt-3 mt-sm-0">
                            <button class="rl-slider-btn slider-btn-prev"><i class="fas fa-arrow-left"></i></button>
                            <button class="rl-slider-btn slider-btn-next ms-3"><i
                                    class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="rl-products-slider swiper mt-8">
                    <div class="swiper-wrapper">
                        <?php  foreach($prod as $pro){ ?>
                            <?php include('inc/sliderproduct.php'); ?>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </section>
        <!--related products slider end-->