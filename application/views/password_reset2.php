<main class="main__content_wrapper">

    <!-- Start login section  -->
    <div class="login__section section--padding">
        <div class="container">
        <form class="login_form row" method="post" action="<?=base_url('index.php/action/password_reset2');?>" onsubmit="return ajaxsubmitform('<?=base_url()?>index.php/action/password_reset2',this,'error_div','loder_div','<?=base_url()?>index.php/main/login','0','password_reset2');">
                <div class="login__section--inner">
                    <div class="row justify-content-center row-cols-md-2 row-cols-1">
                        <div class="col">
                            <div class="account__login">
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title mb-10">Reset your password!</h2>
                                    <p class="account__login--header__desc">Verified Link </p>
                                </div>
                                <input type="hidden" name="e" value="<?=$e?>">
                                <div class="account__login--inner">
                                    <label>
                                        <input class="account__login--input" name="pass1" placeholder="New password"
                                            type="password">
                                    </label>

                                    <label>
                                        <input class="account__login--input" name="pass2" placeholder="Repeat Password"
                                            type="password">
                                    </label>

                                    <button class="account__login--btn primary__btn" type="submit">Change Password</button>
                                    <div class="account__login--divide">
                                        <span class="account__login--divide__text">OR</span>
                                    </div>

                                    <p class="account__login--signup__text">Don't Have an Account? <a
                                            href="<?=base_url('signup?prev=1')?>">Register here</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End login section  -->


</main>