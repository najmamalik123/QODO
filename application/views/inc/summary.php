<aside class="checkout__sidebar sidebar border-radius-10">
    <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
    <div class="cart__table checkout__product--table">
        <table class="cart__table--inner">
            <tbody class="cart__table--body">
                <?php

                if (isset($_SESSION['ecom_cart']) && count($_SESSION['ecom_cart'])>=1) { 
                $pro_det = $_SESSION['ecom_cart'];

                // print_r($pro_det); die;
                foreach ($pro_det as $pro) {
                if (isset($pro['p_name']) && isset($pro['p_price']) && isset($pro['p_img'])) {
                                    ?>
                <tr class="cart__table--body__items">
                    <td class="cart__table--body__list">
                        <div class="product__image two  d-flex align-items-center">
                            <div class="product__thumbnail border-radius-5">
                                <a class="display-block"
                                    href="<?= base_url('product') ?>/<?= $pro['p_id'] ?>/<?= url_smart($pro['p_name']) ?>"><img
                                        class="display-block border-radius-5"
                                        src="<?=base_url('assets/avator/upload/')?><?=@$pro['p_img']?>"
                                        alt="cart-product"></a>
                                <span class="product__thumbnail--quantity"><?= $pro['p_qty'] ?></span>
                            </div>
                            <div class="product__description">
                                <h4 class="product__description--name"><a
                                        href="<?= base_url('product') ?>/<?= $pro['p_id'] ?>/<?= url_smart($pro['p_name']) ?>"><?= $pro['p_name'] ?></a>
                                </h4>
                                <span class="product__description--variant">COLOR: <?= @$pro['p_color'] ?></span>
                            </div>
                        </div>
                    </td>
                    <td class="cart__table--body__list">
                        <span class="cart__price">₹<?= $pro['p_price'] * $pro['p_qty']?></span>
                    </td>
                </tr>
                <?php } }  }?>

            </tbody>
        </table>
    </div>
    <div class="checkout__discount--code">
        <form class="d-flex" action="#">
            <label>
                <input class="checkout__discount--code__input--field border-radius-5"
                    placeholder="Gift card or discount code" type="text">
            </label>
            <button class="checkout__discount--code__btn primary__btn border-radius-5" type="submit">Apply</button>
        </form>
    </div>
    <div class="checkout__total">

        <?php
            if (isset($_SESSION['ecom_cart']) && count($_SESSION['ecom_cart']) >= 1) { 
                $pro_det = $_SESSION['ecom_cart']; 
                $subtotal = 0;
                $shippingCost = 0;
                
                $pPrices = array();
                $pShippingCosts = array();

                foreach ($pro_det as $pro) {
                    if (isset($pro['p_price'])) {
                        $pPrices[] = $pro['p_price'] * $pro['p_qty'];
                    }
                    if (isset($pro['p_shipping_cost'])) {
                        $pShippingCosts[] = $pro['p_shipping_cost'];
                    }
                }
                // Calculate the subtotal by summing up the p_prices
                $subtotal = array_sum($pPrices);
                // Calculate the total shipping cost by summing up the p_shipping_costs
                $shippingCost = array_sum($pShippingCosts);
                
                $grandTotal = $subtotal + $shippingCost;
                ?>

        <table class="checkout__total--table">
            <tbody class="checkout__total--body">
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left">Subtotal</td>
                    <td class="checkout__total--amount text-right">₹<?= $subtotal ?></td>
                </tr>
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left">Shipping</td>
                    <td class="checkout__total--calculated__text text-right">₹<?= $shippingCost ?></td>
                </tr>
            </tbody>
            <tfoot class="checkout__total--footer">
                <tr class="checkout__total--footer__items">
                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">Total</td>
                    <td class="checkout__total--footer__amount checkout__total--footer__list text-right">
                        ₹<?= $grandTotal ?></td>
                </tr>
            </tfoot>
        </table>
        <?php } ?>

    </div>
    <!-- <div class="payment__history mb-30">
        <h3 class="payment__history--title mb-20">Payment</h3>
        <ul class="payment__history--inner d-flex">
            <li class="payment__history--list"><button class="payment__history--link primary__btn" type="submit">Credit Card</button></li>
            <li class="payment__history--list"><button class="payment__history--link primary__btn" type="submit">Bank Transfer</button></li>
            <li class="payment__history--list"><button class="payment__history--link primary__btn" type="submit">Paypal</button></li>
        </ul>
    </div> -->
    <button class="checkout__now--btn primary__btn mt-5" type="submit">Checkout Now</button>
</aside>