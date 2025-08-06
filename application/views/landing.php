<?php get_codes('header', $meta_array); ?>

<!-- Static Background Color -->
<style>
    body {
        background-color: #5A1D32 !important; /* Deep maroon */
        margin: 0;
        padding: 0;
        font-family: 'Inter', sans-serif;
    }

    section {
        min-height: 100vh;

        text-align: center;
        color: white;
        padding: 20px;
    }

    h1 span {
        font-size: 80px;
            font-weight: bold;
    }

    ul li {
        margin-bottom: 20px;
    }
    p {
        font-size: 30px !important;
    font-style: italic;
    }
    
    .heading {
        font-size: 80px;
    }
    
    @media (max-width:900px){
        .heading {
            font-size: 43px;
        }
         h1 span {
        font-size: 43px;
            font-weight: bold;
    }
    p {
       font-size:17px !important; 
    }
    }
</style>
<!-- Top Header Bar -->


<!-- Hero Section -->
<section>
    <div class="row d-flex justify-content-between align-items-center px-4 py-3" style="background-color: #5A1D32;">
  
    <a href="<?= base_url('') ?>" class="col-md-3">
        <img src="<?= base_url('assets/avator/logo_light.png') ?>" alt="RICHO Logo" style="height: 150px;">
    </a>
      <a href="<?= base_url('membership') ?>" class="col-md-3 btn btn-light text-dark fw-bold rounded-pill " style="padding: 20px 45px ; font-size: 22px;">
        Become a Member
    </a>
</div>
    <div class="d-flex justify-content-center flex-column align-items-center px-4 py-3">
        <!--<div class="d-flex mb-2 justify-content-center">-->
        <!--    <a href="<?= base_url('') ?>">-->
        <!--        <img src="<?= base_url('assets/avator/logo_light.png') ?>" alt="RICHO Logo" style="width: 300px;" class="me-2">-->
        <!--    </a>-->
        <!--</div>-->
        <h1 class="fw-bold text-white heading" style="">
            The Club Where<br><span>Real Growth Happens..</span>
        </h1>
        <p class="text-white">
            An Invite-Only Circle for India’s <strong>Top 1% Real Estate <br> Investors</strong> – India’s First Elite Real Estate Club!
        </p>
        <div class="mt-4 mb-2">
            <a href="<?= base_url('membership') ?>" class="btn px-4 my-2 py-2 text-white rounded-pill" style="background-color: #fff; color: #5A1D32 !important; font-weight: 600;">
                Become a Member
            </a>
            <a href="<?= base_url('home') ?>" class="btn px-4 py-2 rounded-pill border border-white text-white">
                What is Richo Club?
            </a>
        </div>
    </div>
</section>

<!-- Section 2 -->
<section>
    <div class="col-md-12 col-sm-12 p-3 d-flex justify-content-center">
       <div  class="col-md-7">
            <h1 class=" text-white" style="font-size:25px;">
            NOT EVERYONE MAKES IT IN.
        </h1>
        <p class="text-white ">
            Real estate investing is no longer just about buying
 property. It’s about access—access to exclusive
 opportunities, access to like-minded investors, access
 to developers who build the future.

        </p>
        <p class="text-white ">
          Yet, most investors struggle. They get lost in the maze of
 brokers, misinformation, and missed chances. RICHO
 CLUB changes that.

        </p>
        <p class="text-white ">
             We built RICHO CLUB for those who refuse to settle for
 the ordinary. For those who believe that wealth isn’t just
 built—it’s curated, nurtured, and amplified through the
 right network. We are not just an app.
 
        </p>
        <p class="text-white">
            We are a private club for visionaries, wealth builders,
 and the future of real estate
        </p>
       </div>
    </div>
</section>

<!-- Section 3 -->
<section>
    <div class="col-md-12 d-flex justify-content-center col-sm-12 p-3">
      <div class="col-md-7">
            <h1 class="fw-bold text-white">
           <span> Our Promise..</span><br>We don’t promise you just properties.
        </h1>
        <ul style="list-style: disc;text-align:left; padding-left: 0; font-size: 1.1rem; line-height: 1.8;">
            <li><strong>Exclusive is an understatement</strong> - This club isn’t for everyone. It’s only for long-game players.</li>
            <li><strong>1% Cashback on every investment</strong> - No thank-you notes—just real value.</li>
            <li><strong>Zero brokerage. For life</strong> - We cut the middleman. You keep the margin.</li>
            <li><strong>Your lawyer, not their agent</strong> - Legal support that’s always on your side.</li>
            <li><strong>Digital when you want it. Offline when you need it</strong> - Fully online, yet always personal.</li>
            <li><strong>No sales teams. Just access</strong> - Top developers. Direct deals.</li>
            <li><strong>Buy. Grow. Resell. Repeat</strong> - Resale support through our network.</li>
            <li><strong>Not networking. Net worth-ing</strong> - Every conversation opens a door.</li>
        </ul>
        <p style="margin-top: 40px; font-size: 1.2rem; font-style: italic; font-weight: 500;">
            “We are not building another real estate app. <br>
            We are building the most exclusive real estate investment club India has ever seen!”
        </p>
        <div class="mt-4 mb-2">
            <a href="<?= base_url('membership') ?>" class="btn px-4 my-2 py-2 text-white rounded-pill" style="background-color: #fff; color:#5A1D32 !important; font-weight: 600;">
                Become a Member
            </a>
        </div>
      </div>
    </div>
</section>

<?php get_codes('footer', '1'); ?>
