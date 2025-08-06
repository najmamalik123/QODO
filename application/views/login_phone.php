<!--=====================================-->
<!--=          Login Area Start         =-->
<!--=====================================-->
<section class="account-page-area section-gap-equal">
   <div class="container position-relative">
      <div class="row g-5 justify-content-center">
         <div class="col-lg-5">
            <div class="login-form-box">
               <h3 class="title">Sign in</h3>
               <p>Don’t have an account? <a href="<?= base_url('signup') ?>">Sign up</a></p>
               <form action="<?= base_url('index.php/action/login_phone') ?>" method="post" class='row contact-form'>
                  <div class="form-group">
                     <label for="current-log-email">Mobile*</label>
                     <input type="number" name="phone" id="current-log-email" placeholder="Registered Mobile Number">
                  </div>
                  <!-- <div class="form-group">
                             <label for="current-log-password">Password*</label>
                             <input type="password" name="current-log-password" id="current-log-password" placeholder="Password">
                             <span class="password-show"><i class="icon-76"></i></span>
                          </div>
                          <div class="form-group chekbox-area">
                             <div class="edu-form-check">
                                <input type="checkbox" id="remember-me">
                                <label for="remember-me">Remember Me</label>
                             </div>
                             <a href="#" class="password-reset">Lost your password?</a>
                          </div> -->
                  <div class="form-group">
                     <button type="submit" class="edu-btn btn-medium">Sign in <i class="icon-4"></i></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <ul class="shape-group">
         <li class="shape-1 scene"><img data-depth="2" src="<?= base_url('assets/theme/nodlys/images/about/') ?>shape-07.png" alt="Shape"></li>
         <li class="shape-2 scene"><img data-depth="-2" src="<?= base_url('assets/theme/nodlys/images/about/') ?>shape-13.png" alt="Shape"></li>
         <li class="shape-3 scene"><img data-depth="2" src="<?= base_url('assets/theme/nodlys/images/counterup/') ?>shape-02.png" alt="Shape"></li>
      </ul>
   </div>
</section>