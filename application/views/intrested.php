

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Get Quote</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
                                <li class="ec-breadcrumb-item active">Get Quote</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Get Quote page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row justify-content-center">
              <div class="col-sm-7">
              <div class="ec-common-wrapper">
                    <div class="text-center">
                        <div class="ec-contact-container">
                            <div class="ec-contact-form">
                            <?php
                            if(isset($_GET['pid'])){
                            $pid= $_GET['pid'];
                            $SingleProduct=$this->db->query("select * from `x-products` where pid = '$pid' ");
                            $product=$SingleProduct->row_array();
                            ?>
                                <form method="post" action="<?=base_url('index.php/action/intrest')?>" onsubmit="return ajaxsubmitform('<?=base_url('index.php/action/intrest')?>',this,'error_div','loder_div','#','1','contacted');"> 

                                        <span class="ec-contact-wrap">
                                        <input type="hidden" name="pid" value="<?=$product['pid']?>">
                                        </span>
                                        <span class="ec-contact-wrap">
                                        <input type="hidden" name="pname" value="<?=$product['name']?>">
                                        </span>
                                        
                                        <span class="ec-contact-wrap">
                                        <input type="hidden" name="uid" value="<?=$profile_data['mid'];?>" >
                                        </span>   
                                        <span class="ec-contact-wrap">
                                        <input type="hidden" name="name" value="<?=$profile_data['name'];?>" >
                                        </span>
                                        <span class="ec-contact-wrap">
                                        <label>Phone*</label>
                                        <input class="text-white" type="text" name="number" value="<?=$profile_data['contact'];?>" >
                                        </span>
                                        <span class="ec-contact-wrap">
                                        <label>Email*</label>
                                        <input class="text-white" type="text" name="uemail" value="<?=$profile_data['email'];?>" >
                                        </span>
                                    <span class="ec-contact-wrap ec-contact-btn">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </span>
                                </form>
                                <?php } else echo"404 Eror";?>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>
