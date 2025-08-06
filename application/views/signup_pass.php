<main>

<!-- sign up area start -->
<section class="signup__area po-rel-z1 pt-100 pb-145">
   <div class="sign__shape">
      <img class="man-1" src="<?=base_url('assets/theme')?>/img/icon/sign/man-3.png" alt="">
      <img class="man-2 man-22" src="<?=base_url('assets/theme')?>/img/icon/sign/man-2.png" alt="">
      <img class="circle" src="<?=base_url('assets/theme')?>/img/icon/sign/circle.png" alt="">
      <img class="zigzag" src="<?=base_url('assets/theme')?>/img/icon/sign/zigzag.png" alt="">
      <img class="dot" src="<?=base_url('assets/theme')?>/img/icon/sign/dot.png" alt="">
      <img class="bg" src="<?=base_url('assets/theme')?>/img/icon/sign/sign-up.png" alt="">
      <img class="flower" src="<?=base_url('assets/theme')?>/img/icon/sign/flower.png" alt="">
   </div>
   <div class="container">
      <div class="row">
         <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
            <div class="section__title-wrapper text-center mb-55">
               <h2 class="section__title">Create a free <br>  Account</h2>
               <!-- <p>I'm a subhead that goes with a story.</p> -->
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
            <div class="sign__wrapper white-bg">
               <div class="sign__header mb-35">
                  <div class="sign__in text-center">
                     <img src="<?=base_url('assets/avator/')?>logo.png" alt="logo" style='height: 40px;'  >
                     <br>
                     <p><a href="<?= base_url('login') ?>">sign in</a> with your email<span> ........</span> </p>
                  </div>
               </div>
               <div class="sign__form">
               <form action="<?= base_url('index.php/action/profile') ?>" method="post" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/signup') ?>',this,'error_div','loder_div','<?= base_url('index.php/main/otp-verify') ?>','0');" class="row contact-form">
                     <div class="sign__input-wrapper mb-25">
                        <h5>Full Name</h5>
                        <div class="sign__input">
                           <input type="text" name="name" placeholder="Full name">
                           <i class="fal fa-user"></i>
                        </div>
                     </div>
                     <div class="sign__input-wrapper mb-25">
                        <h5>Work email</h5>
                        <div class="sign__input">
                           <input type="text" value="<?= @$cook_email ?>" name="email" placeholder="e-mail address">
                           <i class="fal fa-envelope"></i>
                        </div>
                     </div>
                     <div class="sign__input-wrapper mb-25">
                        <h5>Phone</h5>
                        <div class="sign__input">
                           <input type="number" name="phone" placeholder="Phone">
                           <i class="fal fa-phone"></i>
                        </div>
                     </div>
                     <div class="sign__input-wrapper mb-10">
                        <h5>Password</h5>
                        <div class="sign__input">
                           <input type="password" name="pass" placeholder="Password">
                           <i class="fal fa-lock"></i>
                        </div>
                     </div>
                     <div class="sign__action d-flex justify-content-between mb-30">
                        <div class="sign__agree d-flex align-items-center">
                           <input class="m-check-input" type="checkbox" id="m-agree">
                           <label class="m-check-label" for="m-agree">I agree to the <a href="<?=base_url('terms')?>">Terms & Conditions</a>
                              </label>
                        </div>
                     </div>
                     <div class="sign__input-wrapper mb-10">
                     <?php echo get_captcha('caprght_oplkion', 'sign9_form_90_feed'); ?>
                     </div>
                     <button type="submit" class="e-btn w-100"> <span></span> Sign Up</button>
                     <div class="sign__new text-center mt-20">
                        <p>Already in <?=$site_name?> ? <a href="<?=base_url('login')?>"> Sign In</a></p>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- sign up area end -->

</main>
