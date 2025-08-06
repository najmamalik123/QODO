        <!--breadcrumb section start-->
        <div class="gstore-breadcrumb position-relative z-1 overflow-hidden mt--50">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/bg-shape-6.png" alt="bg-shape"
                class="position-absolute start-0 z--1 w-100 bg-shape">
                <img src="<?=base_url('assets/theme/gostore')?>/img/shape/1.png" width="40px" alt="pata"
                class="position-absolute pata-xs z--1 vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/2.png" width="40px" alt="onion"
                class="position-absolute z--1 onion start-0 top-0 vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/3.png" width="40px" alt="frame circle"
                class="position-absolute z--1 frame-circle vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/4.png" width="40px" alt="leaf"
                class="position-absolute z--1 leaf vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/5.png" width="40px" alt="garlic"
                class="position-absolute z--1 garlic vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/6.png" width="40px" alt="roll"
                class="position-absolute z--1 roll vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/1.png" width="40px" alt="roll"
                class="position-absolute z--1 roll-2 vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/2.png" width="40px" alt="roll"
                class="position-absolute z--1 pata-xs-2 vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/3.png" width="40px" alt="tomato"
                class="position-absolute z--1 tomato-half vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/4.png" width="40px" alt="tomato"
                class="position-absolute z--1 tomato-slice vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/5.png" width="40px" alt="tomato"
                class="position-absolute z--1 cauliflower vector-shape">
            <img src="<?=base_url('assets/theme/gostore')?>/img/shape/6.png" width="40px" alt="tomato"
                class="position-absolute z--1 leaf-gray vector-shape">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h2 class="mb-2 text-center">Shopping Cart</h2>
                            <nav>
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item fw-bold" aria-current="page"><a
                                            href="<?=base_url()?>">Home</a></li>
                                    <li class="breadcrumb-item fw-bold" aria-current="page">Cart Page</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb section end-->

        <!--cart section start-->
        <section class="cart-section ptb-120">
            <div class="container">
                <div class="select-all d-flex align-items-center justify-content-between bg-white rounded p-4">
                    <div class="d-inline-flex gap-2 align-items-center">
                        <label for="select-all">Cart</label>
                    </div>

                    <form
                        onsubmit="return ajaxsubmitform('<?= base_url('e_com/clearCartSession') ?>',this,'error_div','loder_div','#','1','clearsession');"
                        action="<?= base_url('cart') ?>" method="post">
                        <button class="continue__shopping--clear" type="submit"><i class="fa-solid fa-trash-can"></i>
                            Delete Cart</button>
                    </form>
                </div>
                <div class="rounded-2 overflow-hidden">
                    <table class="cart-table w-100 mt-4 bg-white">
                        <thead>
                            <th><i class="fa fa-trash"></i></th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            <?php 
                            if (isset($_SESSION['ecom_cart']) && count($_SESSION['ecom_cart'])>=1) {
                                $total_Amount = 0;
                                foreach($_SESSION['ecom_cart'] as $pro){

                                $serv_url=base_url('product/').@$pro['p_id'].'/'.url_smart(@$pro['p_name']);
                                
                                // print_r ($_SESSION['ecom_cart']); die;
                                ?>
                            <tr>
                                <td>
                                    <form method="post" action="<?=base_url('index.php/action/remove_cart')?>">
                                        <input type="hidden" name="productId" value="<?= $pro['p_id'] ?>">
                                        <button class="cart__remove--btn" aria-label="Remove from Cart" type="submit">
                                            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                viewbox="0 0 24 24" width="16px" height="16px">
                                                <path
                                                    d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <img width="150px" src="<?=base_url('assets/avator/upload/')?><?=@$pro['p_img']?>"
                                        alt="product-thumb" class="img-fluid">
                                </td>
                                <td class="text-start product-title">
                                    <h6 class="mb-0"><?=@$pro['p_name']?></h6>
                                    <span class="cart__content--variant">WEIGHT: <?=@$pro['p_weight']?></span>
                                </td>
                                <td>

                                    <span class="text-dark fw-bold"><?=@$pro['p_qty'] ?></span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold me-2 d-lg-none">Unit Price:</span>
                                    <span class="text-dark fw-bold">₹<?= @$pro['p_price'] ?></span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold me-2 d-lg-none">Total Price:</span>
                                    <span class="text-dark fw-bold">₹<?=@$pro['p_price'] * @$pro['p_qty'] ?></span>
                                </td>
                            </tr>
                            <?php
                                } }else{ ?>
                            <tr>
                                <td colspan="4">
                                    <center>Empty Cart!</center>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row g-4">
                    <div class="col-xl-7">
                        <div class="voucher-box py-7 px-5 position-relative z-1 overflow-hidden bg-white rounded mt-4">
                            <img src="<?=base_url('assets/theme/gostore')?>/img/shapes/circle-half.png"
                                alt="circle shape" class="position-absolute end-0 top-0 z--1">
                            <h4 class="mb-3">What would you like to do next?</h4>
                            <p class="mb-7">Choose if you have a discount code or reward points you want to use<br> or
                                would like to estimate your delivery cost.</p>
                            <form class="d-flex align-items-center" action="#">
                                <input type="text" placeholder="Enter Your Voucher Cod" class="theme-input w-100">
                                <button type="submit" class="btn btn-secondary flex-shrink-0">Apply Voucher</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="cart-summery bg-white rounded-2 pt-4 pb-6 px-5 mt-4">
                            <table class="w-100">
                                <tr>
                                    <td class="py-3">
                                        <h5 class="mb-0 fw-medium">Subtotal</h5>
                                    </td>
                                    <td class="py-3">
                                        <?php
                                        $subtotal = 0;
                                        foreach ($_SESSION['ecom_cart'] as $pro) {
                                            $subtotal += $pro['p_price'] * $pro['p_qty'];
                                        }
                                        ?>
                                        <h5 class="mb-0 fw-semibold text-end">₹<?= number_format($subtotal, 2) ?></h5>
                                    </td>
                                </tr>
                                <tr class="border-top">
                                    <td class="py-3">
                                        <h5 class="mb-0">Total</h5>
                                    </td>
                                    <td class="text-end py-3">
                                        <?php
                                        $total = $subtotal;
                                        ?>
                                        <h5 class="mb-0">$<?= number_format($total, 2) ?></h5>
                                    </td>
                                </tr>
                            </table>
                            <p class="mb-5 mt-2">Shipping options will be updated during checkout.</p>
                            <div class="btns-group d-flex gap-3">
                                <a href="<?=base_url('checkout')?>"><button type="button" class="btn btn-primary btn-md rounded-1">Confirm Order</button></a>
                                <a href="<?=base_url('shop')?>"><button type="button"
                                    class="btn btn-outline-secondary border-secondary btn-md rounded-1">Continue
                                    Shopping</button></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--cart section end-->