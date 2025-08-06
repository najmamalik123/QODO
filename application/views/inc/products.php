<?php
$p_category = $pro['p_category'];

$thecats = $this->db->query("select * from yn_site_catagory where ctid ='$p_category'"); 
$the_cats=$thecats->row_array();
                    
$url = base_url('product') . '/' . $pro['p_id'] . '/' . url_smart($pro['p_name']);
?>

<div class="vertical-product-card rounded-2 position-relative">
    <div class="thumbnail position-relative text-center p-4">
        <a href="<?= $url ?>"><img src="<?= base_url('assets/avator/upload') ?>/<?= $pro['p_cover'] ?>" alt="apple"
                class="img-fluid"></a>
        <div class="product-btns position-absolute d-flex gap-2 flex-column">
            <a href="#quickview_modal" data-bs-toggle="modal" class="rounded-btn"><i class="fa-regular fa-eye"></i></a>
        </div>
    </div>
    <div class="card-content">
        <a href="shop-grid.html"
            class="mb-2 d-inline-block text-secondary fw-semibold fs-xxs"><?=$the_cats['name']?></a>
        <a href="<?= $url ?>" class="card-title fw-bold d-block mb-2"><?=$pro['p_name']?></a>
        <div class="d-flex align-items-center flex-nowrap star-rating fs-xxs mb-2">
            <?= ratings_star($pro['p_star'], 'star','20px') ?>
        </div>
        <h6 class="price text-danger mb-3">₹<?= $pro['p_price'] ?></h6>
    </div>
    <div class="card-btn bg-white">
        <a href="<?= $url ?>" class="btn btn-secondary d-block btn-md rounded-1">Add to Cart</a>
    </div>
</div>
