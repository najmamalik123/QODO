<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/login/') ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/login/') ?>css/main.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!--===============================================================================================-->
</head>
<!-- https://cssgradient.io/ -->

<body style="background: rgb(45,41,120);
background: linear-gradient(341deg, rgba(45,41,120,0.9948354341736695) 0%, rgba(21,21,242,1) 35%, rgba(181,255,0,1) 100%);">

	<div class="limiter">
		<div class="container-login100" style="background:none;">
			<div class="wrap-login100" style="max-height:480px;box-shadow: 2.419px 9.703px 12.48px 0.52px rgb(0 0 0 / 30%);border-radius: 10px;">
				<form class="col-12 row p-3 p-sm-4 m-0" action="<?= base_url('') ?>index.php/admin_action/login" method='POST'>
					<span class="login100-form-title">
						<center><img src="<?= base_url('assets/avator/logo.png') ?>" style='height: 50px;margin-bottom: 30px;'></center>
					</span>

					<span class="txt1">
						<b class="" style="color: red;font-size: 14px;"> <?= @$_GET['msg']; ?></b>
					</span>

					<div class="wrap-input100 col-12 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" name="u" placeholder="User name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 col-12 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="p" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="mb-3">
						<?php echo get_captcha('caprght_oplkion', 'sign9_form_90_feed'); ?>
					</div>

					<div class="container-login100-form-btn  mt-3">
						<button class="login100-form-btn btn_2 ">
							Sign in
						</button>
					</div>


					<small style="font-size:12px;color: #3dd;" class="mt-3">
						All rights reserved with "Nodlys;", We are creating an open source platform for reliable and easy to maintain / develop WebAPPs. | By YNAPS | V1.
					</small>

				</form>
			</div>
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
	<script src="<?= base_url('assets/admin/login/') ?>js/main.js"></script>

</body>

</html>