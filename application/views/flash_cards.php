<style type="text/css">
  .container{width: 99% !important;}
  .container{max-width: 1900px !important;}
</style>

<section id="contact" class="contact-area pt-145 pb-245" style="background-image:url(<?=base_url('assets/theme/img/')?>shape/12.png)">
      <?php 
      if(count($flashes)>'0'){$b=1;
        $bcount=count($flashes);
      ?>
        <!-- Slideshow container -->
        <div class="slideshow-containers">
          <?php foreach($flashes as $flash){?>
          <!-- Full-width images with number and caption text -->
          <div class="mySlides">
            <div class="numbertext"><?=$b?> / <?=$bcount?></div>
            <img src="<?=base_url('assets/avator/upload/content/')?><?=$flash['content_file']?>" alt="<?=$flash['name']?>" clas='img-fluid' style="width:100%">
            <div class="text"><?=@$flash['name']?></div>
          </div>
          <?php $b++;}?>
          <!-- Next and previous buttons -->
          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
       <?php }?>
</section>
<script type="text/javascript" src="<?=base_url('assets/js/slider_carousel.js')?>"></script>