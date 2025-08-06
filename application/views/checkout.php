<div class="py-4">
    <div class="container">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="mb-5">
                        <div class="feature bg-primary bg-gradient text-white rounded-4 mb-3"><i class="fa-solid fa-user-plus"></i></div>
                        <h1 class="fw-bold text-black mb-1">Become a Member</h1>
                        <p class="lead fw-normal text-muted mb-0">We'd love to hear from you</p>
                    </div>
                    <!-- Feeds -->
                    <div class="feeds">
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
                                $itemsCount += $pro['p_qty'];
                            }
                            // Calculate the subtotal by summing up the p_prices
                            $subtotal = array_sum($pPrices);
                            // Calculate the total shipping cost by summing up the p_shipping_costs
                            $shippingCost = array_sum($pShippingCosts);

                            $grandTotal = $subtotal + $shippingCost;
                        ?>



                            <!--checkout section start-->
                            <div class="checkout-section ptb-120">
                                <div class="container">
                                    <div class="row g-4">
                                        <div class="col-xl-12">
                                            <div class="bg-white p-4 rounded-4 shadow-sm faq-page">
                                                <div class="mb-3">
                                                    <h5 class="lead fw-bold text-body mb-0">Billing Details</h5>
                                                </div>
                                                <form id="thecartform_da"
                                                    onsubmit="return ajaxsubmitform('<?= base_url('e_com/checkout') ?>',this,'error_div','loder_div','#','1', 'checkout');"
                                                    action="<?= base_url('e_com/checkout') ?>" method="post" class="form-floating-space">
                                                    <div class="row g-4">
                                                        <?php
                                                        $pro_det = $_SESSION['ecom_cart'];
                                                        foreach ($pro_det as $pro) { ?>
                                                            <input type="hidden" name="pname" value="<?= $pro['p_name'] ?>">
                                                            <input type="hidden" name="pprice" value="<?= $pro['p_price'] ?>">
                                                            <input type="hidden" name="pweight" value="<?= $pro['p_weight'] ?>">
                                                        <?php } ?>
                                                        <input type="hidden" name="yid" value="<?= $_SESSION['yid'] ?>">
                                                        <input type="hidden" name="ptotal" value="<?= $grandTotal ?>">

                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="name" class="form-control rounded-5" placeholder="Full Name">
                                                                <label>Full Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="email" name="email" class="form-control rounded-5" placeholder="Email">
                                                                <label>Email</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="number" name="phone" class="form-control rounded-5" placeholder="Phone">
                                                                <label>Phone</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="address" class="form-control rounded-5" placeholder="Address">
                                                                <label>Address</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="city" class="form-control rounded-5" placeholder="City">
                                                                <label>Town/City</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <select name="country" class="form-select rounded-5" id="country">
                                                                    <option value="1">India</option>
                                                                    <option value="2">United States</option>
                                                                    <option value="3">Netherlands</option>
                                                                    <option value="4">Bangladesh</option>
                                                                    <option value="5">Islands</option>
                                                                    <option value="6">Albania</option>
                                                                    <option value="7">Antigua Barbuda</option>
                                                                </select>
                                                                <label>Country/Region</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="pin" class="form-control rounded-5" placeholder="Zip Code">
                                                                <label>Zip Code</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <p class="mt-3 mb-0 fs-sm text-muted">By placing your order, you agree to our <a href="<?= base_url('privacy') ?>">Privacy Policy</a></p>

                                                    <div class="mt-4 d-grid">
                                                        <button type="submit" class="btn btn-primary w-100 rounded-5 fw-bold text-uppercase py-3">Pay Now</button>
                                                    </div>
                                                    <!-- <div class="mt-3 d-grid">
                                                    <a href="<?= base_url('cart') ?>" class="btn btn-outline-secondary w-100 rounded-5 py-3">Return to Cart</a>
                                                </div> -->

                                                    <!-- <h5 class="mt-5 lead fw-bold text-body mb-3">Payment Method</h5>
                                                <div class="bg-light p-3 rounded-4 d-flex align-items-center justify-content-between">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="cod" value="cash_on_delivery" id="cod" checked>
                                                        <label class="form-check-label" for="cod">Cash On Delivery</label>
                                                    </div>
                                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTK1uWRhW2F02nAqDJy2eaa7y452X77K4H62Q&usqp=CAU" alt="cod" class="img-fluid" style="max-width: 120px;">
                                                </div> -->
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Order Summary -->
                                        <!-- <div class="col-xl-4">
                            <div class="bg-white p-4 rounded-4 shadow-sm faq-page">
                                <div class="d-flex align-items-center mb-4">
                                    <h5 class="fw-bold text-body mb-0">Order Summary</h5>
                                    <span class="hr-line w-100 ms-2"></span>
                                </div>
                                <table class="w-100">
                                    <tr>
                                        <td>Items (<?php echo $itemsCount; ?>):</td>
                                        <td class="text-end">₹<?php echo number_format($subtotal, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping & Handling:</td>
                                        <td class="text-end">₹<?php echo number_format($shippingCost, 2); ?></td>
                                    </tr>
                                </table>
                                <hr class="my-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="fw-bold mb-0">Total</h6>
                                    <h6 class="fw-bold mb-0">₹<?= $grandTotal ?></h6>
                                </div>
                            </div> -->
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                    </div>
                </div>
            </main>
            <?php include 'inc/_lsidebar.php' ?>
            <?php include 'inc/_rsidebar.php' ?>
        </div>
    </div>
</div>