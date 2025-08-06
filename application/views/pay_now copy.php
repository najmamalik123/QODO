<main>
<section class="about__area pt-120 pb-150">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xxl-6 col-xl-6 col-lg-6">
            <div class="about__content p-2 bg-light shadow_1" style="max-width:400px;" >
               <div class="section__title-wrapper"> 
                    <img src="<?=base_url('assets/avator/webimg/HandsProcrastinating.png')?>" class='img-fluid'>
               </div>
               <p>
                    <?php 
                    //print_r($_SESSION);
                    $courseName=$_SESSION['courseName'];
                    $order_id=$_SESSION['order_id'];
                    $amount_pay=$_SESSION['amount'];
                    ?>

                    <h3 class="text-dark">Pay Now</h3>
                    <b>#<?=$order_id?></b>
                    <hr/>

                    <span class=" ec-bill-wrap ec-bill-half">
                        <label class="text-dark">Name: </label> <?=@$_SESSION['name']?>
                    </span>
                    <br>
                    <span class=" ec-bill-wrap ec-bill-half">
                        <label class="text-dark">Phone: </label> <?=@$_SESSION['phone']?>
                    </span>
                    <br>
                    <span class=" ec-bill-wrap">
                        <label class="text-dark">Email: </label> <?=@$_SESSION['email']?>
                    </span>
                    <br>
                    <span class=" ec-bill-wrap">
                        <label class="text-dark">Amount: </label> Rs.<?=@$amount_pay?>
                    </span>
                    <br>

                    <span class=" ec-bill-wrap ">
                        <hr/>
                        <img src="<?=base_url('assets/theme/img')?>/course/payment/payment-1.png" alt="" class='my-2' >
                        <button type="button" onclick="razorpaySubmit(this);" class="btn btn-success mt-3 text-white font-weight-bold py-2 col-12">Pay Now</button>
                    </span>
               </p>
            </div>
         </div>
      </div>
   </div>
</section>
</main>
<?php
$productinfo = 'AyuScholar';
$txnid = time();
$surl = base_url('thank-you?or=').$order_id;
$furl = base_url('thank-you?or=').$order_id;  
$key_id = RAZOR_KEY_ID;
$currency_code = 'INR';            
$total = $amount_pay*100; 
$amount = $amount_pay;
$merchant_order_id = $order_id;
$card_holder_name = '';
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$name = $_SESSION['name'];
$return_url = base_url().'razorpay/callback';
?>

 <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>

  <input type="hidden" name="email" id="email" value="<?php echo $email; ?>"/>
  <input type="hidden" name="phone" id="phone" value="<?php echo $phone; ?>"/>
  <input type="hidden" name="ecom_order_name" id="ecom_order_name" value="<?=$name?>"/>
  <input type="hidden" name="courseName" id="courseName" value="<?php echo $courseName; ?>"/>
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
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>