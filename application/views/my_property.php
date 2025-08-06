<style>
    label {
        font-size: 11px;
    }
</style>
<div class="py-4">
    <div class="container-fluid">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <!-- Follow People -->
                            <div class="ms-1">
                                <!-- Feeds -->
                                <div class="feeds" id="feed">
                                    <div class="card mb-3 p-3 shadow-sm">
                              

                                        <!-- My Properties Tab -->
                                        <div class="d-flex justify-content-between">
                                            <h4 class="text-black">My Properties</h4>
                                            <?php if($profile_data['is_vendor']=='1') { ?>
                                            <a href="<?= base_url('add-property')?>" class="btn btn-login mt-2 mb-2 rounded-pill" >+ Add Property</a>
                                            <?php } ?>
                                        </div>
                                        <div>
                                            <!-- Feeds -->
                                            <div class="pt-1 feeds">
                                                <?php
                                                $yid = $_SESSION['yid'];
                                                // echo $yid;
                                                $getProperties = $this->db->query("SELECT * FROM x_home_property WHERE prop_vendor='$yid' ORDER BY prop_id DESC LIMIT 50");
                                                $properties = $getProperties->result_array();
                                                if (count($properties) > 0) {
                                                    foreach ($properties as $row) {
                                                         
                                                        include('inc/inc_property.php');
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

                            </div>
                        </div>
                    </div>
                </div>
          
        </main>

    

        <?php include 'inc/_lsidebar.php' ?>
    </div>
</div>
</div>