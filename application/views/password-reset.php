<!DOCTYPE html>
<html lang="en">
  <head>
    <?=$meta_data?>
  </head>
    <title>
    <?=$site_name?>
    </title>
    <body>
<div class="container-fluid no-padding">
  <?php include_once('inc/header.php'); ?>
    <div class='container-fluid me_max-width'>
       <div class="row">
           <div class="col-md-5">
           <img src="avator/Password-shopping-icon.png" class='img-responsive' style='max-width:100%;'/>
           </div>
           <div class="col-md-7">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Password Reset</h4>
	<p class="text-center">Enter Your Phone Number</p>
	<form action="<?=$flink?>/act/action_sim.php" method="post" onsubmit="return ajaxsubmitform('<?=$flink?>/act/action_sim.php',this,'error_div','loder_div','#','1','pass-forgot-mobile');" class='forms_forgot_ap' id="pas_for_pas_1" style="display:block;">
        <input type="hidden" name="step" value="FORGOT-PASSWORD"/>
        <input type="hidden" name="acc" value="MOBILE"/>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
		<select class="custom-select" style="max-width: 70px;">
		    <option selected="">+91</option>
		</select>
    	<input name="mobile" class="form-control" placeholder="Phone number*" type="text" required>
    </div> <!-- form-group// -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Next  </button>
    </div> <!-- form-group// -->
</form>

    <form action="<?=$flink?>/act/action_sim.php" method="post" onsubmit="return ajaxsubmitform('<?=$flink?>/act/action_sim.php',this,'error_div','loder_div','#','1','OTP-PASS_RESET');" class='forms_forgot_ap' id="pas_for_pas_2">
        <input type="hidden" name="step" value="OTP-PASS-FORGOT"/>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
    	<input name="otp" class="form-control" placeholder="OTP*" type="text" required>
    </div> <!-- form-group// -->
    <div class="form-group">
        <button type="submit" class="btn btn-success btn-block"> Verify  </button>
    </div> <!-- form-group// -->
</form>

    <form action="<?=$flink?>/act/action_sim.php" method="post" onsubmit="return ajaxsubmitform('<?=$flink?>/act/action_sim.php',this,'error_div','loder_div','#','1','password');" class='forms_forgot_ap' id="pas_for_pas_3_1">
        <input type="hidden" name="step" value="PASSWORD-RESET-2"/>
        <input type="hidden" name="acc" value="MOBILE"/>
    <div class="form-group input-group" id="append_select">
    	<?php
    @$ph=$_SESSION['ph'];
    $getaccs=mysqli_query($conn,"select mid,name,business from yn_site_mem where contact='$ph' and verify ='1' ") ?>
    <select name="pcid" class='form-control' style="height:35px;padding-left:10px;">
        <option value="0">Select Your Account</option>
        <?php while($theselec=mysqli_fetch_array($getaccs)){ ?>
        <option value="<?=$theselec['mid']?>"> <?=$theselec['name']?> - <?=$theselec['business']?> </option>
        <?php } ?>
        </select>
    </div> <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
    	<input name="pass1" class="form-control" placeholder="New Password*" type="password" required>
    </div> <!-- form-group// --><div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
    	<input name="pass2" class="form-control" placeholder="Repeat Password*" type="password" required>
    </div> <!-- form-group// -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Change Password  </button>
    </div> <!-- form-group// -->
</form>
</article></div>
</div>
    </div>
    <?php include_once('inc/footer.php'); ?>
</div>

</body>
</html>
<?php clearsession(); ?>