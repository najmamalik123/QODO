<div class="py-4">
    <div class="container-fluid">
        <div class="row position-relative justify-content-center">
            <!-- Main Content -->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="mb-5" style="display: flex; gap: 30px;">
                        <div class="feature bg-primary bg-gradient text-white rounded-4 mb-3"><i class="fa-solid fa-user-plus"></i></div>
                        <h1 class="fw-bold text-black mb-1">Become a Member</h1>
                        <!-- <p class="lead fw-normal text-muted mb-0">We'd love to hear from you</p> -->
                    </div>
                    <!-- Feeds -->
                    <div class="feeds row">
                        <!-- Feed Item -->
                        <?php $products = $this->db->query("SELECT * FROM yn_ecom_products WHERE p_category = 'Membership' AND p_status = '1' ORDER BY p_id ASC");
                        $productss = $products->result_array();
                        foreach ($productss as $product) { ?>

                            <!-- Membership Plan Card -->
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12 p-2 ">
                                <div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page mt-4">
                                    <div class="mb-3">
                                    <h5 class="lead fw-bold text-body mb-0"><?= $product['p_name'] ?> ( ₹<?= $product['p_price'] ?> )</h5>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted mb-3"><?= $product['p_descp'] ?></p>
                                </div>
                                <div class="d-grid">
                                    <?= add_tocart3('Join Now', $product['p_id']) ?>
                                    <!-- <a href="<?= base_url('checkout') ?>" class="btn btn-primary w-100 rounded-5 fw-bold text-uppercase py-3 text-decoration-none">Join Now for ₹<?= $product['p_price'] ?></a> -->
                                </div>
                               </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </main>

        </div>
    </div>
</div>