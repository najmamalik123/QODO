<div class="pb-4">
    <div class="container-fluid mt-3">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="tab-content py-3" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <div class="d-flex justify-content-between">
                                <h4 class="text-black fw-bold">Recommended Properties</h4>
                            </div>
                            <div>
                                <div class="pt-1 feeds row" id="property-list">
                                    <?php
                                    $total_properties = count($properties);
                                    $initial_limit = 6;
                                    $index = 0;

                                    foreach ($properties as $row) {
                                        $display = ($index < $initial_limit) ? '' : 'style="display:none"';
                                        echo '<div class="col-md-4 mb-4 property-item" ' . $display . '>';
                                        include('inc/inc_shop_product_card.php');
                                        echo '</div>';
                                        $index++;
                                    }
                                    ?>
                                </div>

                                <?php if ($total_properties > $initial_limit): ?>
                                    <div class="text-center mt-3">
                                        <button id="loadMoreBtn" class="btn btn-outline-dark rounded-pill px-4 py-2">See More</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let currentVisible = 6;
                            const step = 9;
                            const items = document.querySelectorAll('.property-item');
                            const loadMoreBtn = document.getElementById('loadMoreBtn');

                            loadMoreBtn?.addEventListener('click', function() {
                                let shown = 0;

                                for (let i = currentVisible; i < items.length && shown < step; i++) {
                                    items[i].style.display = '';
                                    shown++;
                                }

                                currentVisible += shown;

                                if (currentVisible >= items.length) {
                                    loadMoreBtn.style.display = 'none';
                                }
                            });
                        });
                    </script>

                    <div class="tab-content py-3" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <div class="d-flex justify-content-between">
                                <h4 class="fw-bold text-black">Projects in High Demand</h4>
                                <!-- <button data-bs-toggle="modal" data-bs-target="#filtersModal" class="btn btn-secondary rounded-5 fw-bold px-3 py-2 fs-6 mb-0 d-flex align-items-center"><i class="fa-solid fa-sliders" style="font-size: 17px;"></i></button> -->
                            </div>
                            <div>
                                <!-- Feeds -->
                                <div class="pt-1 feeds row">
                                    <?php

                                    $getleads = $this->db->query("
                                        SELECT property, COUNT(*) AS total_leads
                                        FROM yn_site_contact
                                        WHERE property != '0'
                                        GROUP BY property
                                        ORDER BY total_leads DESC
                                        LIMIT 3
                                    ");


                                    $property_ids = [];
                                    foreach ($getleads->result() as $lead) {
                                        $property_ids[] = $lead->property;
                                    }


                                    $getProperties1 = $this->db->query("
                                        SELECT * FROM x_home_property 
                                        WHERE prop_status='1' 
                                        AND prop_id IN (" . implode(',', $property_ids) . ")
                                    ");


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

                    <section class="py-3">
                        <div class="container">
                            <h4 class="fw-bold mb-2 text-black">Apartments, Villas and more</h4>
                            <!-- <p class="text-muted mb-4">in Gurgaon</p> -->

                            <div class="row">
                                <?php
                                $categories = $this->db->query("SELECT * FROM yn_site_catagory  ORDER BY ctid ASC LIMIT 3")->result_array();
                                foreach ($categories as $cat) { ?>
                                    <div class="col-md-4 mb-4">
                                        <a href="<?= base_url('properties') ?>?categories=<?= $cat['ctid'] ?>" class="text-decoration-none">
                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
                                                <div style="height: 200px; background-image: url('<?= base_url('assets/avator/upload/' . $cat['img']) ?>'); background-size: cover; background-position: center;"></div>
                                                <div class="card-body text-center" style="background-color: <?= $cat['bg_color'] ?? '#f7f7f7' ?>;">
                                                    <h5 class="fw-semibold text-dark"><?= $cat['name'] ?></h5>
                                                    <!-- <p class="text-muted"><?= number_format($cat['property_count']) ?>+ Properties</p> -->
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>

                    <div class="tab-content py-3" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <div class="d-flex justify-content-between">
                                <h4 class="fw-bold text-black">Based on Search Trends</h4>
                                <!-- <button data-bs-toggle="modal" data-bs-target="#filtersModal" class="btn btn-secondary rounded-5 fw-bold px-3 py-2 fs-6 mb-0 d-flex align-items-center"><i class="fa-solid fa-sliders" style="font-size: 17px;"></i></button> -->
                            </div>
                            <div>
                                <!-- Feeds -->
                                <div class="pt-1 feeds row">
                                    <?php
                                    $getProperties1 = $this->db->query("SELECT * FROM x_home_property WHERE prop_status='1' ORDER BY rand() LIMIT 6");
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
            </main>

        </div>
    </div>
</div>