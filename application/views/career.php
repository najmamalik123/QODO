<section class="page-header single-header bg_img oh" data-background="<?=base_url('assets/theme/images/')?>page-header.png">
        <div class="bottom-shape d-none d-md-block">
            <img src="<?=base_url('assets/theme/')?>css/img/page-header.png" alt="css">
        </div>
    </section>

<!--============= Contact Section Starts Here =============-->
    <section class="contact-section padding-top padding-bottom">
        <div class="container">
            <div class="section-header mw-100 cl-white">
                <h2 class="title">Career @ <?=$site_name?></h2>
                <p>Whether you're looking for a demo, have a support question or a commercial query get in touch.</p>
            </div>
            <div class="row justify-content-center justify-content-lg-between">
                <div class="col-lg-7">
                    <div class="contact-wrapper">
                        <h4 class="title text-center mb-30">Get in Touch</h4>
                        <form action="<?=base_url('action/career')?>" method="post"  onsubmit="return uploadandform('<?=base_url('action/career')?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='form_id_doc2' enctype="multipart/form-data" class="contact-form">
                            
                            <div class="form-group">
                                <label for="name">Your Full Name*</label>
                                <input type="text" placeholder="Enter Your Full Name*" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number*</label>
                                <input type="text" placeholder="Enter Your Phone Number*" name="phone" id="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Write Email*</label>
                                <input type="text" placeholder="Write Email*" name="email" id="email" required>
                            </div>          
                            <div class="form-group">
                                <label for="name">Upload Resume</label>
                                <input type="file" name="FileUpload1">
                            </div>                 
                            <div class="form-group mb-0">
                                <label for="message">Comment*</label>
                                <textarea id="message" placeholder="Comment*" name="mess" required></textarea>
                                <div class="form-check">
                                    <br><?=get_captcha('caprght_oplkion','sign9_form_90_feed');?>
                                </div>
                            </div>                                                        
                            <div class="form-group">
                                <input type="submit" value="Send Message">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-content">
                        <div class="man d-lg-block d-none">
                            <img src="<?=base_url('assets/theme/')?>images/contact/man.png" alt="bg">
                        </div>
                        <div class="section-header left-style">
                            <h3 class="title">Have questions?</h3>                            
                        </div>
                        <div class="contact-area">
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="<?=base_url('assets/theme/')?>images/contact/contact1.png" alt="contact">
                                </div>
                                <div class="contact-contact">
                                    <h5 class="subtitle">Email Us</h5>
                                    <a href="Mailto:<?=$site_email?>"><?=$site_email?></a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="<?=base_url('assets/theme/')?>images/contact/contact2.png" alt="contact">
                                </div>
                                <div class="contact-contact">
                                    <h5 class="subtitle">Call Us</h5>
                                    <a href="Tel:565656855"><?=$site_phone?></a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="<?=base_url('assets/theme/')?>images/contact/contact3.png" alt="contact">
                                </div>
                                <div class="contact-contact">
                                    <h5 class="subtitle">Visit Us</h5>
                                    <p><?=$site_address?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Career Section Ends Here =============-->

    