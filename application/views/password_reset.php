<!--main content wrapper start-->
<div class="main-wrapper">

    <!--login section start-->
    <section class="login-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-12 tt-login-img"
                    data-background="<?=base_url('assets/theme/gostore')?>/img/banner/login-banner.jpg"></div>
                <div class="col-lg-5 col-12 bg-white d-flex p-0 tt-login-col shadow">
                    <form class="tt-login-form-wrap p-3 p-md-6 p-lg-6 py-7 w-100" method="post"
                        action="<?=base_url('index.php/action/password_reset');?>"
                        onsubmit="return ajaxsubmitform('<?=base_url()?>index.php/action/password_reset',this,'error_div','loder_div','#','1','password_reset');">
                        <div class="mb-7">
                            <a href="<?=base_url()?>">
                                <img src="<?=base_url('assets/avator/')?>/logo.png" alt="logo">
                            </a>
                        </div>
                        <h2 class="mb-4 h3">Reset Password </h2>
                        <p>write your email here to change your password</p>
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <div class="input-field">
                                    <label class="fw-bold text-dark fs-sm mb-1">Email</label>
                                    <input type="email" name="email" placeholder="Enter your email" class="theme-input">
                                </div>
                            </div>
                            <div class="col-sm-12">
                            <?=get_captcha('caprght_oplkion','sign9_form_90_feed');?>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary w-100">Send Link</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4">
                            <p class="mb-0 fs-xs">Don't have an Account? <a href="<?= base_url('signup') ?>">Sign
                                Up</a>
                        </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--login section end-->

</div>
<!--main content wrapper end-->