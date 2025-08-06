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
</style>
<?php
$mid = $property['prop_vendor'];
$user = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
?>

<div class="py-4">
    <div class="container-fluid">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-8 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                        <div class="p-3 ">
                            <!-- Property Name -->
                            <h5 class="mb-2 text-dark fw-bold"><?= $property['prop_name'] ?></h5>

                            <div class="d-flex justify-content-between align-items-start flex-wrap">
                                <div class="d-flex align-items-start gap-3">
                                    <!-- Property Holder Name -->
                                    <?php if ($user['name'] != '') { ?>
                                        <div class="d-flex align-items-center mb-1 text-muted">
                                            <span class="material-icons me-2" style="font-size: 18px;">person</span>
                                            <span><?= $user['name'] ?></span>
                                        </div>
                                    <?php } ?>

                                    <!-- Property Location -->
                                    <?php if ($property['prop_address'] != '') { ?>
                                        <div class="d-flex align-items-center text-muted">
                                            <span class="material-icons me-2" style="font-size: 18px;">location_on</span>
                                            <span><?= $property['prop_address'] ?></span>
                                        </div>
                                    <?php } ?>
                                </div>

                                <!-- Date -->
                                <?php if ($property['prop_date'] != '') { ?>
                                    <div class="text-end mt-2 mt-md-0">
                                        <span class="text-muted small d-flex align-items-center">
                                            <span class="material-icons me-1" style="font-size: 18px;">calendar_today</span>
                                            <?= date("d M Y", strtotime($property['prop_date'])) ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <?php
                        // Fetch Amenity Tags based on prop_amenity_list
                        $amenity_ids = explode(',', $property['prop_amenity_list']);
                        $amenity_tags = [];

                        foreach ($amenity_ids as $id) {
                            // Query x_home_prop_amenity to get the pa_tag_id for each amenity
                            $amenity_query = $this->db->select('pa_tag_id')
                                ->from('x_home_prop_amenity')
                                ->where('pa_tag_id', $id)
                                ->get();

                            $amenity_result = $amenity_query->row_array();
                            if ($amenity_result) {
                                $tag_id = $amenity_result['pa_tag_id'];

                                // Query yn_site_tags to get the tag name and icon for each tag_id
                                $tag_query = $this->db->select('stg_name, stg_icon')
                                    ->from('yn_site_tags')
                                    ->where('stg_tgid', $tag_id)
                                    ->get();

                                $tag_result = $tag_query->row_array();
                                if ($tag_result) {
                                    $amenity_tags[] = [
                                        'name' => $tag_result['stg_name'],
                                        'icon' => $tag_result['stg_icon']
                                    ];
                                }
                            }
                        }

                        // Fetch Furnished Tags based on prop_furnish_list
                        $furnish_ids = explode(',', $property['prop_furnish_list']);
                        $furnish_tags = [];

                        foreach ($furnish_ids as $id) {
                            // Query x_home_prop_furnished to get the pf_tag_id for each facility
                            $furnish_query = $this->db->select('pf_tag_id')
                                ->from('x_home_prop_furnished')
                                ->where('pf_tag_id', $id)
                                ->get();

                            $furnish_result = $furnish_query->row_array();
                            if ($furnish_result) {
                                $tag_id = $furnish_result['pf_tag_id'];

                                // Query yn_site_tags to get the tag name and icon for each tag_id
                                $tag_query = $this->db->select('stg_name, stg_icon')
                                    ->from('yn_site_tags')
                                    ->where('stg_tgid', $tag_id)
                                    ->get();

                                $tag_result = $tag_query->row_array();
                                if ($tag_result) {
                                    $furnish_tags[] = [
                                        'name' => $tag_result['stg_name'],
                                        'icon' => $tag_result['stg_icon']
                                    ];
                                }
                            }
                        }
                        ?>

                        <div class="d-flex">
                            <div class="w-100">
                                <!-- Post Content (Starts Below Profile Image) -->
                                <div class="mt-2">
                                    <?php if (!empty($property['prop_img1'])) { ?>
                                        <!-- Main Image Slider -->
                                        <div class="slider-for">
                                            <div>
                                                <img src="<?= base_url('assets/avator/upload/' . $property['prop_img1']) ?>" class="img-fluid rounded mb-3 w-100" alt="post-img" style="">
                                            </div>
                                            <?php
                                            // Query to get other images
                                            $this->db->where('pi_prop_id', $property['prop_id']);
                                            $query = $this->db->get('x_home_prop_images');
                                            foreach ($query->result() as $image) { ?>
                                                <div>
                                                    <img src="<?= base_url('assets/avator/upload/' . $image->pi_img_name) ?>" class="img-fluid rounded mb-3 w-100" alt="post-img" style="">
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <!-- Thumbnails -->
                                        <div class="slider-nav mt-2">
                                            <div>
                                                <img src="<?= base_url('assets/avator/upload/' . $property['prop_img1']) ?>" class="img-fluid rounded" alt="thumb-img" style="">
                                            </div>
                                            <?php foreach ($query->result() as $image) { ?>
                                                <div>
                                                    <img src="<?= base_url('assets/avator/upload/' . $image->pi_img_name) ?>" class="img-fluid rounded" alt="thumb-img" style="">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>


                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        const imageCount = $('.slider-for > div').length;

                                        if (imageCount > 1) {
                                            $('.slider-for').slick({
                                                slidesToShow: 1,
                                                slidesToScroll: 1,
                                                arrows: false,
                                                fade: true,
                                                asNavFor: '.slider-nav',
                                                autoplay: true,
                                                autoplaySpeed: 5000,
                                            });

                                            $('.slider-nav').slick({
                                                slidesToShow: 7,
                                                slidesToScroll: 1,
                                                asNavFor: '.slider-for',
                                                dots: true,
                                                centerMode: true,
                                                focusOnSelect: true,
                                                responsive: [{
                                                    breakpoint: 768, // Phone mode
                                                    settings: {
                                                        slidesToShow: 3
                                                    }
                                                }]
                                            });
                                        } else {
                                            $('.slider-for img').addClass('single-image');
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <?php if ($property['prop_youtube'] != '') { ?>
                        <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                            <div class="d-flex align-items-center">
                                <!--<i class="fa-solid fa-house-medical"></i>-->
                                <h4 class="ms-2 mb-2 text-black"><strong>Property Video:</strong></h4>
                            </div>
                            <div class="col-md-12">
                                <?= convertYoutube($property['prop_youtube']) ?>
                            </div>

                        </div>
                    <?php } ?>
                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">

                        <div class="mt-2">
                            <h4 class="mb-2 ms-2 text-black"><strong>Property Details</strong></h4>

                            <p class="mb-3 text-black"><?= $property['prop_desc'] ?></p>
                            <a href="<?= base_url('assets/avator/upload/') ?><?= $property['prop_brochure'] ?>" target="_blank" class="btn btn-primary rounded-pill fw-bold col-md-3">
                                <i class="fa-solid fa-circle-question" style="font-size:15px;margin-right:5px;"></i>Brochure
                            </a>

                        </div>
                    </div>
                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                        <div class="d-flex align-items-center">
                            <!--<span class="material-icons">wifi</span>-->
                            <h4 class="ms-2 mb-2 text-black"><strong>Property Specifications:</strong></h4>
                        </div>
                        <div class="row mt-2 m-0">

                            <div class="col-md-6">
                                <!-- Price -->
                                <div class="d-flex align-items-center mb-3">
                                    <span class="material-icons">attach_money</span>
                                    <p class="ms-2 mb-0"><strong>Price:</strong> ₹<?= number_format($property['prop_price']) ?></p>
                                </div>

                                <!-- Bedrooms -->
                                <div class="d-flex align-items-center mb-3">
                                    <span class="material-icons">bed</span>
                                    <p class="ms-2 mb-0"><strong>Bedrooms:</strong> <?= $property['prop_bedroom'] ?></p>
                                </div>

                                <!-- Bathrooms -->
                                <div class="d-flex align-items-center mb-3">
                                    <span class="material-icons">bathtub</span>
                                    <p class="ms-2 mb-0"><strong>Bathrooms:</strong> <?= $property['prop_bathroom'] ?></p>
                                </div>

                                <!-- Balconies -->
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fa-solid fa-rectangle-vertical-history"></i>
                                    <p class="ms-2 mb-0"><strong>Balconies:</strong> <?= $property['prop_balcony'] ?></p>
                                </div>

                                <!-- Floor Details -->
                                <!-- <div class="d-flex align-items-center mb-3">
                                            <i class="fa-solid fa-stairs"></i>
                                            <p class="ms-2 mb-0"><strong>Floor:</strong> <?= $property['prop_floor'] ?> / <?= $property['prop_total_floors'] ?> Floors</p>
                                        </div> -->
                                <!-- Amenities List -->


                            </div>

                            <!-- Right Column: Area, Amenities, and Facilities -->
                            <div class="col-md-6">
                                <!-- Area -->
                                <div class="d-flex align-items-center mb-3">
                                    <span class="material-icons">home</span>
                                    <p class="ms-2 mb-0"><strong>Area:</strong> <?= $property['prop_area'] ?> sqft</p>
                                </div>
                                <!-- Facing Direction -->
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fa-solid fa-compass"></i>
                                    <p class="ms-2 mb-0"><strong>Facing:</strong> <?= $property['prop_facing'] ?></p>
                                </div>

                                <!-- Fetch Amenities and Facilities (Keep the existing code intact) -->






                                <!-- Address and City -->
                                <div class="d-flex align-items-center mb-3">
                                    <span class="material-icons">location_on</span>
                                    <p class="ms-2 mb-0"><strong>Address:</strong> <?= $property['prop_address'] ?></p>
                                </div>
                                <!-- 
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="material-icons">place</span>
                                            <p class="ms-2 mb-0"><strong>City:</strong> <?= $property['prop_city_name'] ?>, <?= $property['prop_state_name'] ?></p>
                                        </div> -->
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fa-solid fa-stairs"></i>
                                    <p class="ms-2 mb-0"><strong>Floor:</strong> <?= $property['prop_floor'] ?> / <?= $property['prop_total_floors'] ?> Floors</p>
                                </div>
                                <!-- Facilities List -->
                                <!-- Facilities Section -->
                                <!-- Facilities Section -->
                                <!-- <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-house-medical"></i>
                                                <p class="ms-2 mb-0"><strong>Facilities:</strong></p>
                                            </div>

                                            Facilities List Block
                                            <div class="facilities-block ">
                                                <ul class="list-unstyled mb-0">
                                                    <?php foreach ($furnish_tags as $tag) { ?>
                                                        <li class="facility-item mb-2">
                                                            <i class="<?= $tag['icon'] ?>"></i>
                                                            <span class="ms-2"><?= $tag['name'] ?></span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div> -->


                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                        <div class="d-flex align-items-center">
                            <!--<span class="material-icons">wifi</span>-->
                            <h4 class="ms-2 mb-2 text-black"><strong>Property Amenities:</strong></h4>
                        </div>
                        <div class="facilities-block mt-3">
                            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
                                <?php foreach ($amenity_tags as $tag) { ?>
                                    <div class="col d-flex justify-content-center">
                                        <div class="facility-box text-center p-3">
                                            <div class="icon-box mb-2">
                                                <i class="<?= $tag['icon'] ?>"></i>
                                            </div>
                                            <div class="amenity-name">
                                                <span><?= $tag['name'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                        <div class="d-flex align-items-center">
                            <!--<i class="fa-solid fa-house-medical"></i>-->
                            <h4 class="ms-2 mb-2 text-black"><strong>Property Facilities:</strong></h4>
                        </div>
                        <div class="facilities-block mt-3">
                            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
                                <?php foreach ($furnish_tags as $tag) { ?>
                                    <div class="col d-flex justify-content-center">
                                        <div class="facility-box text-center p-3">
                                            <div class="icon-box mb-2">
                                                <i class="<?= $tag['icon'] ?>"></i>
                                            </div>
                                            <div class="amenity-name">
                                                <span><?= $tag['name'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
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
                    <?php if ($property['prop_map'] != '') { ?>
                        <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                            <div class="d-flex align-items-center">
                                <!--<i class="fa-solid fa-house-medical"></i>-->
                                <h4 class="ms-2 mb-2 text-black"><strong>Property Location:</strong></h4>
                            </div>
                            <div class="col-md-12">
                                <?= $property['prop_map'] ?>
                            </div>
                        </div>
                    <?php } ?>
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

                                <!-- Property Info -->
                                <h3 class="fw-bold text-dark mb-3"><?= $property['prop_name'] ?></h3>

                                <!-- Developer Name -->
                                <?php if ($user['name'] != '') { ?>
                                    <div class="mb-2 d-flex align-items-center text-muted">
                                        <span class="material-icons me-2">business</span>
                                        Developed By : <?= $user['name'] ?>
                                    </div>
                                <?php } ?>

                                <!-- Area -->
                                <?php if ($property['prop_area'] != '') { ?>
                                    <div class="mb-2 d-flex align-items-center text-muted">
                                        <span class="material-icons me-2">square_foot</span>
                                        Area : <?= $property['prop_area'] ?> sqft
                                    </div>
                                <?php } ?>

                                <!-- Location -->
                                <?php if ($property['prop_address']  != '') { ?>
                                    <div class="mb-2 d-flex align-items-center text-muted">
                                        <span class="material-icons me-2">location_on</span>
                                        Address : <?= $property['prop_address'] ?>
                                    </div>
                                <?php } ?>

                                <!-- Price -->
                                <?php if ($property['prop_price'] != '') { ?>
                                    <div class="mb-3 d-flex align-items-center text-muted">
                                        <span class="material-icons me-2">attach_money</span>
                                        Price : ₹<?= number_format($property['prop_price']) ?>
                                    </div>
                                <?php } ?>

                                <!-- Buttons -->
                                <div class="d-flex gap-2 mt-3 mb-2">
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

                            <div class="card border-0 bg-white rounded-4 overflow-hidden shadow-sm mb-4 p-3">
                                <h5 class="fw-bold mb-3 text-dark">
                                    <i class="fa-solid fa-house-user" style="font-size:15px;margin-right:5px;"></i>
                                    Why you should consider <span class="text-primary">BPTP Amstoria?</span>
                                </h5>

                                <ul class="mb-3 ps-3">
                                    <li class="mb-2">126 Acres township with 4000 trees</li>
                                    <li class="mb-2">2-Acre sanctuary club equipped with modern amenities</li>
                                    <li class="mb-2">Strategically connect to Northern Periphery Road (Dwarka Expressway)</li>
                                </ul>

                                <a href="#" class="fw-semibold text-primary text-decoration-none">
                                    View 4 more →
                                </a>

                                <hr class="my-3">

                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-0 text-muted text-uppercase" style="font-size: 12px;">Developed by</p>
                                        <h6 class="fw-bold mb-0">BPTP Limited</h6>
                                    </div>
                                    <img src="<?= base_url('assets/avator/bptp.png') ?>" alt="BPTP Logo" style="width: 70px;">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </aside>
                <!-- Sticky Button for Mobile -->
                                <div class="inquire-btn-mobile d-md-none">
                                  <a href="javascript:void(0);" class="btn btn-primary rounded-pill fw-bold"
                                     data-bs-toggle="modal" data-bs-target="#inquiryModal">
                                    <i class="fa-solid fa-circle-question" style="font-size:15px;margin-right:5px;"></i>
                                    Inquire
                                  </a>
                                </div>
                                
                                <!-- Custom CSS -->
                                <style>
                                .inquire-btn-mobile {
                                      position: fixed;
                                    bottom: 60px;
                                    left: 230px;
                                    z-index: 1050;
                                }
                                </style>
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


                                        <div class="form-floating mb-3">
                                            <select name="property" class="form-control rounded-5">
                                                <?php
                                                $property = $this->db->query("SELECT * FROM x_home_property WHERE prop_id='" . $property['prop_id'] . "'")->row_array();
                                                echo '<option value="' . $property['prop_name'] . '">' . $property['prop_name'] . '</option>';
                                                ?>
                                            </select>
                                            <label for="property">Property</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-5" name="budget" placeholder="Enter your budget" required>
                                            <label for="budget">Budget</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-5" name="preferences" placeholder="Enter your preferences" required>
                                            <label for="preferences">Preferences</label>
                                        </div>

                                        <!-- Multiple Document Upload Field -->
                                        <div class="mb-3">
                                            <label for="documents" class="form-label">Upload Documents</label>
                                            <input type="file" class="form-control" name="documents[]" id="documents" multiple>
                                        </div>

                                        <input type="hidden" name="property_id" value="<?= $property['prop_id'] ?>">


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