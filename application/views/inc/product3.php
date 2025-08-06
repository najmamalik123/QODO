<?php
$url = base_url('product') . '/' . $pro['p_id'] . '/' . url_smart($pro['p_name']);
?>

<div class="horizontal-product-card d-sm-flex align-items-center border p-3 bg-white rounded-2 gap-4">
    <div class="thumbnail position-relative rounded-2">
        <a href="<?= $url ?>"><img src="<?= base_url('assets/avator/upload') ?>/<?= $pro['p_cover'] ?>"
                alt="product" class="img-fluid"></a>
        <div
            class="product-overlay position-absolute start-0 top-0 w-100 h-100 d-flex align-items-center justify-content-center gap-2 rounded-2">
            <!-- <a href="#" class="rounded-btn"><i class="fa-regular fa-heart"></i></a> -->
            <a href="<?= $url ?>" class="rounded-btn"><i class="fa-solid fa-eye"></i></a>
        </div>
    </div>
    <div class="card-content mt-4 mt-sm-0">
        <div class="d-flex align-items-center flex-nowrap star-rating">
        <?= ratings_star($pro['p_star'], 'star') ?>
        </div>
        <a href="<?= $url ?>" class="fw-bold text-heading title d-block"><?= trim_text($pro['p_name'] , '27') ?></a>
        <div class="pricing mt-2">
            <span class="fw-bold h4 deleted me-1 text-muted">₹<?= $pro['p_mrp'] ?></span>
            <span class="fw-bold h4 text-danger">₹<?= $pro['p_price'] ?></span>
        </div>
        <a href="<?= $url ?>" class="fs-xs fw-bold mt-3 d-inline-block explore-btn">Shop Now<span class="ms-1"><i class="fa-solid fa-arrow-right"></i></span></a>
    </div>
</div>