<?php
$url = base_url('product') . '/' . $pro['p_id'] . '/' . url_smart($pro['p_name']);
?>

<div class="horizontal-product-card d-sm-flex align-items-center bg-white rounded-2 mt-4 gap-3 card-md">
    <div class="thumbnail position-relative rounded-2">
        <a href="<?= $url ?>"><img src="<?= base_url('assets/avator/upload') ?>/<?= $pro['p_cover'] ?>" alt="product"
                class="img-fluid"></a>
        <div
            class="product-overlay position-absolute start-0 top-0 w-100 h-100 d-flex align-items-center justify-content-center gap-2 rounded-2">
            <a href="<?= $url ?>" class="rounded-btn"><i class="fa-solid fa-eye"></i></a>
        </div>
    </div>
    <div class="card-content mt-3 mt-sm-0">
        <a href="<?= $url ?>" class="d-block fs-sm fw-bold text-heading title d-block"><?= trim_text($pro['p_name'] , '27') ?></a>
        <div class="pricing mt-0">
            <span class="fw-bold fs-xxs text-danger">₹<?= $pro['p_price'] ?></span>
        </div>
        <div class="d-flex align-items-center flex-nowrap star-rating mt-1">
        <?= ratings_star($pro['p_star'], 'star') ?>
        </div>
    </div>
</div>