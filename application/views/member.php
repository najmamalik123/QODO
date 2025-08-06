<?php get_codes('header', $meta_array); ?>
<style>
    body {
      font-family: 'Epilogue', sans-serif;
      background-color: #5d1f35  !important;
      color: #fff;
      min-height: 100vh;
    }

   
      .form-section {
      padding: 60px 40px;
    }

    .form-section h1 {
    font-size: 60px;
    font-weight: 500;
    margin-bottom: 20px;
    font-family: canela;
    }

    .form-section p {
    font-size: 20px;
    font-weight: 400;
    line-height: 1.6;
    margin-bottom: 30px;
    font-family: inter;
    font-style: italic;
    }

    .form-control {
      border-radius: 50px;
      border: 2px solid #fff;
      background: transparent;
      color: #fff;
      font-weight: 500;
    }

    .form-control::placeholder {
      color: #fff;
    }

    .btn-custom {
      background: #fff;
      color: #5d1f35;
      border-radius: 50px;
      font-weight: 600;
      padding: 12px 30px;
      font-size: 16px;
    }

    .login a {
      color: #fff;
      font-weight: 500;
      text-decoration: underline;
    }

    .info-section {
      background-color: #f8f0ec;
      color: #5d1f35;
      padding: 60px 40px;
      border-radius:10px;
    }

    .info-section h2 {
      font-size: 60px;
      font-weight: 700;
      text-align: center;
    }

    .info-section .subtext {
      text-align: center;
      color: #5d1f35;
          margin-bottom: 25px;
    font-size: 15px;
    }

    .info-section h3 {
      font-size: 35px;
      font-weight: 700;
      margin-bottom: 15px;
      font-family: canela;
    }

    .info-section p.italic {
      font-style: italic;
      font-size: 30px;
      margin-bottom: 20px;
      font-family: inter;
    }

    .info-section ul {
      list-style-type: none;
      padding-left: 0;
    }

    .info-section ul li::before {
      content: "• ";
      color: #5d1f35;
      font-weight: bold;
      margin-right: 8px;
    }

    .info-section ul li {
      margin-bottom: 15px;
      font-size: 16px;
    }

    @media (max-width: 992px) {
      .info-section {
        border-radius: 0;
        margin-top: 40px;
      }
    }
  </style>

  <div class="container py-5" style="height:100vh;">
    <div class="row align-items-stretch justify-content-between h-100">
      <!-- Left Side -->
      <div class="col-lg-6 text-center d-flex justify-content-center align-items-center flex-column form-section text-white">
        <h1>Join Richo Club</h1>
        <p>
          An Invite-Only Circle for India’s <strong>Top 1% Real Estate Investors</strong> – India’s First Elite Real Estate Club!
        </p>
        <form style="width:80%;" action="<?= base_url('index.php/action/contact') ?>" method="post" id="contactForm" novalidate="novalidate" onsubmit="return uploadandform('<?= base_url('index.php/action/contact') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');">
          <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name" required>
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
          </div>
          <div class="mb-3">
            <input type="tel" class="form-control" name="phone" placeholder="Mobile Number" required>
          </div>
          <div class="col-sm-12">
											<?php echo get_captcha('caprght_oplkion', 'sign9_form_90_feed'); ?>
										</div>
          <button type="submit" class="btn btn-custom">Become a Member</button>
        </form>
        <div class="login mt-4">
          Already have an account? <a href="#">Log In</a>
        </div>
      </div>

      <!-- Right Side -->
      <div class="col-lg-5 h-100 info-section">
          <div class="d-flex justify-content-center">
        <img src="<?= base_url('assets/avator/logo.png') ?>" style="width:60%;">
        </div>
        <h3>Why Richo Club?</h3>
        <p class="italic">We don’t promise you just properties.</p>
        <ul>
          <li>India’s First Elite <strong>Real Estate Club!</strong></li>
          <li>Exclusive Community of <strong>Top 1% Investors</strong></li>
          <li><strong>ZERO Brokerage</strong> – Buy Directly From Developer!</li>
          <li><strong>1% Loyalty Benefits</strong> on Every Investment</li>
          <li>Online + Offline <strong>Legal Support</strong></li>
        </ul>
      </div>
    </div>
  </div>
<?php get_codes('footer', '1'); ?>