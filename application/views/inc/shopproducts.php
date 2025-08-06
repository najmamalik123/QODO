<?php
$p_category = $pro['p_category'];

$thecats = $this->db->query("select * from yn_site_catagory where ctid ='$p_category'"); 
$the_cats=$thecats->row_array();
                    
$url = base_url('product') . '/' . $pro['p_id'] . '/' . url_smart($pro['p_name']);
?>

<div class="vertical-product-card rounded-2 position-relative border-0 bg-white bg-white">
    <span class="offer-badge text-white fw-bold fs-xxs bg-danger position-absolute start-0 top-0"><?= round($pro['p_discount']) ?>% OFF</span>
    <div class="thumbnail position-relative text-center p-4">
        <img src="<?= base_url('assets/avator/upload') ?>/<?= $pro['p_cover'] ?>" alt="apple" class="img-fluid">
        <div class="product-btns position-absolute d-flex gap-2 flex-column">
            <a href="<?= $url ?>" data-bs-toggle="modal" class="rounded-btn"><i class="fa-regular fa-eye"></i></a>
        </div>
    </div>
    <div class="card-content">
        <div class="mb-2  tt-category tt-line-clamp tt-clamp-1">
            <a href="<?= $url ?>" class="d-inline-block text-muted fs-xxs"><?=$the_cats['name']?></a>
        </div>
        <a href="<?= $url ?>" class="card-title fw-bold d-block mb-2 tt-line-clamp tt-clamp-2"><?=$pro['p_name']?></a>
        <div class="d-flex align-items-center flex-nowrap star-rating fs-xxs mb-2">
            <?= ratings_star($pro['p_star'], 'star','20px') ?>
        </div>
        <h6 class="price text-danger mb-4">₹<?= $pro['p_price'] ?></h6>
        <a href="<?= $url ?>" class="btn btn-outline-secondary d-block btn-md">Add to Cart</a>
    </div>
</div>