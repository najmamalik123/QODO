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
                            <h2 class="mb-2 text-center">Shop</h2>
                            <nav>
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item fw-bold" aria-current="page"><a
                                            href="<?=base_url()?>">Home</a></li>
                                    <li class="breadcrumb-item fw-bold" aria-current="page">Shop</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb section end-->

        <!--shop grid section start-->
        <section class="gshop-gshop-grid ptb-120">
            <div class="container">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="gshop-sidebar bg-white rounded-2 overflow-hidden">
                            <div class="sidebar-widget search-widget bg-white py-5 px-4">
                                <div class="widget-title d-flex">
                                    <h6 class="mb-0 flex-shrink-0">Search Now</h6>
                                    <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span>
                                </div>
                                <form class="search-form d-flex align-items-center mt-4" action="">
                                    <input type="text" name="q" placeholder="Search...">
                                    <button type="submit" class="submit-icon-btn-secondary"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                            <div class="sidebar-widget category-widget bg-white py-5 px-4 border-top">
                                <div class="widget-title d-flex">
                                    <h6 class="mb-0 flex-shrink-0">Categories</h6>
                                    <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span>
                                </div>
                                <ul class="widget-nav mt-4">
                                    <?php
                    $thecats = $this->db->query("select * from yn_site_catagory order by sid asc limit 8"); 
                    $the_cats=$thecats->result_array();
                    foreach($the_cats as $cat){ ?>
                                    <li><a href="<?=base_url('shop?cate='.$cat['ctid'].'&category='.url_smart($cat['name']))?>"
                                            class="d-flex justify-content-between align-items-center"><?=$cat['name']?>
                                            <?php 
                                $ctid = $cat['ctid']; 
                                $thecatsproducts = $this->db->query("SELECT * FROM `yn_ecom_products` where p_category='$ctid' order by p_id"); 
                                $all_products = $thecatsproducts->result_array();
                                $totalItems = count($all_products);
                                ?>
                                            <span
                                                class="fw-bold fs-xs total-count"><?php echo $totalItems; ?></span></a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="sidebar-widget price-filter-widget bg-white py-5 px-4 border-top">
                                <div class="widget-title d-flex">
                                    <h6 class="mb-0 flex-shrink-0">Filter by Price</h6>
                                    <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span>
                                </div>
                                <div class="at-pricing-range mt-4">
                                    <form class="range-slider-form" action="<?=base_url('shop')?>" method="GET">
                                        <div class="price-filter-range"></div>
                                        <div class="d-flex align-items-center mt-3">
                                            <input required name="min_price"
                                                class="min_price price-range-field price-input border-0" type="number"
                                                placeholder="From" min="0" max="250">
                                            <span class="d-inline-block ms-2 me-2 fw-bold">-</span>
                                            <input required name="max_price"
                                                class="max_price price-range-field price-input border-0" type="number"
                                                placeholder="To" min="0" max="25000">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm mt-3">Filter</button>
                                    </form>

                                </div>
                            </div>
                            
                            <div class="sidebar-widget products-widget py-5 px-4 bg-white border-top">
                                <div class="widget-title d-flex">
                                    <h6 class="mb-0 flex-shrink-0">Best Selling</h6>
                                    <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span>
                                </div>
                                <div class="sidebar-products-list">
                                    <?php  foreach($topProducts as $pro){ ?>
                                    <?php include('inc/products2.php')?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="shop-grid">
                            <div
                                class="listing-top d-flex align-items-center justify-content-between flex-wrap gap-3 bg-white rounded-2 px-4 py-5 mb-6">
                                <p class="mb-0 fw-bold">Showing 1-<?= count($prod) ?> of <?= $totalProducts ?> results</p>
                                <div
                                    class="listing-top-right text-end d-inline-flex align-items-center gap-3 flex-wrap">
                                    <div class="number-count-filter d-flex align-items-center gap-3">
                                        <label class="fw-bold fs-xs text-dark flex-shrink-0">Show:</label>
                                        <input type="number" value="16">
                                    </div>
                                    <div class="select-filter d-inline-flex align-items-center gap-3">
                                        <label class="fw-bold fs-xs text-dark flex-shrink-0">Sort by:</label>
                                        <select class="form-select fs-xxs fw-medium theme-select select-sm">
                                            <option>News First</option>
                                            <option>Best Selling</option>
                                            <option>Best Rated</option>
                                        </select>
                                    </div>
                                    <a href="#" class="grid-btn active">
                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.97196 0H1.37831C0.706579 0 0.160156 0.546422 0.160156 1.21815V5.8118C0.160156 6.48353 0.706579 7.02996 1.37831 7.02996H5.97196C6.64369 7.02996 7.19011 6.48353 7.19011 5.8118V1.21815C7.19 0.546422 6.64369 0 5.97196 0Z"
                                                fill="#FF7C08" />
                                            <path
                                                d="M14.9407 0H10.3471C9.67533 0 9.12891 0.546422 9.12891 1.21815V5.8118C9.12891 6.48353 9.67533 7.02996 10.3471 7.02996H14.9407C15.6124 7.02996 16.1589 6.48353 16.1589 5.8118V1.21815C16.1589 0.546422 15.6124 0 14.9407 0Z"
                                                fill="#FF7C08" />
                                            <path
                                                d="M5.97196 8.96973H1.37831C0.706579 8.96973 0.160156 9.51609 0.160156 10.1878V14.7815C0.160156 15.4532 0.706579 15.9996 1.37831 15.9996H5.97196C6.64369 15.9996 7.19011 15.4532 7.19011 14.7815V10.1878C7.19 9.51609 6.64369 8.96973 5.97196 8.96973Z"
                                                fill="#FF7C08" />
                                            <path
                                                d="M14.9407 8.96973H10.3471C9.67533 8.96973 9.12891 9.51615 9.12891 10.1879V14.7815C9.12891 15.4533 9.67533 15.9997 10.3471 15.9997H14.9407C15.6124 15.9996 16.1589 15.4532 16.1589 14.7815V10.1878C16.1589 9.51609 15.6124 8.96973 14.9407 8.96973Z"
                                                fill="#FF7C08" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="row g-4">
                                <?php  foreach($prod as $pro){ ?>
                                <div class="col-lg-4 col-md-6 col-sm-10">
                                    <?php include('inc/shopproducts.php'); ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <ul class="template-pagination d-flex align-items-center mt-6">
                                    <li><a href="#" class="active">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"><i class="fas fa-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--shop grid section end-->