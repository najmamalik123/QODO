
    <!--============= Header Section Ends Here =============-->
    <section class="page-header bg_img" data-background="<?=base_url('assets/theme/images/')?>page-header.png">
        <div class="bottom-shape d-none d-md-block">
            <img src="<?=base_url('assets/theme/')?>css/img/page-header.png" alt="css">
        </div>
        <div class="container">
            <div class="page-header-content cl-white">
                <h2 class="title">Providers</h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?=base_url()?>">Home</a>
                    </li>
                    <li>
                        Providers
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!--============= Header Section Ends Here =============-->

    <!--============= About Section Starts Here =============-->
    <section class="about-section padding-top padding-bottom oh">
        <div class="container">
            <div class="row align-items-center">
                <h3>Our Course Providers</h3>
                <small>
                    From the wide catalog of online education from world-class universities and leading Course Providers where the opportunities range from courses for kids to job-ready certificates and degree programs, we as a course aggregator platform show all available course/learning options in one place, creating a simple alternative to all your research in finding ‘the perfect course’ from different platforms.
                </small>
                    <?php 
                    $get_sliders=$this->db->query("select * from x_cou_prov order by pr_id desc limit 100");
                    $allsliedsrs=$get_sliders->result_array();
                    foreach($allsliedsrs as $slider2){ ?>
                    <div class="col-6 col-sm-4 p-4">
                        <a href="<?=base_url('search?pr=')?><?=$slider2['pr_id']?>">
                            <img src="<?=base_url('assets/avator/upload/')?><?=$slider2['pr_image']?>" style='height:auto;' class='img-fluid' > <br/>
                            <!-- <b><?=$slider2['pr_name']?></b> -->
                        </a>
                    </div>
                    <?php } ?>
                
            </div>
        </div>
    </section>
    <!--============= About Section Ends Here =============-->