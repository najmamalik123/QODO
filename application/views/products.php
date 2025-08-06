

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Shop</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
                                <li class="ec-breadcrumb-item active">Shop</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Shop page -->
    <section class="ec-page-content-bnr section-space-pb">
        <div class="container">
            <div class="row">
                <div class="ec-shop-rightside col-lg-9 order-lg-last col-md-12 order-md-first margin-b-30">
                    <!-- Shop Top Start -->
                    <div class="ec-pro-list-top d-flex">
                        <div class="col-md-6 ec-grid-list">
                            <div class="ec-gl-btn">
                                <button class="btn btn-grid active"><img src="<?=base_url('assets/theme/');?>images/icons/grid.svg" class="svg_img gl_svg" alt=""></button>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Top End -->

                    <!-- Shop content Start -->
                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                            <div class="row"> 
                                <?php 
                                    $searchIng = "";
                                    if (isset($_GET['cate']) && $_GET['cate']!="" && $_GET['cate']!=null) {

                                        $in_Filter = $_GET['cate'];

                                        $Comb_Filter = "where category = '$in_Filter' ";
                                        $searchIng = str_replace('-', ' ', ucfirst($_GET['category']));
                                    }else if (isset($_GET['q']) && $_GET['q']!="" && $_GET['q']!=null) {

                                        $get_Search = $this->input->get('q');
                                        if ($get_Search!="") {
                                            $S_qry = '"%'.$get_Search.'%"';
                                        }else{$S_qry = "";}

                                        $Comb_Filter = ' where name like '.$S_qry;

                                        $searchIng = $get_Search;
                                    }else{$Comb_Filter = ''; $searchIng= ''; } ?>

                                <?php
                                if (isset($searchIng) && $searchIng!="") {
                                    echo "<h6 class='alert alert-info'>Results for : <b>".$searchIng."</b></h6>";
                                }
                                $get_products=$this->db->query("SELECT * from `x-products` $Comb_Filter order by rand() ");

                                if ($get_products->num_rows()>0) {
                                    $allProducts=$get_products->result_array();
                                    foreach ($allProducts as $products) { ?>
                                    <?php include('inc/inc_card1.php')?>
                                   <?php }
                                }else{
                                    ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title alert alert-info">Product not Found!</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }                        
                                 ?>
                            </div>
                        </div>
                        <!-- Ec Pagination Start -->
                        <!-- <div class="ec-pro-pagination">
                            <span>Showing 1-12 of 21 item(s)</span>
                            <ul class="ec-pro-pagination-inner">
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a class="next" href="#">Next <i class="ecicon eci-angle-right"></i></a></li>
                            </ul>
                        </div> -->
                        <!-- Ec Pagination End -->
                    </div>
                    <!--Shop content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside col-lg-3 order-lg-first col-md-12 order-md-last">
                    <div id="shop_sidebar">
                        <div class="ec-sidebar-heading">
                            <h1>Filter Products By</h1>
                        </div>
                        <div class="ec-sidebar-wrap">
                            <!-- Sidebar Category Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Category</h3>
                                </div>
                                <div class="ec-sb-block-content">
                                    <ul>
                                        <?php
                                        $get_categories=$this->db->query("select * from `yn_site_catagory` ");
                                        if ($get_categories->num_rows()>0) {
                                            ?>
                                            <form>
                                            <?php
                                            $allCategories=$get_categories->result_array();
                                            foreach ($allCategories as $categories) {
                                            ?>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <?php if (isset($_GET['cate']) && $_GET['cate']!="" && $_GET['cate']!=null) {

                                                        $Cate_getData = $this->input->get('cate');
                                                        $cate_Res = "";
                                                        if (isset($Cate_getData) && $Cate_getData==$categories['ctid']) {
                                                            $cate_Res = "fa fa-check text-success";
                                                        }else{
                                                            $cate_Res = "fa fa-list text-secondary";
                                                        }

                                                    } ?>
                                                    <a href="<?=base_url('products?cate='.$categories['ctid'].'&category='.url_smart($categories['name']))?>"><i class="<?php if(isset($cate_Res) && $cate_Res!=""){echo $cate_Res;}else{echo"fa fa-list text-secondary";}?>"></i> <?=$categories['name']?></a>
                                                </div>
                                            </li>
                                                <?php
                                            }
                                           ?>
                                        </form>
                                           <?php 
                                        }else{
                                            ?>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <span>Empty Category List!</span>
                                                </div>
                                            </li>
                                            <?php
                                        }                        
                                         ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- ZDCas -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Tags</h3>
                                </div>
                                <div class="ec-sb-block-content">
                                    <?php
                                    $gettags=$this->db->query("select * from yn_site_tags order by stg_tgid desc");
                                    $alltags=$gettags->result_array();
                                    foreach($alltags as $tag){ ?>
                                            <a href=""><button class="btn btn-primary mt-2"><?=$tag['stg_name']?></button></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop page -->

    