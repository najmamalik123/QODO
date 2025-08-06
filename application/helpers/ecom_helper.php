<?php

function add_tocart($btntxt, $prid)
{ ?>
    <form id="thecartform_da"
        onsubmit="return ajaxsubmitform('<?= base_url('e_com/add_to_cart') ?>',this,'error_div','loder_div','#','1','cart2');"
        action="<?= base_url('e_com/add_to_cart') ?>" method="post">

        <table class="table table-borderless">
            <tr>
                <!-- <td>
                    <div class="qty-plus-minus">
                        <input class="qty-input" type="text" name="ec_qtybtn" min="1" minlength="1" value="1">
                    </div>
                </td> -->
                <td>
                    <div class="ec-single-cart">
                        <input type="hidden" name="pid" value="<?= $prid ?>">
                        <button class="edu-btn" title="Add to Cart" type="submit"><span><?= $btntxt ?></span></button>
                    </div>
                </td>
            </tr>
        </table>
    </form>
<?php }

function add_tocart2($btntxt, $prid)
{ ?>
    <form id="thecartform_da"
        onsubmit="return ajaxsubmitform('<?= base_url('e_com/add_to_cart') ?>',this,'error_div','loder_div','#','1','cart2');"
        action="<?= base_url('checkout') ?>" method="post">

        <!-- <table class="table table-borderless"><tr> -->
        <!-- <td> -->
        <!-- <input class="qty-input" type="hidden" name="ec_qtybtn" min="1" minlength="1" value="1"> -->

        <input type="hidden" name="pid" value="<?= $prid ?>">
        <button class="btn theme_bg btn-primary ml-3" title="Buy Now" type="submit"><span><?= $btntxt ?></span></button>
        <!-- </td> -->
        <!-- </tr></table> -->
    </form>
<?php }







function add_tocart3($btntxt, $prid)
{ ?>
    <form id="thecartform_da"
        onsubmit="return ajaxsubmitform('<?= base_url('e_com/add_to_cart') ?>',this,'error_div','loder_div','<?= base_url('checkout') ?>','0','cart3');"
        action="<?= base_url('checkout') ?>" method="post">

        <input type="hidden" name="pid" value="<?= $prid ?>">



        <!-- <ul class="product-radio-btn mb-4 d-flex align-items-center gap-2">
    <?php
    $weightValues = explode(',', $pweight);
    foreach ($weightValues as $key => $weight) {
        $checked = ($key === 0) ? 'checked' : '';
    ?>
        <li>
            <input name="ec_weight" value="<?= htmlspecialchars($weight) ?>" id="weight<?= htmlspecialchars($weight) ?>"
                type="radio" <?= $checked ?>>
            <label for="weight<?= htmlspecialchars($weight) ?>"> <?= htmlspecialchars($weight) ?> </label>
        </li>
    <?php
    }
    ?>
</ul> -->


        <div class="d-flex align-items-center gap-4 flex-wrap">
            <!-- <div class="product-qty d-flex align-items-center">
                <button type="button" class="decrease">-</button>
                <input type="number" name="ec_qtybtn" value="1" data-counter="">
                <button type="button" class="increase">+</button>
            </div> -->
            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold text-uppercase py-1 text-decoration-none">
                <?= $btntxt ?>
            </button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const decreaseButton = document.querySelector('.decrease');
                const increaseButton = document.querySelector('.increase');
                const quantityInput = document.querySelector('[name="ec_qtybtn"]');

                decreaseButton.addEventListener('click', function() {
                    if (quantityInput.value > 1) {
                        quantityInput.value = parseInt(quantityInput.value, 10) - 1;
                    }
                });

                increaseButton.addEventListener('click', function() {
                    quantityInput.value = parseInt(quantityInput.value, 10) + 1;
                });
            });
        </script>






        <!-- <div class="product__variant--list quantity d-flex align-items-center mb-20">
        <div class="quantity__box">
            <button type="button" class="quantity__value quickview__value--quantity decrease"
                aria-label="quantity value" value="Decrease Value">-</button>
            <label>
                <input type="number" name="ec_qtybtn" class="quantity__number quickview__value--number" value="1"
                    data-counter="">
            </label>
            <button type="button" class="quantity__value quickview__value--quantity increase"
                aria-label="quantity value" value="Increase Value">+</button>
        </div>
        <button type="submit" class="primary__btn quickview__cart--btn"><?= $btntxt ?></button>



    </div> -->
    </form>

<?php }







function generate_order_id()
{
    $theordrid = date('mhs') . rand();
    return $theordrid;
}

function get_product_data($product_id = null)
{
    $ci = &get_instance();
    $chkData = $ci->db->query("SELECT * FROM `yn_ecom_products` where p_id = '$product_id' ");
    $arrResult = array();
    $TempData = null;
    if ($chkData->num_rows() > 0) {
        $TempData = $chkData->result_array();
        $arrResult = $TempData[0];
    } else {
        $arrResult = array();
    }
    return $arrResult;
}

?>