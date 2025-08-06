<style>
    [class*="fa-"] {
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
    }


    li [class*="fa-"] {
        font-size: 15px;
    }


    [class*="fa-"].fa-lg {
        font-size: 32px;

    }

    [class*="fa-"].fa-sm {
        font-size: 16px;

    }

    /* Facilities Block styling with a border */
    .facilities-block {
        /* border: 1px solid #ddd; */
        padding: 10px;
        margin-top: 5px;
    }

    /* Styling for each facility item */
    .facility-item {
        display: flex;
        align-items: center;
    }

    .facility-item {
        border-bottom: 1px solid #ddd;
    }

    .facility-item i {
        font-size: 15px;
    }

    .facility-box {
        /* border: 1px solid #ddd; */
        border-radius: 8px;
        /* background-color: #f9f9f9; */
        transition: all 0.3s ease;
        padding: 20px;
    }

    .icon-box i {
        font-size: 25px;
        color: #5B2333;
        /* Adjust color as needed */
    }

    .amenity-name {
        margin-top: 10px;
        font-size: 12px;
        color: #495057;
    }

    .amenity-name span {
        display: block;
    }

    /* Responsive Design */
    @media (max-width: 576px) {
        .row-cols-2 {
            row-cols: 1;
        }
    }

    /* Slick Slider Customization */
    .slick-slide {
        display: flex;
        justify-content: center;
    }

    /* Main image container with responsive ratio */
    .slider-for div {
        aspect-ratio: 16 / 9;
        /* responsive */
        overflow: hidden;
        border-radius: 12px;
        background-color: #f3f3f3;
        transition: all 0.3s ease-in-out;
    }

    .slider-for img {
        width: 100%;
        /* height: 340px; */
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    /* Thumbnail styling */
    .slider-nav img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 6px;
        background-color: #eee;
    }

    /* Responsive fallback for mobile */
    @media (max-width: 900px) {
        .slider-nav img {
            width: 70px;
            height: 70px;
        }

        .slider-for img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .slider-for div {
            aspect-ratio: 4 / 3;
        }

        .slider-nav .slick-slide {
            width: 125px !important;
        }
    }




    /* Thumbnail images: Keep the thumbnails of equal size */
    /*.slider-nav img {*/
    /*    width: 100px;*/
    /*    height: 100px;*/
    /*    object-fit: cover;*/
    /*    border-radius: 8px;*/
    /*    background-color: #f0f0f0;*/
    /*}*/


    .slick-prev,
    .slick-next {
        font-size: 24px;
    }

    .project-section {
        background: hsl(35deg 50% 30%);
        color: #fff;
        font-family: Arial, sans-serif;
    }





    .project-name {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 0.5rem 1rem;
        display: inline-block;
        border-radius: 25px;
        font-size: 2.5rem;
        font-weight: 700;
        /* color:rgba(221, 119, 24, 0.92); */
        /* color:rgb(192, 99, 7); */

        color: rgb(159, 121, 9);

    }

    .text-warning {
        color: rgb(159, 121, 9) !important;
        /* color:rgb(221, 119, 24) !important; */
    }



    .price-info {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .meta-info {
        font-size: 1rem;
        font-weight: 400;
        margin-bottom: 1.5rem;
    }

    .launch-box {
        background-color: black;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        /*margin-bottom: 1rem;*/
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .feature-icons div {
        text-align: left;
        font-size: 13px;
    }

    .feature-icons span {
        font-size: 1.5rem;
        display: block;
        margin-bottom: 0.2rem;
    }

    .feature-icons i {
        font-size: 17px;
        padding: 12px;
        background: #1610077d;
        border-radius: 50%;
        margin-right: 10px;
    }

    .cta-buttons .btn {
        border-radius: 8px;
        font-weight: 600;
    }

    .cta-buttons .btn-light {
        color: black;
    }

    .image-box {
        position: relative;
        height: 100%;
        border-radius: 15px;
        overflow: hidden;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-caption-top {
        position: absolute;
        top: 0;
        left: 0;
        padding: 1rem;
        font-size: 1.3rem;
        line-height: 1.2;
    }

    .image-caption-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 0.5rem 1rem;
        border-top-right-radius: 10px;
        font-size: 1rem;
    }

    .interest-note {
        color: #f2c94c;
        font-weight: 500;
        margin-top: 1rem;
        font-size: 1rem;
    }
</style>
<?php
$user = $this->ynaps_model->getprofile_data('*', $id);
?>

<?php
$getProperties1 = $this->db->query("SELECT * FROM x_home_property WHERE prop_status='1' AND prop_vendor='$id' ORDER BY prop_id DESC LIMIT 6");
$properties1 = $getProperties1->result_array();

$row = $this->db->query("SELECT * FROM x_home_property WHERE prop_status='1' AND prop_vendor='$id' ORDER BY prop_id DESC LIMIT 1")->row_array();
?>

<section
    style="background-image: url(<?= base_url('assets/avator/bg-d-s.jpg') ?>); background-size: contain; background-position: center; "
    class="project-section py-5  ">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left Side -->
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="project-name mb-3"><img src="<?= base_url('assets/mem/' . $user['mid'] . '/img/' . $user['photo']) ?>" class="img-fluid rounded-circle" alt="news-img" style="width: 60px; height: 60px; object-fit: cover; margin-right:10px; border: 1px solid #5A1D32">
                    <?= $user['name'] ?></div>

                <!-- <div class="price-info mb-2"><?= $row['prop_bedroom'] ?> BHK Apartment | ₹<?= number_format($row['prop_price']) ?></div> -->
                <div class="meta-info"><i style="color:rgba(1, 1, 1, 0.7)" class="fa fa-map-marker-alt me-1 fa-sm"></i> <?= $user['address'] ?> &nbsp;&nbsp;
                    <i style="color:rgba(1, 1, 1, 0.7)" class="fa fas fa-shield-halved fa-sm me-1"></i> RERA
                </div>

                <div style="background: #00000040; border-radius: 20px;"
                    class="col-md-7">
                    <div
                        style="border-radius:35px"
                        class="launch-box ">
                        <span><em> <strong>NEW LAUNCH </strong>Project</em></strong></span>
                        <a href="<?= base_url('property') ?>/<?= $row['prop_id'] ?>/<?= url_smart($row['prop_name']) ?>" class="text-white text-decoration-underline">Learn more</a>
                    </div>

                    <div class="d-flex feature-icons p-2 pt-3 pb-3 justify-content-between gap-sm-3 mb-4">
                        <div class="d-flex"><i class="fa-solid fa-chart-line text-warning"></i>High price<br>appreciation</div>
                        <div class="d-flex"><i class="fa-regular fa-heart text-warning"></i>Units of<br>choice</div>
                        <div class="d-flex"><i class="fa-solid fa-indian-rupee-sign text-warning "></i>Easy Payment<br>plans</div>
                    </div>
                </div>

                <div class="cta-buttons d-flex flex-wrap gap-3 mb-3 col-md-7">
                    <a href="<?= base_url('property') ?>/<?= $row['prop_id'] ?>/<?= url_smart($row['prop_name']) ?>" class="btn btn-light rounded-pill col">Inquire</a>
                    <button class="btn btn-primary rounded-pill text-decoration-none m-0 col"> ⤸ Brochure</button>

                </div>
            </div>

            <!-- Right Side -->
            <div class="col-lg-5">
                <div class="image-box bg-dark" style="height: 400px;">
                    <?= convertYoutube($user['cover2']) ?>
                </div>
            </div>

        </div>
    </div>
</section>
<div class="py-4 container">
    <div class="container-fluid">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-8 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <!-- <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm"> -->
                    <!-- <div class="p-3 d-flex align-items-center"> -->
                    <!-- Property Name -->
                    <!-- <img src="<?= base_url('assets/mem/' . $user['mid'] . '/img/' . $user['photo']) ?>" class="img-fluid rounded-circle" alt="news-img" style="width: 60px; height: 60px; object-fit: cover; margin-right:10px; border: 1px solid #5A1D32"> -->
                    <!-- <div>  -->
                    <!-- <h5 class=" mt-1 mb-2 text-dark fw-bold " style="text-transform:capitalize;"><?= $user['name'] ?></h5> -->
                    <!-- <span><?= $user['address'] ?></span> -->
                    <!-- </div> -->

                    <!-- </div> -->

                    <!-- </div> -->

                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">

                        <div class="mt-2">
                            <h4 class="mb-2 ms-2 text-black"><strong>About</strong></h4>

                            <p class=" ms-2 mb-3 text-black"><?= $user['about'] ?></p>

                        </div>
                    </div>


                    <!--<div class="d-flex justify-content-center">-->
                    <!--    <div class="col-md-2">-->
                    <!--        <a href="<?= base_url('contact') ?>?property=<?= $property['prop_id'] ?>" class="btn btn-primary w-100 text-decoration-none rounded-pill py-1 fw-bold text-uppercase m-0 mb-2">Inquire</a>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <style>
                        iframe,
                        .gmap_canvas,
                        .mapouter {
                            width: 100% !important;
                        }
                    </style>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <div class="d-flex justify-content-between">
                                <h4 class="fw-bold text-black">Properties</h4>
                                <!-- <button data-bs-toggle="modal" data-bs-target="#filtersModal" class="btn btn-secondary rounded-5 fw-bold px-3 py-2 fs-6 mb-0 d-flex align-items-center"><i class="fa-solid fa-sliders" style="font-size: 17px;"></i></button> -->
                            </div>
                            <div>
                                <!-- Feeds -->
                                <div class="pt-1 feeds row">
                                    <?php
                                    $getProperties1 = $this->db->query("SELECT * FROM x_home_property WHERE prop_status='1' AND prop_vendor='$id' ORDER BY prop_id DESC LIMIT 6");
                                    $properties1 = $getProperties1->result_array();
                                    if (count($properties1) > 0) {
                                        foreach ($properties1 as $row) {
                                    ?>
                                            <div class="col-md-4 mb-4">
                                                <?php
                                                include('inc/inc_shop_product_card.php');
                                                ?>
                                            </div>
                                        <?php
                                        }
                                    } else { ?>
                                        <!-- Feed Item -->
                                        <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm d-flex justify-content-center align-items-center text-center" style="min-height: 50px;">
                                            <p class="text-dark m-0">No Property found</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                        <div class="d-flex align-items-center">
                            <h4 class="ms-2 mb-2 text-black"><strong>Frequently Asked Questions</strong></h4>
                        </div>

                        <div class="accordion mt-3" id="faqAccordion">
                            <!-- Question 1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                                        How do I inquire about a property listed on <?= $site_name ?>?
                                    </button>
                                </h2>
                                <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Simply click the "Inquire" button on the property page and fill out the short form. Our team will get in touch with you shortly.
                                    </div>
                                </div>
                            </div>

                            <!-- Question 2 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                                        Is there a registration fee to use <?= $site_name ?>?
                                    </button>
                                </h2>
                                <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        No, browsing and inquiring about properties on <?= $site_name ?> is completely free for all users.
                                    </div>
                                </div>
                            </div>

                            <!-- Question 3 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                                        What types of properties are listed on <?= $site_name ?>?
                                    </button>
                                </h2>
                                <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        We list a wide variety of properties including residential homes, apartments, commercial spaces, and investment plots.
                                    </div>
                                </div>
                            </div>

                            <!-- Question 4 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                                        Can I schedule a property visit through <?= $site_name ?>?
                                    </button>
                                </h2>
                                <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes, once you inquire about a property, our agent will coordinate with you to schedule a visit at your convenience.
                                    </div>
                                </div>
                            </div>

                            <!-- Question 5 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeadingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFive" aria-expanded="false" aria-controls="faqCollapseFive">
                                        Are the property prices on <?= $site_name ?> negotiable?
                                    </button>
                                </h2>
                                <div id="faqCollapseFive" class="accordion-collapse collapse" aria-labelledby="faqHeadingFive" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        In most cases, yes. You can negotiate the price directly with the property holder or their representative during the inquiry process.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </main>
            <aside class="col col-xl-4 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
                <div class="fix-sidebar">
                    <div class="side-trend lg-none">
                        <div class="sticky-sidebar2 mb-3">
                            <div class="bg-white rounded-4 overflow-hidden shadow-sm mb-4 p-3">

                                <h4 class="fw-bold text-black">Why Choose <?= $user['name'] ?></h4>






                                <div style="background:rgba(0, 0, 0, 0.04 ); border-radius: 9px; "
                                    class="ps-2 pe-2 pt-2 pb-2 pb-1  mb-2 mt-1 gap-1 m-2 ">
                                    <div class="d-flex justify-content-between ">
                                        <em> <strong>NEW LAUNCH </strong>Project</em></strong>
                                        <a href="<?= base_url('property') ?>/<?= $row['prop_id'] ?>/<?= url_smart($row['prop_name']) ?>" class="text-black text-decoration-underline">Learn more</a>
                                    </div>

                                    <hr class="m-1">
                                    <div class="d-flex justify-content-between">
                                        High Appreciation
                                        <li>Best choice</li>
                                        <li>Easy Payment</li>
                                    </div>
                                </div>





                                <ul class=" ">
                                    <li class="mb-2">Project based on south asian architecture</li>
                                    <li class="mb-2">Temperature controlled swimming pool for all seasons</li>
                                    <li class="mb-2">High-End Security and Surveillance</li>
                                    <li class="mb-2">Jogging Track and Walking Trails</li>
                                    <li class="mb-2">Prime Location with Excellent Connectivity</li>
                                    <li class="mb-2">Flexible Payment Plans Available</li>
                                    <li class="mb-2">Get Unit of your choice</li>
                                </ul>

                                <!-- Buttons -->
                                <div class="d-flex gap-2 mt-3">
                                    <a href="javascript:void(0);" class="btn btn-primary rounded-pill fw-bold col-md-6" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                                        <i class="fa-solid fa-circle-question" style="font-size:15px;margin-right:5px;"></i>Inquire
                                    </a>

                                    <a href="#faqAccordion" class="btn btn-outline-secondary rounded-pill fw-bold col-md-6"> <i class="fa-solid fa-message" style="font-size:15px;margin-right:5px;"></i> FAQ</a>
                                </div>






                            </div>
                            <?php if (!isset($_SESSION['yid']) || $_SESSION['plan'] == '') {  ?>
                                <div class="card p-4 text-light mb-4" style=" border-radius: 16px; background: linear-gradient(to bottom, #5A1D32, #5A1D32);">
                                    <h5 class="fw-bold text-white">Why Richo Club?</h5>
                                    <p class="text-white"> We don’t promise you just properties</p>

                                    <ul class=" text-white">
                                        <li class="mb-2">India’s First Elite <strong>Real Estate Club!</strong> </li>
                                        <li class="mb-2">Exclusive Community of <strong>Top 1% Investors</strong></li>
                                        <li class="mb-2"><strong>ZERO Brokerage</strong> - Buy Directly From Developer!</li>
                                        <li class="mb-2"><strong>1% Loyalty Benefits</strong> on Every Investment</li>
                                        <li class="mb-2">Online + Offline <strong>Legal Support</strong></li>
                                    </ul>

                                    <a href="<?= base_url('membership') ?>" class="btn  mt-3 py-2" style="background-color: white; color: #5A1D32; border-radius: 30px; font-weight: bold; font-size:12px;">
                                        Become a member
                                    </a>
                                </div>

                                <!-- <a href="<?= base_url('membership') ?>" class="btn btn-primary w-100 text-decoration-none rounded-4 py-3 fw-bold text-uppercase m-0 mb-2">Become a Member</a> -->
                            <?php } ?>




                        </div>
                    </div>
                </div>
            </aside>
            <!-- Inquiry Modal -->
            <div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content p-4 rounded-4">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inquiryModalLabel">Inquiry Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <form class="form-floating-space" action="<?= base_url('index.php/action/contact') ?>" method="post" id="contactForm" novalidate="novalidate" onsubmit="return uploadandform('<?= base_url('index.php/action/contact') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
                                        <!-- Name input-->
                                        <div class=" form-floating mb-3">
                                            <input class="form-control rounded-5" id="name" type="text" name="name" placeholder="Enter your name..." value="<?= @$_SESSION['name'] ?>" data-sb-validations="required">
                                            <label for="name">Full name</label>
                                        </div>
                                        <!-- Email address input-->
                                        <div class="form-floating mb-3 position-relative">
                                            <input class="form-control rounded-5" id="useremail" type="email" name="email" placeholder="name@example.com" value="<?= @$_SESSION['email'] ?>" required>
                                            <label for="useremail">Email address</label>
                                        </div>
                                        <!-- Phone number input-->
                                        <div class="form-floating mb-3">
                                            <input class="form-control rounded-5" id="phone" type="tel" name="phone" placeholder="(123) 456-7890" value="<?= @$_SESSION['phone'] ?>" data-sb-validations="required">
                                            <label for="phone">Phone number</label>
                                        </div>

                                        <!-- Subject input-->
                                        <div class="form-floating mb-3">
                                            <input class="form-control rounded-5" id="subject" type="text" name="subject" placeholder="Subject" data-sb-validations="required">
                                            <label for="subject">Subject</label>
                                        </div>
                                        <!-- Message input-->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control rounded-5" id="message" name="mess" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                            <label for="message">Message</label>
                                        </div>
                                        <!-- Captcha-->
                                        <div class="col-sm-12">
                                            <?php echo get_captcha('caprght_oplkion', 'sign9_form_90_feed'); ?>
                                        </div>
                                        <!-- Submit Button-->
                                        <div class="d-grid"><button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Submit</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php //include 'inc/_lsidebar.php' 
            ?>
            <?php //include 'inc/_rsidebar.php' 
            ?>
        </div>
    </div>
</div>