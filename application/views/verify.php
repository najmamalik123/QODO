<div class="container" style="margin-bottom: 100px;">
 <div class="row justify-content-center">
  <div class="col-md-7" >
   <div class="panel panel-primary" style="padding:30px;border:1px solid gray;border-radius: 5px;background: #fff;">
    <div class="panel-heading" style="background: #eee;border-radius:5px;font-weight:bold;padding: 10px;">Verify your account by mobile and ID card :</div>
        <div class="panel-body col-md-6" style="padding-top: 20px;">
          <div class="thehider" style="display: block;">
      <form action="<?=base_url('index.php/action/account_verify')?>" method="post" enctype="multipart/form-data" onsubmit="return uploadandform('<?=base_url('index.php/action/account_verify')?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='fomr_id_proile22w' >
          <label>Phone* : </label><input type='text' class='form-control'  value='<?=$profile_data['contact'];?>' name="phone" >
          <label>Email : </label><input type='text' class='form-control'  value='<?=$profile_data['email'];?>' name="email" readonly>
          <div style="padding:10px;background: #eee;margin-top: 10px;"><small><b>Please upload any Government approved ID card, like Aadhar, PAN, pasport. Supported format is PNG, JPG</b></small>
          <small>Your data is 100% secure with us, we destroy sensetive data after account verification.</small>
          <input type="file" name="image_name" id="image_name"></div>
          <button type="submit" class="btn btn-primary btn-block theme_bg" style="margin-top: 30px;"> Send OTP  </button>
    </form>
      </div>
      <div class="thehider" id="step_2">
        <form action="<?=base_url('index.php/action/acc_verify')?>" method="post" onsubmit="return ajaxsubmitform('<?=base_url('index.php/action/acc_verify')?>',this,'error_div','loder_div','#','1','acc_verified');">
          <label>Phone* : </label><input type='text' class='form-control'  value='' name="otp" placeholder="OTP">
          <button type="submit" class="btn btn-primary btn-block theme_bg" style="margin-top: 30px;"> Send OTP  </button>
    </form>
      </div>
        </div>
   </div>
  </div>
  <div class="col-md-4">
    <div>
            <div class="card hovercard">
                <div class="cardheader text-white text-right" style="background:url(<?=base_url('assets')?>/mem/<?=$profile_data['mid']?>/img/<?=$profile_data['cover']?>);background-size: cover;" id="prifile_pic_09o">
                    <span class="fa fa-camera text-white pull-rigth edt_peencilr" onclick="$('#cover_image_90_5').click();"></span>

                <form action="<?=base_url('index.php/action/photo')?>" method="post" enctype="multipart/form-data" onsubmit="return uploadandform('<?=base_url('index.php/action/photo')?>','post',this,'cover_image_90_5','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='fomr_id_proile2'>
                  <input type="file" name="file_name"  id='cover_image_90_5' style="display: none;" onchange="chnageBGDynamic(this,'prifile_pic_09o','0','1');"/>
                  <input type="hidden" name="cvr_prf" value="cover"/>
                </form>
                </div>

                <div class="avatar">
                    <img alt="" src="<?=base_url('assets')?>/mem/<?=$profile_data['mid']?>/img/<?=$profile_data['photo']?>" onclick="$('#cover_image_90_2').click();" style="cursor: pointer;">
                    <form action="<?=base_url('index.php/action/photo')?>" method="post" enctype="multipart/form-data" onsubmit="return uploadandform('<?=base_url('index.php/action/photo')?>','post',this,'cover_image_90_2','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='fomr_id_proile2'>
                  <input type="file" name="file_name"  id='cover_image_90_2' style="display: none;" onchange="chnageBGDynamic(this,'prifile_pic_09o2','0','1');"/>
                  <input type="hidden" name="cvr_prf" value="photo"/>
                </form>
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" href="#"><?=$profile_data['name'];?></a>
                    </div>
                    <div class="desc"><?=$profile_data['email']?></div>
                    <div class="desc"><?=$profile_data['contact']?> | Age: <?=$profile_data['age']?>, <?=$profile_data['gender']?></div>
                    <div class="desc"><?=$profile_data['address']?>, <br/><?=$profile_data['city']?> <?=$profile_data['zip'];?></div>
                </div>
                <div class="bottom">
                    <a class="btn btn-primary btn-twitter btn-sm" href="<?=$profile_data['tw']?>" target='_blank'>
                        <i class="fa fa-twitter text-white"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" rel="publisher"
                       href="<?=$profile_data['ins']?>" target='_blank'>
                        <i class="fa fa-instagram text-white"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" rel="publisher"
                       href="<?=$profile_data['fb']?>" target='_blank'>
                        <i class="fa fa-facebook text-white"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" rel="publisher" href="<?=$profile_data['bl']?>" target='_blank'>
                        <i class="fa fa-behance text-white"></i>
                    </a>
                </div>
            </div>

        </div>
  </div>

 </div>
</div>