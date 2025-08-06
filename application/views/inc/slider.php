<?php
    $gettex=$this->db->query("select * from yn_site_img where img_place='slider' order by img_sort asc limit 3");
    $thedats=$gettex->result_array(); ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url(<?=base_url('assets/avator/upload/slider')?>/<?=$thedats['0']['img_name']?>)">
            <div class="carousel-caption d-none d-md-block">
              <h1>We are here to help you travel for free!</h1>
              <p><?=$thedats['0']['img_text']?>.</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url(<?=base_url('assets/avator/upload/slider')?>/<?=$thedats['1']['img_name']?>)">
            <div class="carousel-caption d-none d-md-block">
              <h1>Travelling to places in india ?</h1>
              <p><?=$thedats['1']['img_text']?>.</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url(<?=base_url('assets/avator/upload/slider')?>/<?=$thedats['2']['img_name']?>)">
            <div class="carousel-caption d-none d-md-block">
              <h1>Send an envelope!</h1>
              <p><?=$thedats['2']['img_text']?>.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev no_show" href="#carouselExampleIndicators" role="button" data-slide="prev" >
          <span class="carousel-control-prev-icon no_show" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next no_show" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>