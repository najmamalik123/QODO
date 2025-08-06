<form action="<?=base_url('index.php/action/signup')?>" method="post" onsubmit="return ajaxsubmitform('<?=base_url('index.php/action/signup')?>',this,'error_div','loder_div','<?=base_url('index.php/main/otp-verify')?>','0');" class='thebg_suighsips '>

                                <div class="row">
                                            <div class="col-12">
                                                <input type="text" class="form-control floating" name="name" placeholder="Name">
                                            </div>
                                            <div class="col-12">
                                                <input type="text" class="form-control floating" name="email" placeholder="Email" >
                                            </div>

                                            <div class="col-12">
                                                <input type="text" class="form-control floating" name="phone" placeholder="Mobile" >
                                            </div>
                                            <div class="col-12">
                                                <input type="password" class="form-control floating" name="pass" placeholder="Password">
                                            </div>
                                            <div class="col-12">
                                                <p>Select type of user!</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="user_type">
                                                    <option value="st">Startup</option>
                                                    <option value="in">Investor</option>
                                                    <option value="so">Soonicorn</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="refer" placeholder="Referal code">
                                            </div>
                                    <div class="col-12">
                                        <?=get_captcha('caprght_oplkion','sign9_form_90_feed');?>
                                        <button type="submit" class="btn btn--primary type--uppercase">Create Account</button>
                                    </div>

                                    <div class="col-12">
                                        <span class="type--fine-print">By signing up, you agree to the
                                            <a href="<?=base_url('terms')?>">Terms of Service</a> <br/>
                                            <hr/>
                                            Already Have a account, <a href="<?=base_url('login')?>">Login Here</a>

                                        </span>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>