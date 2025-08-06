<!-- Ec checkout page -->
<div class="py-4">
  <div class="container">
    <div class="row position-relative">
      <!-- Main Content -->
      <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
        <div class="main-content">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
              <div class="bg-white p-4 rounded-4 shadow-sm faq-page">
                <div class="mb-3 text-center">
                  <h5 class="lead fw-bold text-body mb-0">Pay Now</h5>
                  <p class="text-muted mb-0">Complete your payment to proceed</p>
                </div>

                <hr class="my-4">

                <div class="text-start">
                  <?php $amount_pay = $theorder['so_price']; ?>
                  <?php $order_id = $theorder['so_order_id']; ?>

                  <p class="fw-bold mb-2">Order ID: <span class="fw-normal text-muted"><?= $order_id ?></span></p>

                  <p class="fw-bold mb-2">Name: <span class="fw-normal text-muted"><?= @$theorder['so_name'] ?></span></p>

                  <p class="fw-bold mb-2">Phone: <span class="fw-normal text-muted"><?= @$theorder['so_phone'] ?></span></p>

                  <p class="fw-bold mb-2">Email: <span class="fw-normal text-muted"><?= @$theorder['so_email'] ?></span></p>

                  <p class="fw-bold mb-2">Amount: <span class="fw-normal text-success">₹<?= @$amount_pay ?></span></p>
                </div>

                <hr class="my-4">

                <div class="d-grid">
                  <button onclick="razorpaySubmit(this);" class="btn btn-primary rounded-5 fw-bold text-uppercase py-3 w-100" type="submit">
                    <i class="fa fa-credit-card me-2"></i> Pay Now
                  </button>
                </div>
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
<?php
$productinfo = 'YRH Morning';
$txnid = time();
$surl = base_url('thank_you?or=') . $order_id;
$furl = base_url('thank_you?or=') . $order_id;
$key_id = RAZOR_KEY_ID;
$currency_code = 'INR';
$total = $amount_pay * 100;
$amount = $amount_pay;
$merchant_order_id = $order_id;
$card_holder_name = '';
$email = $theorder['so_email'];
$phone = $theorder['so_phone'];
$name = $theorder['so_name'];
$return_url = base_url() . 'razorpay/callback';
?>

<form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>" />
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>" />
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>" />
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>" />
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>" />
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>" />
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>" />
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>" />

  <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
  <input type="hidden" name="ecom_order_name" id="ecom_order_name" value="<?php echo $theorder['so_name']; ?>" />
  <input type="hidden" name="chk_code" id="chk_code" value="<?php echo $_SESSION['chk_code']; ?>" />
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total; ?>",
    name: "<?php echo $name; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "INR",
    prefill: {
      name: "<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function(transaction) {
      document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
      document.getElementById('razorpay-form').submit();
    },
    "modal": {
      "ondismiss": function() {
        location.reload()
      }
    }
  };
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el) {
    if (typeof Razorpay == 'undefined') {
      setTimeout(razorpaySubmit, 200);
      if (!razorpay_submit_btn && el) {
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';
      }
    } else {
      if (!razorpay_instance) {
        razorpay_instance = new Razorpay(razorpay_options);
        if (razorpay_submit_btn) {
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }
</script>