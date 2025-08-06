<!DOCTYPE html>
<html lang="en">
<head>
	<title>Nodly's License</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/admin/login/')?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/admin/login/')?>css/main.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	
<!--===============================================================================================-->
</head>
<!-- https://cssgradient.io/ -->
<body style="background: rgb(20,100,110);
background: radial-gradient(circle, rgba(20,100,110,1) 0%, rgba(252,70,107,1) 89%);">
	
	<div class="limiter">
		<div class="container-login100" style="background:none;">
			<form class="p-3 validate-form" action="<?=base_url()?>index.php/admin_action/license" method='POST' style='padding-top:100px;max-width:450px;background: #fff;border-radius: 10px;min-height: 530px;'>
								
								<div class="row col-12 mx-0 px-0">
								
								<span class="login100-form-title">
									<center><img src="<?=base_url('assets/avator/logo.png')?>" style='height: 30px;margin-bottom: 30px;'></center>
								</span>
								<?php $thedomain=$_SERVER['HTTP_HOST']; ?>
								Domain Name
								<div class="wrap-input100 col-12 mb-2" data-validate="Type user name">
									<input id="first-name" class="input100" type="text" name="u" placeholder="Domain name" value="<?=$thedomain?>" >
									<span class="focus-input100"></span>
								</div>

								License Key (Auto generated)
								<div class="wrap-input100 mt-sm-2" data-validate="Type Key">
									<input class="input100" type="text" name="p" placeholder="License Key" value="<?=md5(rand(11111,999999999))?>" >
									<span class="focus-input100"></span>
								</div>

								<div class="wrap-input100 mt-sm-2" data-validate="Type Name">
									<input class="input100" type="text" name="name" placeholder="Your Name">
									<span class="focus-input100"></span>
								</div>

								<div class="wrap-input100 mt-sm-2" data-validate="Type Email">
									<input class="input100" type="text" name="email" placeholder="Your Email">
									<span class="focus-input100"></span>
								</div>


								<div class="mt-sm-2 text-center" data-validate="Type password">
									<?php echo get_captcha('caprght_oplkion','sign9_form_90_feed');?>
								</div>

								
								<div class="container-login100-form-btn  mt-3">
									<button class="login100-form-btn btn_2 ">
										Get License
									</button>
								</div>
								</div>

								
							</form>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	
<!--===============================================================================================-->
	<script src="<?=base_url('assets/admin/login/')?>js/main.js"></script>

</body>
</html>