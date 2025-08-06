<section class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h2>Subcribe to our Newsletter</h2>
              <p>We will not spam you, but will send you updates about new mock test <br/>and important dates for your exam preperations.</p>
              <div class="row d-flex justify-content-center mt-4 mb-4">
                <div class="col-md-12">
                  <form action="<?=base_url('index.php/action/subscribe')?>" method="post" onsubmit="return ajaxsubmitform('<?=base_url('index.php/action/subscribe')?>',this,'error_div','loder_div','#','1','subscribed');" class='subscribe-form'>
                    <div class="form-group d-flex">
                      <input type="text" name="email" class="form-control" placeholder="Enter email address">
                      <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

