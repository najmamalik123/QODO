<form class="contact_us_form row" action="<?=base_url('index.php/action/contact')?>" method="post" id="contactForm" novalidate="novalidate" onsubmit="return ajaxsubmitform('<?=base_url('index.php/action/contact')?>',this,'error_div','loder_div','#','1','contacted');" >
  <div class="col-sm-6">
    <input type="text" class="input form-control" placeholder="Your Name" name="name" >
  </div>
  <div class="col-sm-6">
    <input type="text" class="input form-control" placeholder="Your Email" name="email">
  </div><div class="col-sm-6">
    <input type="text" class="input form-control" placeholder="Phone" name="phone">
  </div><div class="col-sm-6">
    <select name="subject" class="form-control input">
      <option>General Question</option>
      <option>Complain</option>
      <option>Feedback</option>
      <option>Job / Career</option>
      <option>Legal</option>
    </select>
  </div>
  <div class="col-12">
    <textarea id="" class="form-control my-2" placeholder="Your Message" name="mess" style="height: 100px !Important;" ></textarea>
  </div>
  <div class="col-12">
  <?=get_captcha('caprght_oplkion','sign9_form_90_feed');?>
  </div>
  <div class="col-sm-6">
    <input id="terms-conditions" type="checkbox">
    <label for="terms-conditions">
        I agree to the <a href="terms">Terms & Conditions</a>
    </label>
    <small>
      <br/> We will not spam or bother you, we may contact you for any further questions. 
    </small>
  </div><div class="col-sm-6">
    <input type="submit" value="Send Message" class="button button-primary pull-right theme_bg btn btn-primary mt-3" >
  </div>
</form>