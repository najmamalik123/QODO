<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Action extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_gfavIde/general/urls.html
	 */
	public function signup()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('phone', 'phone', 'required');
		// $this->form_validation->set_rules('pass','pass','required');
		// $this->form_validation->set_rules('code','code','required');		

		@$captcha = $this->input->post('g-recaptcha-response');
		$this->load->view('inc/recaptchalib');
		if (!$captcha) {
			echo 'Please check the the captcha form.';
			die;
		}
		$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfgnxAUAAAAAD9TwtAKzP0dmqZenOeWb0OMCmrN&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
		// if($response['success'] == false){ echo 'Sorry, Captcha failed !!'; die; }

		//print_r($_POST);die;
		if ($this->form_validation->run()) {

			// $refer='0';

			$username = addslashes($this->input->post('username'));
			$name = $this->input->post('name');
			$country_code = $this->input->post('country_code');
			$email = $this->input->post('email');
			$phone = preg_replace('/[^0-9]/', '', $this->input->post('phone'));
			// $current_status = $this->input->post('current_status');
			// $pass = $this->input->post('pass');
			// $code=$this->input->post('code');
			//$user_type=$this->input->post('user_type');
			// $refer=$this->input->post('refer');


			// check_mobile($phone);
			emailCHECK($email);

			check_mobile($phone);
			// $phone=$code.$phone;
			// check password
			//check_passwords($pass,'PD001');

			$randon = rand('11111', '99999');
			$signup_data = array(
				'username' => $username,
				'name' => $name,
				'email' => $email,
				'country_code' => $country_code,
				'contact' => $phone,
				// 'pass' => sha1($pass),
				//'user_dob' =>$dob,
				'cover' => 'cover.jpg',
				'photo' => 'photo.jpg',
				// 'current_status' => $current_status,
				// 'college' => $college,
				// 'address' => $address,
				// 'father_name' => $father_name,
				'user_status' => '1',
				'user_type' => 'u',
				// 'user_reffer_by' =>$refer,
				// 'user_reffer' =>$randon,
			);

			// print_r($signup_data);
			// die;

			$receive = $this->ynaps_model->signup($signup_data, $email, $phone);
			if ($receive == 'YNAPS_SUCCESS') {

				// create dir
				$yid = $_SESSION['yid'];
				$dirPath = "assets/mem/$yid";
				$dirPath2 = "assets/mem/$yid/img/";
				mkdir($dirPath, 0777, TRUE);
				mkdir($dirPath2, 0777, TRUE);

				$file = base_url() . 'assets/avator/main-profile.jpg';
				$file2 = base_url() . 'assets/avator/cover.jpg';
				$tocoppy = "$dirPath2/photo.jpg";
				$tocoppy2 = "$dirPath2/cover.jpg";
				$abch = copy($file, $tocoppy);
				$abch2 = copy($file2, $tocoppy2);

				//send email
				$site_details = db_variables();
				$site_brief = $site_details['site_brief'];
				$site_name = $site_details['site_name'];
				$site_email = $site_details['site_email'];
				$site_address = $site_details['site_address'];

				$hash = sha1($email);
				$code = rand(1111, 9999);

				$_SESSION['signup_code_email'] = $code;

				$emaillist_act = array("$email", "$site_email");
				$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
				$tos = "$email";
				$subject09 = "Welcome to $site_name | your OTP is $code";
				$preheader = "Welcome to $site_name family.";
				$greet = "Hi, $name";
				$message = "Thank you for joining $site_name. <br/> Please enter the OTP as $code to verify your email.";
				$link = base_url('otp-verify');
				$linkname = 'Browse Website';
				$message2 = "$site_brief";
				$greet2 = 'Thank you so much';
				$myName_emailis = "Membership";
				$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
				send_email($tos, $subject09, $messageto90, $site_name, $json_string);
				//send sms

				$theOpt_ph = $code; //rand(1111,9999);
				$_SESSION['signup_code_phone'] = $theOpt_ph;
				$sms_mess = "Thank you for joining $site_name. Please enter the OTP as $code to verify your Mobile.";
				// send_sms($phone, $sms_mess, 'user', $theOpt_ph, '1');

				// create session
				@session_start();
				$_SESSION['yid'] = $yid;
				$_SESSION['name'] = $name;
				$_SESSION['email'] = $email;
				$_SESSION['phone'] = $phone;
				//$_SESSION['user_type']=$user_type;
				$_SESSION['verify'] = '0';
				$_SESSION['photo'] = 'photo.jpg';
				$_SESSION['plan'] = '0';
				$_SESSION['otp_verify'] = '0';

				echo 'YNAPS_SUCCESS';
				die;
			} else {
				echo $receive;
				die;
			}


			//true
		} else {
			// false
			echo 'Please enter all the required details.';
			die;
		}
	}


	function opt_verify()
	{
		$ecode_re_em = $_SESSION['signup_code_email'];
		// $ecode_re_mo=$_SESSION['signup_code_phone'];
		$yid = $_SESSION['yid'];

		// $motp=$this->input->post('motp');

		$eotp = $this->input->post('eotp');
		$dal = '0';

		if ($eotp == $ecode_re_em) {
			$update_mem = $this->db->query("update yn_site_mem set user_email_status='1' where mid='$yid' ");
		} else {
			$dal = '1';
			echo "Email OTP does not matces, please check your email OTP.";
		}

		// if($motp == $ecode_re_mo){
		// 	$update_mem=$this->db->query("update yn_site_mem set user_phone_status='1' where mid='$yid' ");
		// }else{
		// 	$dal='1';
		// 	echo "Mobile OTP does not matches, please check your Mobile OTP.";
		// }
		if ($dal == '0') {
			$_SESSION['otp_verify'] = '1';
			echo 'YNAPS_SUCCESS';
		}
	}
	// phone login
	// function login(){
	// 	$this->load->library('form_validation');
	// 	$this->form_validation->set_rules('phone','phone','required');
	// 	$this->form_validation->set_rules('pass','pass','required');
	// 	if($this->form_validation->run()){

	// 		$phone=$this->input->post('phone');
	// 		$pass=$this->input->post('pass');
	// 		if($this->ynaps_model->login($phone,$pass)){

	// 			$cookie = array(
	//                 'name'   => 'user-phone',
	//                 'value'  => $phone,
	//                 'expire' =>  865000,
	//                 'secure' => false
	//             );
	//             $this->input->set_cookie($cookie);

	// 			echo 'YNAPS_SUCCESS';
	// 		}else{
	// 			echo 'Please check your login details, phone and password combination does not match'; die;
	// 		}
	// 		//true
	// 	}else{
	// 		// false
	// 		echo 'Please enter your phone and passowrd.'; die;
	// 	}
	// }



	// email login

	function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('pass', 'pass', 'required');
		if ($this->form_validation->run()) {

			$email = $this->input->post('email');
			$pass = $this->input->post('pass');
			if ($this->ynaps_model->login($email, $pass)) {

				$cookie = array(
					'name'   => 'user-email',
					'value'  => $email,
					'expire' =>  865000,
					'secure' => false
				);
				$this->input->set_cookie($cookie);

				echo 'YNAPS_SUCCESS';
			} else {
				echo 'Please check your login details, email and password combination does not match';
				die;
			}
			//true
		} else {
			// false
			echo 'Please enter your email and passowrd.';
			die;
		}
	}

	public function check_username()
	{
		$username = $this->input->post('username');
		$this->db->where('username', $username);
		$exists =  $this->db->count_all_results('yn_site_mem') > 0;
		echo json_encode([
			"status" => $exists ? "taken" : "available"
		]);
	}

	public function check_email()
	{
		$email = $this->input->post('email');
		$this->db->where('email', $email);
		$exists =  $this->db->count_all_results('yn_site_mem') > 0;
		echo json_encode([
			"status" => $exists ? "taken" : "available"
		]);
	}



	function login_phone()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('phone', 'phone', 'required');
		// if ($_POST['country_code'] != '' && $_POST['phone'] != '') {

		// 	$country_code = $this->input->post('country_code');
		// 	$phone = $this->input->post('phone');
		// } elseif ($_GET['country_code'] != '' && $_GET['phone'] != '') {
		// 	$phone 	= $this->input->get('phone');
		// 	$country_code 	= $this->input->get('country_code');
		// } else {
		// 	// false
		// 	echo 'Please enter your mobile number.';
		// 	die;
		// }
		if ($this->form_validation->run()) {

			$country_code = $this->input->post('country_code');
			$phone = $this->input->post('phone');
			$query = $this->db->query("SELECT * FROM yn_site_mem WHERE country_code = '$country_code' AND contact='$phone'");
			if ($query->num_rows() == '1') {
				$data = $query->row_array();
				$_SESSION['yid'] = $data['mid'];
				$_SESSION['name'] = $data['name'];
				$_SESSION['phone'] = $data['contact'];
				$_SESSION['country_code'] = $data['country_code'];
				$_SESSION['email'] = $data['email'];
				$_SESSION['username'] = $data['username'];
				$_SESSION['user_status'] = $data['user_status'];

				//send sms
				$theOpt_ph = rand(1111, 9999);
				$_SESSION['phone'] = $phone;
				$_SESSION['login_otp_phone'] = $theOpt_ph;
				$_SESSION['otp_verify'] = '0';
				$sms_mess = "Please enter the OTP as $theOpt_ph to login.";
				// send_sms($phone, $sms_mess, 'user', $theOpt_ph, '1');
				myfav_users($data['mid'], 'reset');

				redirect(base_url('login_otp_verify'));
			} else {
				$_SESSION['country_code'] = $country_code;
				$_SESSION['phone'] = $phone;
				redirect(base_url('signup'));
			}
			//true
		} else {
			// false
			echo 'Please enter your mobile number.';
			die;
		}
	}

	function login_otp_verify()
	{
		$phone = $_SESSION['phone'];
		$ecode_re_mo = @$_SESSION['login_otp_phone'];

		$motp = $this->input->post('motp');
		$dal = '0';

		if ($motp != $ecode_re_mo) {
			$dal = '1';
			echo "Mobile OTP does not match, please check your Mobile OTP.";
		}
		if ($dal == '0') { //echo $phone;//die;

			if ($this->ynaps_model->login_phone($phone, '')) {

				$cookie = array(
					'name'   => 'user-phone',
					'value'  => $phone,
					'expire' =>  865000,
					'secure' => false
				);
				$this->input->set_cookie($cookie);

				$_SESSION['otp_verify'] = '1';
				echo 'YNAPS_SUCCESS';
			} else {
				echo 'Please check your OTP sent to your Mobile Number provided';
				die;
			}
		}
	}

	function password_reset()
	{
		$site_details = db_variables();
		$site_brief = $site_details['site_brief'];
		$site_name = $site_details['site_name'];
		$site_email = $site_details['site_email'];
		$site_address = $site_details['site_address'];

		// google captcha not needed here
		@$captcha = $this->input->post('g-recaptcha-response');
		$this->load->view('inc/recaptchalib');
		// if(!$captcha){ echo 'Please check the the captcha form.'; die; }
		$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfgnxAUAAAAAD9TwtAKzP0dmqZenOeWb0OMCmrN&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
		//if($response['success'] == false){ echo 'Sorry, Captcha failed !!'; die; }

		$email = $this->input->post('email');
		$hash = sha1($email);
		$code = rand(1111, 9999);

		if (@$email == '') {
			echo "Please enter your email";
			die;
		}

		// check user and set pin
		$getdats = $this->db->query("SELECT email from yn_site_mem where email='$email' ");
		if ($getdats->num_rows() > 0) {
			$updatethepin = $this->db->query("UPDATE yn_site_mem set pass_reset='$code' where email='$email' ");
		} else {
			echo "No user exists with this email";
			die;
		}



		$emaillist_act = array("$email", "$site_email");
		$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
		$tos = "$email";
		$subject09 = "Password Reset";
		$preheader = "Hello you requested to reset your passwrod...";
		$greet = "Hi,";
		$message = "Hello you requested to reset your passwrod, please click the link below to reset your password.";
		$link = base_url('index.php/main/reset_password') . "?mail=" . $email . '&ha=' . sha1($email) . '90&c=' . $code;
		$linkname = 'Password reset';
		$message2 = "$site_brief";
		$greet2 = 'Thank you so much';
		$myName_emailis = "Password Reset";
		$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
		send_email($tos, $subject09, $messageto90, $site_name, $json_string);
		echo "YNAPS_SUCCESS";
	}
	function password_reset2()
	{
		$e = $this->input->post('e');
		$pass = $this->input->post('pass1');
		$pass2 = $this->input->post('pass2');

		if ($pass == $pass2) {
			$pass = sha1($pass);
			$updatepass = $this->db->query("update yn_site_mem set pass='$pass',pass_reset='',pass_nc='' where email='$e' ");
			echo "YNAPS_SUCCESS";
		} else {
			echo 'The two passwords do not match';
			die;
		}
	}
	function password_change()
	{
		$pass = $this->input->post('pass');
		$pass1 = $this->input->post('pass1');
		$pass2 = $this->input->post('pass2');
		$yid = $_SESSION['yid'];

		$hegtepass = $this->db->query("select pass from yn_site_mem where mid='$yid'");
		$passa_Sdat = $hegtepass->row_Array();

		if ($passa_Sdat['pass'] != sha1($pass)) {
			echo 'The Old password do not match please try again.';
			die;
		}
		if ($pass1 == '') {
			echo 'Please enter new password';
			die;
		}
		if ($pass1 == $pass2) {
			$pass = sha1($pass1);
			$updatepass = $this->db->query("update yn_site_mem set pass='$pass' where mid='$yid' ");
			echo "YNAPS_SUCCESS";
		} else {
			echo 'The two passwords do not match';
			die;
		}
	}

	function edit()
	{

		check_session('3', '1');

		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$cover2 = $this->input->post('cover2');
		$address = $this->input->post('address');
		$about = addslashes($this->input->post('about'));
		$yid = $_SESSION['yid'];

		if ($email == '') {
			echo "Email is required";
			die;
		}

		$checkEmail = $this->db->query("SELECT email FROM yn_site_mem WHERE email = '$email' AND mid != '$yid'");
		if ($checkEmail->num_rows() > 0) {
			echo "This email is already registered with another account. Please use a different email.";
			die;
		}


		if ($name != '') {

			// $update_data = $this->db->query("update yn_site_mem set name='$name',contact='$phone',email='$email',address='$add',user_state='$state',user_city='$city',user_zip='$zip',gender='$gender',about='$about',fb='$fb',tw='$tw',insta='$ins',user_dob='$dob',user_state_name='$state_name',user_city_name='$city_name',user_country='$country' where mid='$yid' ");

			$update_data = $this->db->query("UPDATE yn_site_mem set name='$name',email='$email',contact='$phone',about='$about' , address='$address', cover2='$cover2' where mid='$yid' ");
			if ($update_data) {
				echo 'YNAPS_SUCCESS';
				die;
			} else {
				echo 'Sorry! Invalid Data not updated';
			}
		} else {
			echo 'Please enter your Name to continue.';
		}
	}

	function sm()
	{
		check_session('3', '1');
		$user_profile = $this->input->post('user_profile');

		$fb = $this->input->post('fb');
		$tw = $this->input->post('tw');
		$ins = $this->input->post('ins');
		$yt = $this->input->post('yt');
		$bl = $this->input->post('bl');
		$ln = $this->input->post('ln');

		$yid = $_SESSION['yid'];
		$update_data = $this->db->query("update yn_site_mem set fb='$fb',tw='$tw',insta='$ins',edln='$ln',blog='$bl' where mid='$yid' ");
		echo 'YNAPS_SUCCESS';
		die;
	}

	public function photo()
	{
		session_start(); // If not using CI sessions

		$userId = $_SESSION['yid'];

		if (isset($_FILES['file_name']) && $_FILES['file_name']['error'] == 0) {
			$file = $_FILES['file_name'];

			$uploadDir = 'assets/mem/' . $userId . '/img/';
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}

			// Clean file name and move
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$newFileName = 'profile_' . time() . '.' . $ext;
			$uploadPath = $uploadDir . $newFileName;

			// Move file
			if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
				// Update DB
				$this->db->where('mid', $userId);
				$this->db->update('yn_site_mem', ['photo' => $newFileName]);

				echo json_encode([
					'status' => 'success',
					'filename' => $newFileName
				]);
			} else {
				http_response_code(500);
				echo json_encode([
					'status' => 'error',
					'message' => 'Could not move uploaded file.'
				]);
			}
		} else {
			http_response_code(400);
			echo json_encode([
				'status' => 'error',
				'message' => 'No valid file uploaded.'
			]);
		}
	}


	function generate_otp($email, $phone)
	{
		@session_start();
		if (isset($_SESSION['otp']) && $_SESSION['otp'] != '') {
			$otp = $_SESSION['otp'];
			$_SESSION['otp_email'] = $email;
			$_SESSION['otp_phone'] = $phone;
		} else {
			$otp = rand(1111, 9999);
		}
		$_SESSION['otp'] = $otp;

		//email and sms

		$site_details = db_variables();
		$site_brief = $site_details['site_brief'];
		$site_name = $site_details['site_name'];
		$site_email = $site_details['site_email'];
		$site_address = $site_details['site_address'];

		$hash = sha1($email);
		$code = rand(1111, 9999);
		$emaillist_act = array("$email", "$site_email");
		$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
		$tos = "$site_email";
		$subject09 = "OTP for your contact";
		$preheader = "Hello you requested for an OTO...";
		$greet = "Hi,";
		$message = "Your OTP as requested on $site_name is <b>$otp</b> .";
		$link = base_url('index.php') . "?mail=" . $email . '&ha=' . sha1($email) . '90';
		$linkname = 'Browse website';
		$message2 = "$site_brief";
		$greet2 = 'Thank you so much';
		$myName_emailis = "Password Reset";
		$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
		send_email($tos, $subject09, $messageto90, $site_name, $json_string);

		$sms_mess = "Your OTP as requested on $site_name is $otp. Please do not share.";
		// send_sms($phone, $sms_mess);
	}

	function send_otp($email, $phone)
	{
		$this->generate_otp($email, $phone);
		return 'YNAPS_SUCCESS';
		die;
	}

	function otp_verify($otp)
	{
		@session_start();
		$otp = $this->input->post('otp');
		$function = $this->input->post('function');
		if ($otp == $_SESSION['otp']) {
			$_SESSION['otp_time_limit'] = '';
			$_SESSION['otp'] = '';
			//add your function here
			// $this->share_details_listing();
			return 'YNAPS_SUCCESS';
		} else {
			$email = $_SESSION['otp_email'];
			$phone = $_SESSION['otp_phone'];
			if (isset($_SESSION['otp_time_limit']) && $_SESSION['otp_time_limit'] != '') {
				$CURRENTTIME = date('Y-m-d H:i:s');
				$OFFICETIME  = @$_SESSION['otp_time_limit'];
				if ($CURRENTTIME  > $OFFICETIME) {
					$this->generate_otp($email, $phone);
					echo 'Sorry, wrong OTP but we have sent you an OTP again.';
					die;
				} else {
					echo 'Wrong OTP, please wait for 30 seconds for another OTP. Enter any otp after 30 seconds to resend it.';
					die;
				}
			} else {
				$this->generate_otp($email, $phone);
				$_SESSION['otp_time_limit'] = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " +30 seconds"));
				echo 'Sorry, wrong OTP but we have sent you an OTP again.';
				die;
			}
		}
	}


	function order_now()
	{
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$name = $this->input->post('name');
		$message = $this->input->post('mess');
		$address = $this->input->post('address');
		$order_id = $_SESSION['order_id'];


		$date = date('Y-m-d H:i:s');


		if (isset($_SESSION['yid']) && $_SESSION['yid'] != '') {
			$yid = $_SESSION['yid'];
		} else {
			// check if the user exists
			$yid = 0;
		}

		if ($email != '') {
			$addorder = $this->db->query("insert into site_order (so_order_id,so_mid,so_status,so_name,so_message,so_email,so_phone,so_date,so_add) values ('$order_id','$yid','0','$name','$message','$email','$phone',now(),'$address') ");
			echo 'YNAPS_SUCCESS';
		} else {
			echo 'Please refresh the page to continue.';
		}
	}


	function remove_cart()
	{
		session_start();

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
			$productId = $_POST['productId'];

			// Locate and remove the item with the given productId from the cart session
			if (isset($_SESSION['ecom_cart'])) {
				foreach ($_SESSION['ecom_cart'] as $key => $item) {
					if (isset($item['p_id']) && $item['p_id'] == $productId) {
						// Remove the item from the session cart
						unset($_SESSION['ecom_cart'][$key]);
						break; // Stop searching once found
					}
				}
			}

			// Redirect back to the cart page or any other page as needed
			header("Location: ../cart.php"); // Replace with your cart page URL
			exit();
		} else {
			// Handle invalid requests
			http_response_code(400); // Bad Request
			echo 'Invalid request';
		}
	}



	function contact()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$subject = $this->input->post('subject');
		$property = $this->input->post('property');
		$budget = $this->input->post('budget');
		$preferences = $this->input->post('preferences');
		$message = addslashes($this->input->post('mess'));
		$type = $this->input->post('type');
		$NAMES = $this->input->post('NAMES');
		$cid = @$this->input->post('cid');
		$cname = @$this->input->post('cname');
		$property_id = @$this->input->post('property_id');
		if (isset($_GET['property'])) {
			$mess = '<b>Property Name:</b>' . $property . '<br>' . '<b>Budget:</b>' . $budget . '<br>' . '<b>Preferences:</b>' . $preferences . '<br>' . $message;
		} else {
			$mess = $message;
		}

		// Start of the document upload integration
		$uploaded_documents = [];
		// print_r($FILES);
		// die;

		if (!empty($_FILES['documents']['name'][0])) {
			foreach ($_FILES['documents']['name'] as $key => $filename) {
				if (!empty($filename)) {
					$doc = rand(111111, 999999) . '_doc_' . $key;

					// Map to the expected format for upload_doc
					$_FILES['FileUpload1']['name']     = $_FILES['documents']['name'][$key];
					$_FILES['FileUpload1']['type']     = $_FILES['documents']['type'][$key];
					$_FILES['FileUpload1']['tmp_name'] = $_FILES['documents']['tmp_name'][$key];
					$_FILES['FileUpload1']['error']    = $_FILES['documents']['error'][$key];
					$_FILES['FileUpload1']['size']     = $_FILES['documents']['size'][$key];

					$file_get_res = upload_doc('FileUpload1', "assets/avator/upload/", $doc);

					if (substr($file_get_res, 0, 6) == 'SUCCXX') {
						$NewFileName = substr($file_get_res, 6);
						$uploaded_documents[] = $NewFileName;
					}
				}
			}
		}

		$all_documents_string = implode(",", $uploaded_documents); // You can change to implode("-", ...) if you prefer
		// echo $all_documents_string;
		// die;

		// check_mobile($phone);
		// emailCHECK($email);

		if ($NAMES != '') {
			echo 'Success, Please call us at 9034664487';
			die;
		}

		// google captcha not needed here
		@$captcha = $this->input->post('g-recaptcha-response');
		$this->load->view('inc/recaptchalib');
		if (!$captcha) {
			echo 'Please check the the captcha form.';
			die;
		}
		$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfgnxAUAAAAAD9TwtAKzP0dmqZenOeWb0OMCmrN&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
		// if($response['success'] == false){ echo 'Sorry, Captcha failed !!'; die; }

		$ip = $this->input->ip_address();
		$date = date('Y-m-d H:i:s');
		$alldetails = '';

		if ($email != '') {
			$this->db->query("insert into yn_site_contact (name,email,phone,subject,msg,date,ip,skype,con_type,con_cid, con_cname,property,user_doc) values ('$name','$email','$phone','$subject','$mess','$date','$ip','','$type','$cid','$cname','$property_id','$all_documents_string')");

			$site_details = db_variables();
			$site_brief = $site_details['site_brief'];
			$site_name = $site_details['site_name'];
			$site_email = $site_details['site_email'];
			$site_address = $site_details['site_address'];

			$hash = sha1($email);
			$code = rand(1111, 9999);
			$emaillist_act = array("$site_email", "$site_email");
			$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
			$tos = "$email";
			$subject092 = "Hi you received a message from $name for $type.";
			$subject09 = "Hi $name, We have received your message.";
			$preheader = "Hi $name, We have received your message.";
			$greet = "Hi, $name";
			$message = "Thank you for contacting $site_name, We have received your message with following details and will get back to you within next 24 to 48 hrs<br/><br/>Name: $name<br/>Email: $email<br/>Phone: $phone<br/>Message: $mess<br/> <br/>Date: $date<br/>IP: $ip";
			$link = base_url();
			$linkname = 'Browse Website';
			$message2 = "$site_brief";
			$greet2 = 'Thank you so much';
			$myName_emailis = "Contact Request";
			$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
			send_email($tos, $subject09, $messageto90, $site_name, $json_string);
			send_email($site_email, $subject092, $messageto90, $site_name, $json_string);

			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo 'Please fill your name and phone.';
			die;
		}
	}

	public function propstatus()
	{
		$status = $this->input->get('status');
		$msid = $this->input->get('msid');

		// Use query bindings to prevent SQL injection
		$query = $this->db->query("UPDATE yn_site_contact SET vendor_status = ? WHERE msid = ?", [$status, $msid]);

		if ($this->db->affected_rows() > 0) {
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			echo 'Failed to update the status';
		}
	}


	function help()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$p_vehicle = $this->input->post('p_vehicle');
		$p_year = $this->input->post('p_year');
		$p_fuel = $this->input->post('p_fuel');
		$p_model = $this->input->post('p_model');
		$p_mess = addslashes($this->input->post('p_mess'));
		$date = date('Y-m-d H:i:s');

		if ($email != '') {

			$site_details = db_variables();
			$site_brief = $site_details['site_brief'];
			$site_name = $site_details['site_name'];
			// $site_email = $site_details['site_email'];
			$site_email = "ahmedbutt7430@gmail.com";
			$site_address = $site_details['site_address'];

			$hash = sha1($email);
			$emaillist_act = array("$site_email", "$site_email");
			$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
			$tos = "$email";
			$subject092 = "Hi you received a message.";
			$subject09 = "Hi, We have received your message.";
			$preheader = "Hi, We have received your message.";
			$greet = "Hi,";
			$message = "Thank you for contacting $site_name, We have received your message with following details and will get back to you within next 24 to 48 hrs<br/><br/>Vehicle: $p_vehicle<br/>Year: $p_year<br/>Model: $p_model<br/>Message: $p_mess<br/> <br/>Date: $date";
			$link = base_url();
			$linkname = 'Browse Website';
			$message2 = "$site_brief";
			$greet2 = 'Thank you so much';
			$myName_emailis = "Contact Request";
			$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
			send_email($tos, $subject09, $messageto90, $site_name, $json_string);
			send_email($site_email, $subject092, $messageto90, $site_name, $json_string);

			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo 'Please fill your name and phone.';
			die;
		}
	}

	function quote()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$pid = $this->input->post('pid');
		$pname = $this->input->post('pname');
		// $subject=$this->input->post('subject');
		$mess = addslashes($this->input->post('mess'));


		$date = date('Y-m-d H:i:s');
		// echo 'YNAPS_SUCCESS'; die;
		if ($email != '') {
			$this->db->query("insert into `x-quote` (name,email,phone,message,pid,pname,date) values ('$name','$email','$phone','$mess','$pid','$pname','$date')");

			$site_details = db_variables();
			$site_brief = $site_details['site_brief'];
			$site_name = $site_details['site_name'];
			$site_email = $site_details['site_email'];
			$site_address = $site_details['site_address'];

			$hash = sha1($email);
			$code = rand(1111, 9999);
			$emaillist_act = array("$site_email", "$site_email");
			$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
			$tos = "$email";
			$subject092 = "Hi you received a message from $name for Quote.";
			$subject09 = "Hi $name, We have received your message.";
			$preheader = "Hi $name, We have received your message.";
			$greet = "Hi, $name";
			$message = "Thank you for contacting $site_name, We have received your message with following details and will get back to you within next 24 to 48 hrs<br/><br/>Name: $name<br/>Email: $email<br/>Phone: $phone<br/>Message: $mess<br/> <br/>Date: $date<br/>Product id: $pid<br/>Product name: $pname";
			$link = base_url();
			$linkname = 'Browse Website';
			$message2 = "$site_brief";
			$greet2 = 'Thank you so much';
			$myName_emailis = "Contact Request";
			$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
			send_email($tos, $subject09, $messageto90, $site_name, $json_string);
			send_email($site_email, $subject092, $messageto90, $site_name, $json_string);

			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo 'Please fill your name and phone.';
			die;
		}
	}


	function intrest()
	{
		$pid = $this->input->post('pid');
		$pname = $this->input->post('pname');
		$uid = $this->input->post('uid');
		$name = $this->input->post('name');
		$pname = $this->input->post('pname');
		$number = $this->input->post('number');
		$uemail = $this->input->post('uemail');


		$date = date('Y-m-d H:i:s');
		if ($uemail != '') {
			$this->db->query("INSERT INTO `x-intrested-clients`(`user_id`, `user_name`, `user_email`, `user_phone`, `pro_id`, `pro_name`, `date`) VALUES ('$uid','$name','$uemail','$number','$pid','$pname','$date')");

			$site_details = db_variables();
			$site_brief = $site_details['site_brief'];
			$site_name = $site_details['site_name'];
			$site_email = $site_details['site_email'];
			$site_address = $site_details['site_address'];

			$hash = sha1($uemail);
			$code = rand(1111, 9999);
			$emaillist_act = array("$site_email", "$site_email");
			$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
			$tos = "$uemail";
			$subject092 = "Hi you received a message from $name for Quote.";
			$subject09 = "Hi $name, We have received your message.";
			$preheader = "Hi $name, We have received your message.";
			$greet = "Hi, $name";
			$message = "Thank you for Showing your intrest in $site_name, We have received your message with following details and will get back to you within next 24 to 48 hrs<br/><br/>Name: $name<br/>Email: $uemail<br/>Phone: $number <br/>Date: $date<br/>Product id: $pid<br/>Product name: $pname";
			$link = base_url();
			$linkname = 'Browse Website';
			$message2 = "$site_brief";
			$greet2 = 'Thank you so much';
			$myName_emailis = "Contact Request";
			$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
			send_email($tos, $subject09, $messageto90, $site_name, $json_string);
			send_email($site_email, $subject092, $messageto90, $site_name, $json_string);

			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo 'Please fill your Email and phone.';
			die;
		}
	}

	function call_back()
	{
		$mobile = $this->input->post("mobile");
		$email = $this->input->post("email");
		$name = $this->input->post("name");
		$mess = $this->input->post("mess");

		// @$captcha=$this->input->post('g-recaptcha-response');
		// $this->load->view('inc/recaptchalib');
		// if(!$captcha){ echo 'Please check the the captcha form.'; die; }
		// $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfgnxAUAAAAAD9TwtAKzP0dmqZenOeWb0OMCmrN&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		// if($response['success'] == false){ echo 'Sorry, Captcha failed !!'; die; }

		if ($mobile != '' && strlen($mobile) > 9) {
			$dbinsert = $this->db->query("insert into site_callback (cl_name,cl_email,cl_mobile,cl_date,cl_ip) values ('$name','$email','$mobile',now(),'')");

			$site_details = db_variables();
			$site_brief = $site_details['site_brief'];
			$site_name = $site_details['site_name'];
			$site_email = $site_details['site_email'];
			$site_address = $site_details['site_address'];

			$hash = sha1($email);
			$emaillist_act = array("$email", "$site_email");
			$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
			$tos = "$site_email";
			$subject09 = "Callback from $mobile";
			$preheader = "We have received your callback request";
			$greet = "Hi, $name";
			$message = "We have received your request to call you back on the phone number $mobile, we will be calling you soon.";
			$link = base_url();
			$linkname = 'Shop Now';
			$message2 = "$site_brief";
			$greet2 = 'Thank you so much';
			$myName_emailis = "Membership";
			$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
			send_email($tos, $subject09, $messageto90, $site_name, $json_string);


			$message2 = "Hi, We will call you back soon, $site_name";
			// send_sms($mobile, $message2);

			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo 'Please fill your mobile number';
			die;
		}
	}

	function account_verify()
	{
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$yid = $_SESSION['yid'];
		$cvr_prf = $_FILES['image_name']['name'];
		$file_get_res = uploadonlyimage('image_name', "assets/mem/$yid/img/", '90');
		if (substr($file_get_res, 0, 6) == 'SUCCXX') {
			$NewImageName = substr($file_get_res, 6);
			$setDATA_base = $this->db->query("update yn_site_mem set ID='$NewImageName' where mid='$yid'");

			$this->send_otp($email, $phone);
			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo 'ID card image issue.';
			die;
		}
	}

	function acc_verify()
	{
		@session_start();
		$otp = $this->input->post('otp');
		$otp_check = $this->otp_verify($otp);
		if ($otp_check == 'YNAPS_SUCCESS') {
			$yid = $_SESSION['yid'];
			$verify_acc = $this->db->query("update yn_site_mem set verify='2' where mid='$yid' ");

			echo 'YNAPS_SUCCESS';
			die;
		} else {
			return false;
		}
	}

	function subscribe()
	{

		$email = $this->input->post("email");
		if ($email != '') {
			emailCHECK($email, 'Error code SU02-');

			$site_details = db_variables();
			$site_brief = $site_details['site_brief'];
			$site_name = $site_details['site_name'];
			$site_email = $site_details['site_email'];
			$site_address = $site_details['site_address'];

			$checkemals = $this->db->query("select sbc_email from yn_site_subscribe where sbc_email='$email' ");
			if ($checkemals->num_rows() != '0') {
				echo "Your Email Id is already is in our Subscription List. If you are not getting our newsletter, add $site_email to your address book to get the newsletter in your inbox.";
				die;
			}

			$dbinsert = $this->db->query("insert into yn_site_subscribe (sbc_email,sbc_date,sbc_ip) values ('$email',now(),'0')");
			$emaillist_act = array("$email", "$site_email");
			$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
			$tos = "$site_email";
			$subject09 = "Welcome to $site_name";
			$preheader = "Welcome to $site_name family.";
			$greet = "";
			$subject09 = "Thank you for Subscribing EngiTech Newsletter";
			$preheader = "Thank you for Subscribing EngiTech....";
			$greet = "";
			$message = "You have subscribed to receive the EngiTech Newsletter.<br/>
            Our Newsletter will have the latest blogs, vacancies, queries, listings etc. at your desk.
            ";
			$link = base_url();
			$linkname = 'Browse';
			$message2 = "$site_brief";
			$greet2 = 'Thank you so much';
			$myName_emailis = "Subscribe";
			$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
			send_email($tos, $subject09, $messageto90, $site_name, $json_string);

			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo 'Please fill your email';
			die;
		}
	}

	function update_data()
	{
		$q = $this->input->post("q");
		$ans = $this->input->post("ans");
		$code = $this->input->cookie('user-covid', TRUE);
		if (!isset($code)) {
			echo "Please refresh the page, we got some errors.";
			die;
		}

		$addadates = $this->db->query("select * from co_details where cd_code ='$code' ");
		if ($addadates->num_rows() > 0) {
			// update

			$add_data = $this->db->query("update co_details set cd_q$q='$ans',cd_date=now() where cd_code='$code' ");

			if ($q == '7') {
				$result = gethelp_result($code);
				$cookie = array(
					'name'   => 'user-covid-result',
					'value'  => $result,
					'expire' =>  865000,
					'secure' => false
				);
				$this->input->set_cookie($cookie);

				$add_data = $this->db->query("update users set status='$result' where code='$code' ");
			}
		} else {
			// add
			$add_data = $this->db->query("insert into co_details (cd_q$q,cd_code,cd_date) values ('$ans','$code',now()) ");
		}

		echo 'YNAPS_SUCCESS';
		die;
	}

	function uploade_loc()
	{
		$lat = $this->input->post("lat");
		$lon = $this->input->post("lon");
		$code = $this->input->cookie('user-covid', TRUE);
		$nomwtime = date('Y/m/d h:i:s');

		$thecheck_90a = $this->db->query("select * from co_loc where cl_code='$code' and cl_lat='$lat' and cl_long='$lon' and DATE(cl_date)=CURDATE() ");
		if ($thecheck_90a->num_rows() == '0') {
			$addtehislocas = $this->db->query("insert into co_loc (cl_code,cl_lat,cl_long,cl_date) values ('$code','$lat','$lon','$nomwtime') ");
		}
	}

	function newsletter()
	{
		$email = $this->input->post('email');

		if ($email != '') {
			emailCHECK($email, 'Error code SU02-');

			$site_details = db_variables();
			$site_brief = $site_details['site_brief'];
			$site_name = $site_details['site_name'];
			$site_email = $site_details['site_email'];
			$site_address = $site_details['site_address'];

			$checkemals = $this->db->query("select sbc_email from yn_site_subscribe where sbc_email='$email' ");
			if ($checkemals->num_rows() != '0') {
				echo "Your Email Id is already is in our Subscription List. If you are not getting our newsletter, add $site_email to your address book to get the newsletter in your inbox.";
				die;
			}
			$ip = $this->input->ip_address();
			$dbinsert = $this->db->query("insert into yn_site_subscribe (sbc_email,sbc_date,sbc_ip) values ('$email',now(),'$ip')");



			$hash = sha1($email);
			$code = rand(1111, 9999);
			$emaillist_act = array("$email", "$site_email");
			$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
			$tos = "$site_email";
			$subject09 = "you have been subscribed to our newsletter";
			$preheader = "you have been subscribed to our newsletter";
			$greet = "Hi,";
			$message = "You have subscribed to receive the $site_name Newsletter.<br/>
            Our Newsletter will have the latest news at your desk.";
			$link = base_url();
			$linkname = 'Shop Now';
			$message2 = "$site_brief";
			$greet2 = 'Thank you so much';
			$myName_emailis = "Membership";
			$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
			send_email($tos, $subject09, $messageto90, $site_name, $json_string);

			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo 'Please fill your email';
			die;
		}
	}
	////////////////////////////////// THIS IS CUSTOM/ /////////////////////////////////////

	function set_phone()
	{
		$phone = $this->input->post('phone');
		$loc_details = $this->input->post('loc');

		$code = substr($loc_details, 2, 4);
		$ISO_loc = substr($loc_details, 0, 2);
		// $preg=$this->input->post('preg');

		$new_phone = $code . $phone;
		if ($code == '') {
			redirect(base_url('index.php/recharge') . "?msg=" . urlencode('country not supported'));
		} else {

			$get_datas = ding_API('GetProviders', "countryIsos=$ISO_loc", "", '', '');
			$preg = $get_datas['Items']['0']['ValidationRegex'];

			// echo $preg; die;
			//check if the number is good
			///^91[0-9]{10,11}$/
			if (!preg_match("/$preg/", $new_phone)) {
				redirect(base_url('index.php/recharge') . "?msg=" . urlencode("Your phone number seems to be wrong, please check again."));
			}

			$_SESSION['cr_phone'] = $code . $phone;
			$_SESSION['cr_loc'] = $ISO_loc;
			$_SESSION['cr_m_step'] = '1';

			$loc = $this->input->post("loc");
			$cookie = array(
				'name'   => 'cr_loc',
				'value'  => $ISO_loc,
				'expire' =>  865000,
				'secure' => false
			);
			$this->input->set_cookie($cookie);
			// redirect($_SERVER['HTTP_REFERER']);
			redirect(base_url('index.php/recharge'));
		}
	}

	function redo()
	{
		$_SESSION['cr_phone'] = '';
		$_SESSION['cr_loc'] = '';
		$_SESSION['cr_m_step'] = '';
		redirect($_SERVER['HTTP_REFERER']);
	}

	function add_oper()
	{
		$ope = $this->input->post('ope');
		$_SESSION['cr_operator'] = $ope;
		redirect(base_url('index.php/recharge'));
	}

	function order_process()
	{
		$pro = $this->input->post('pro');
		$sku = $this->input->post('sku');
		$operator = $this->input->post('operator');
		$operator_logo = $this->input->post('operator_logo');

		$get_datas = ding_API('GetProducts', "skuCodes=$sku", '', '', '');

		$_SESSION['cr_ch_SKU'] = $sku;
		$_SESSION['cr_ch_benif'] = $get_datas['Items']['0']['DefaultDisplayText'];
		$_SESSION['cr_ch_dur'] = $get_datas['Items']['0']['ValidityPeriodIso'];
		$_SESSION['cr_ch_cost'] = $get_datas['Items']['0']['Minimum']['ReceiveValue'];
		$_SESSION['cr_ch_currency'] = $get_datas['Items']['0']['Minimum']['ReceiveCurrencyIso'];
		$_SESSION['cr_ch_country'] = $get_datas['Items']['0']['RegionCode'];

		$_SESSION['cr_order_type'] = 'm';

		$_SESSION['operator'] = $operator;
		$_SESSION['operator_logo'] = $operator_logo;

		$_SESSION['cr_m_step'] = '2';
		redirect(base_url('index.php/checkout'));
	}

	function order_process_gift()
	{
		$pro = $this->input->post('pro');
		$sku = $this->input->post('sku');
		$operator = $this->input->post('operator');
		$operator_logo = $this->input->post('operator_logo');

		$get_datas = ding_API('GetProducts', "skuCodes=$sku", '', '', '');

		$_SESSION['cr_ch_SKU'] = $sku;
		$_SESSION['cr_ch_benif'] = $get_datas['Items']['0']['DefaultDisplayText'];
		$_SESSION['cr_ch_dur'] = $get_datas['Items']['0']['ValidityPeriodIso'];
		$_SESSION['cr_ch_cost'] = $get_datas['Items']['0']['Minimum']['ReceiveValue'];
		$_SESSION['cr_ch_currency'] = $get_datas['Items']['0']['Minimum']['ReceiveCurrencyIso'];
		$_SESSION['cr_ch_country'] = $get_datas['Items']['0']['RegionCode'];

		$_SESSION['operator'] = $operator;
		$_SESSION['operator_logo'] = $operator_logo;

		$_SESSION['cr_m_step'] = '2';
		$_SESSION['cr_card'] = 'G';
		$_SESSION['cr_order_type'] = 'G';

		redirect(base_url('index.php/checkout'));
	}

	function checkout_email()
	{
		$order_id = $_SESSION['order_id'];
		$amount = $_SESSION['cr_ch_cost'];
		$benif = $_SESSION['cr_ch_benif'];
		$provider = $_SESSION['operator'];
		@$type = $_SESSION['cr_order_type'];
		$phone = @$_SESSION['cr_phone'];

		$currency = @$_SESSION['cr_ch_currency'];
		$user_country = @$_SESSION['cr_ch_country'];
		$cr_token = @$_SESSION['cr_token'];
		$cr_ch_SKU = @$_SESSION['cr_ch_SKU'];

		$order_typ = @$_SESSION['phone'];
		$crypto_type = @$_SESSION['phone'];
		$pro_logo = @$_SESSION['operator_logo'];

		$email = $this->input->post('email');
		// check email

		// add to database the order id, emaiil
		$get_check_data = $this->db->query("select * from cr_orders where or_orid ='$order_id' ");
		$check_numdata = $get_check_data->num_rows();


		if ($check_numdata == '0') {
			// echo 'sje'; die;
			$the_add_data = $this->db->query("insert into cr_orders (or_orid,or_email,or_amount,or_type,or_provider,or_benif,or_phone,or_date_created,or_status,currency,user_country,cr_token,cr_ch_SKU,pro_logo) values ('$order_id','$email','$amount','$type','$provider','$benif','$phone',now(),'0','$currency','$user_country','$cr_token','$cr_ch_SKU','$pro_logo') ");
		} else {
			// echo 'sjess'; die;
			$the_add_data = $this->db->query("update cr_orders set or_email ='$email' where or_orid ='$order_id' ");
		}

		$cookie = array(
			'name'   => 'cr_email',
			'value'  => $email,
			'expire' =>  865000,
			'secure' => false
		);
		$this->input->set_cookie($cookie);

		$_SESSION['email_process'] = $email;

		echo 'YNAPS_SUCCESS';
		die;
		// send email
	}

	function smart_search_props()
	{
		$url = '';
		$params = array();

		$q = xss_clean($_GET['q']);
		if ($q != '') {
			$params[] = 'q=' . url_smart($q);
		}

		if (isset($_GET['type'])) {
			$type = xss_clean($_GET['type']);
			$params[] = 'type=' . url_smart($type);
		}

		if (isset($_GET['bedrooms'])) {
			$bedrooms = xss_clean($_GET['bedrooms']);
			$params[] = 'bedrooms=' . url_smart($bedrooms);
		}

		if (isset($_GET['bathrooms'])) {
			$bathrooms = xss_clean($_GET['bathrooms']);
			$params[] = 'bathrooms=' . url_smart($bathrooms);
		}

		if (isset($_GET['categories'])) {
			$cat = xss_clean($_GET['categories']);
			$thecat = @implode(',', $cat);
			$params[] = 'categories=' . $thecat;
		}

		if (isset($_GET['developers'])) {
			$dev = xss_clean($_GET['developers']);
			$thedev = @implode(',', $dev);
			$params[] = 'developers=' . $thedev;
		}

		if (isset($_GET['city'])) {
			$city = xss_clean($_GET['city']);
			$params[] = 'prop_city_name=' . url_smart($city);
		}

		$price = xss_clean($_GET['price_range']);
		if ($price != '') {
			$params[] = 'price=' . $price;
		}

		if (count(@$params) > 0) {
			$url = '?' . implode('&', @$params);
		}


		// print_r($params);
		// die;

		redirect(base_url('properties' . $url));
	}

	function smart_search()
	{
		$url = '';
		$params = array();

		$q = xss_clean($_GET['q']);
		if ($q != '') {
			$params[] = 'q=' . url_smart($q);
		}

		if (isset($_GET['cat'])) {
			$cat = xss_clean($_GET['cat']);
			$thecat = @implode(',', $cat);
			$params[] = 'cat=' . $thecat;
		}

		$price = xss_clean($_GET['price']);
		if ($price != '') {
			$params[] = 'price=' . $price;
		}

		if (isset($_GET['rating'])) {
			$rating = xss_clean($_GET['rating']);
			$therating = @implode(',', $rating);
			$params[] = 'rating=' . $rating;
		}

		if (count(@$params) > 0) {
			$url = '?' . implode('&', @$params);
		}

		redirect(base_url('search' . $url));
	}

	function family()
	{
		$name = $this->input->post('name');
		$relation = $this->input->post('relation');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$gender = $this->input->post('gender');
		$dob = $this->input->post('dob');
		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$zip = $this->input->post('zip');

		$yid = $_SESSION['yid'];

		$user_state_name = getState($this->input->post('state'), 'st_name');
		$user_city_name = getCity($this->input->post('city'), 'ct_name');

		if ($name != '' && $phone != '' && $email != '') {
			// check for unique email and phone
			$chec_details = $this->db->query("select * from yn_site_mem where email='$email' or contact ='$phone' ");
			if ($chec_details->num_rows() > 0) {
				echo "We already have an account with the provided email / phone, can you provide us an alternate email and phone so that your family member can login.";
				die;
			} else {
				$code_pass = rand(11111, 99999);
				$pass = sha1($code_pass);
				$addmember = $this->db->query("insert into yn_site_mem (name,email,pass,contact,user_relationship,gender,user_state,user_city,user_city_name,user_state_name,user_zip,user_dob,user_owner) values ('$name','$email','$pass','$phone','$relation','$gender','$state','$city','$user_city_name','$user_state_name','$zip','$dob','$yid')");
				$inserted_id = $this->db->insert_id();

				$dirPath = "assets/mem/$inserted_id";
				$dirPath2 = "assets/mem/$inserted_id/img/";
				mkdir($dirPath, 0777, TRUE);
				mkdir($dirPath2, 0777, TRUE);

				$file = base_url() . 'assets/avator/main-profile.jpg';
				$file2 = base_url() . 'assets/avator/cover.jpg';
				$tocoppy = "$dirPath2/photo.jpg";
				$tocoppy2 = "$dirPath2/cover.jpg";
				$abch = copy($file, $tocoppy);
				$abch2 = copy($file2, $tocoppy2);


				$site_details = db_variables();
				$site_brief = $site_details['site_brief'];
				$site_name = $site_details['site_name'];
				$site_email = $site_details['site_email'];
				$site_address = $site_details['site_address'];

				$thenmae = $name;
				$thenmae_real = $_SESSION['name'];
				$tos = $email;
				$subject09 = "Hi $thenmae, $thenmae_real created an account for you on $site_name :)";
				$preheader = "";
				$greet = "You got a brand new account.";
				$message = "$thenmae_real created an account for you on $site_name, you can book doctors, find medicines and contact any emergency services with a simple click. <br/> To access your account your login details are:<br/><br/> Email: $email <br/> Password: <b>$code_pass</b>";
				$link = base_url('login');
				$linkname = 'Login Now';
				$message2 = "$site_brief";
				$greet2 = 'Thank you so much, your are a awesome!';
				$myName_emailis = "";
				$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
				send_email($tos, $subject09, $messageto90, $site_name, '');

				echo 'YNAPS_SUCCESS';
			}

			//addthe user to db
		} else {
			echo "Please enter the basic details to proceed further";
			die;
		}
	}

	function clinic()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$zip = $this->input->post('zip');

		$yid = $_SESSION['yid'];
		$date = date('Y-m-d H:i:s');

		$user_state_name = getState($this->input->post('state'), 'st_name');
		$user_city_name = getCity($this->input->post('city'), 'ct_name');

		if ($name != '' && $phone != '') {
			$addthisbusiness = $this->db->query("insert into site_user_business (ub_name,ub_email,ub_phone,ub_city,ub_state,ub_date,ub_city_name,ub_state_name,ub_user_owner) values ('$name','$email','$phone','$city','$state','$date','$user_city_name','$user_state_name','$yid') ");


			$site_details = db_variables();
			$site_brief = $site_details['site_brief'];
			$site_name = $site_details['site_name'];
			$site_email = $site_details['site_email'];
			$site_address = $site_details['site_address'];

			$thenmae = $_SESSION['name'];
			$tos = $_SESSION['email'];
			$subject09 = "Congratulations you have created a clinic on $site_name, $name Under Review !";
			$preheader = "";
			$greet = "Hi $thenmae";
			$message = "you have created your clinic on $site_name '$name' and we have it under review, usually it gets reviewed under 24-48 hrs. After its gets reviewed people can find your clinic online.";
			$link = base_url();
			$linkname = 'Checkout our website';
			$message2 = "$site_brief";
			$greet2 = 'Thank you so much, your are a awesome doctor.';
			$myName_emailis = "";
			$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
			send_email($tos, $subject09, $messageto90, $site_name, '');


			echo 'YNAPS_SUCCESS';
		} else {
			echo "Please enter name and phone of the business.";
			die;
		}
	}

	function otp_resend()
	{
		$what = $_GET['type'];
		if (isset($_SESSION['signup_code_email']) && $_SESSION['signup_code_email'] != '') {
			$otp_e = $_SESSION['signup_code_email'];
		} else {
			$otp_e = rand('1111', '9999');
			$_SESSION['signup_code_email'] = $otp_e;
		}
		if (isset($_SESSION['signup_code_phone']) && $_SESSION['signup_code_phone'] != '') {
			$otp_p = $_SESSION['signup_code_phone'];
		} else {
			$otp_p = rand('1111', '9999');
			$_SESSION['signup_code_phone'] = $otp_p;
		}

		$site_details = db_variables();
		$site_brief = $site_details['site_brief'];
		$site_name = $site_details['site_name'];
		$site_email = $site_details['site_email'];
		$site_address = $site_details['site_address'];

		//send email otp
		if ($what == 'e') {
			echo "sjksj34k";
		}
		//
		// send phone otp
		else if ($what == 'p') {
			echo "sjksjk45";
		}
		// Send both
		else if ($what == '2') {
			$tos = $_SESSION['email'];
			$subject09 = "Hi your OTP for website $site_name is $otp_e";
			$preheader = "Your OTP on the website.";
			$greet = "Hi";
			$message = "Thank you for asking the OTP on $site_name. Please enter the OTP as <b>$otp_e</b> to verify your email.";
			$link = base_url();
			$linkname = 'Browse Website';
			$message2 = "$site_brief";
			$greet2 = 'Thank you so much';
			$myName_emailis = "Membership";
			$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
			send_email($tos, $subject09, $messageto90, $site_name, '');

			//send sms
			$sms_mess = "Please enter the OTP as $otp_p to verify your Mobile.";
			$phone = $_SESSION['phone'];
			$_SESSION['login_otp_phone'] = $otp_p;
			// send_sms($phone, $sms_mess, 'user', $otp_p, '1');
			redirect($_SERVER['HTTP_REFERER'] . '?otp=resent');
		}
	}

	function delete_acc()
	{
		$yid = $_SESSION['yid'];
		$upadtsspost = $this->db->query("update yn_site_mem set user_status='2' where mid='$yid' ");


		// email send

		redirect(base_url('logout'));
		// echo 'YNAPS_SUCCESS';
	}

	function delete_post($id)
	{
		$this->db->query("DELETE FROM x_post_retweets WHERE r_post_id = ?", [$id]);
		$this->db->query("DELETE FROM x_post_likes WHERE l_post_id = ?", [$id]);
		$this->db->query("DELETE FROM x_post_comments WHERE c_post_id = ?", [$id]);
		$this->db->query("DELETE FROM x_posts WHERE p_id = ?", [$id]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function delete_prod($id)
	{
		$this->db->query("DELETE FROM yn_ecom_products WHERE p_id = ?", [$id]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function career()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$mess = $this->input->post('mess');

		@$captcha = $this->input->post('g-recaptcha-response');
		$this->load->view('inc/recaptchalib');
		if (!$captcha) {
			echo 'Please check the the captcha form.';
			die;
		}
		$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfgnxAUAAAAAD9TwtAKzP0dmqZenOeWb0OMCmrN&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
		if ($response['success'] == false) {
			echo 'Sorry, Captcha failed !!';
			die;
		}

		$ip = $this->input->ip_address();
		$date = date('Y-m-d H:i:s');
		$alldetails = '';

		if ($email != '') {
			$NewFileName = '';
			if (!isset($_POST["FileUpload1"])) { //echo 'in';print_r($_FILES['FileUpload1']);
				$doc = rand(111111, 999999) . '_career';
				$file_get_res = upload_doc('FileUpload1', "assets/avator/upload/", $doc);
				if (substr($file_get_res, 0, 6) == 'SUCCXX') {
					$NewFileName = substr($file_get_res, 6);
				}
				$this->db->query("insert into yn_site_contact (name,email,phone,msg,date,ip,document,con_type) values ('$name','$email','$phone','$mess','$date','$ip','$NewFileName','1')");
				echo 'YNAPS_SUCCESS';
				die;
			} else {
				echo "Please upload Document";
				die;
			}
		}
	}

	function testimonial()
	{
		$name = $this->input->post('name');
		$role = $this->input->post('role');
		$company = $this->input->post('company');
		$mess = addslashes($this->input->post('mess'));
		$order = $this->input->post('order');

		@$captcha = $this->input->post('g-recaptcha-response');
		$this->load->view('inc/recaptchalib');
		if (!$captcha) {
			echo 'Please check the the captcha form.';
			die;
		}
		$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfgnxAUAAAAAD9TwtAKzP0dmqZenOeWb0OMCmrN&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
		// if($response['success'] == false){ echo 'Sorry, Captcha failed !!'; die; }

		if ($role != '' && $company != '' && $name != '' && $mess != '') {

			if (isset($_POST['file_name']) && $_POST['file_name'] != '') {
				$cvr_prf = $_FILES['file_name']['name'];
				// $NewImageName='';
				$file_get_res = uploadonlyimage('file_name', "assets/avator/webimg/t/", '75');
				if (substr($file_get_res, 0, 6) == 'SUCCXX') {
					$NewImageName = substr($file_get_res, 6);
				}
			} else {
				$NewImageName = '';
			}


			$addtesti = $this->db->query("insert into yn_admin_testimonials (name,image,role,company,text,li) values ('$name','$NewImageName','$role','$company','$mess','$order')");

			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo "Please enter all the requied fields";
		}
	}

	function payment()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');

		$_SESSION['order_name'] = $name;
		$_SESSION['order_email'] = $email;
		$_SESSION['order_phone'] = $phone;

		redirect(base_url('pay_now?step=payment'));
	}

	function enroll()
	{
		@session_start();
		$_SESSION['courseID'] = $courseID = $this->input->post('courseID');

		// check_session('2', 'account');
		$email = $_SESSION['email'];
		$phone = $_SESSION['phone'];
		$co_user_id = $_SESSION['yid'];
		$ecom_order_name = $_SESSION['name'];

		$_SESSION['courseName'] = $courseName = $this->input->post('courseName');
		$course_end = $this->input->post('course_end');
		$_SESSION['amount'] = $amount = $this->input->post('amount');
		$_SESSION['order_id'] = $order_id = date("dmyhms") . rand('1111', '9999') . $_SESSION['yid'] . $courseID;

		if ($amount == '0') {
			$status = '1';
			$payment_status = '2';
			$redirect = base_url('thank-you?or=') . $order_id;
		} else {
			$status = $payment_status = '0';
			$redirect = base_url('pay_now');
		}

		$this->db->query("INSERT INTO `x_edu_enrollments`( `co_order_id`, `co_name`, `co_email`, `co_phone`, `co_amount`, `co_start_date`, `co_end_date`, `co_payment_status`, `co_status`, `co_course_id`, `co_user_id`) VALUES ('$order_id','$ecom_order_name','$email','$phone','$amount',now(),'$course_end','$payment_status','$status', '$courseID', '$co_user_id') ");
		redirect($redirect);
	}

	function post_review()
	{
		check_session(3, '');
		$type = $this->input->post('type');
		$type_id = $this->input->post('type_id');
		$lr_name = $this->input->post('name');
		$lr_email = $this->input->post('email');
		$lr_message = addslashes($this->input->post('desc'));
		$rating = $this->input->post('rating');
		$yid = @$_SESSION['yid'];
		$ip = $this->input->ip_address();
		$date = date('Y-m-d H:i:s');
		// $tstArr = [
		// 	$type,
		// 	$type_id,
		// 	$lr_name,
		// 	$lr_email,
		// 	$lr_message,
		// 	$rating,
		// 	$yid,
		// 	$ip
		// ];
		// print_r($tstArr);
		// die;
		//print_r($_POST);
		switch ($type) {
			case 'review':
				if ($lr_name != '' && $lr_email != '' && $lr_message != '' && $rating > 0 && $yid > 0) {
					//echo $rating;
					//echo "INSERT INTO `x_edu_course_review`(`cr_user`, `cr_type`, `cr_lid`, `cr_name`, `cr_email`, `cr_message`, `cr_date`, `cr_ip`, `cr_rating`) VALUES ('$yid', '$type', '$type_id', '$lr_name', '$lr_email','$lr_message', now(), '$ip', '$rating')";
					$this->db->query("INSERT INTO `x_edu_course_review`(`cr_user`, `cr_type`, `cr_lid`, `cr_name`, `cr_email`, `cr_message`, `cr_date`, `cr_ip`, `cr_rating`) VALUES ('$yid', '$type', '$type_id', '$lr_name', '$lr_email','$lr_message', '$date', '$ip', '$rating')");

					//send email

					// $luser=$this->input->post('luser');
					// $lname=$this->input->post('lname');
					// $lemail=$this->input->post('lemail');

					// $listing_url=base_url('business/').$type_id.'/'.url_smart($lname);

					// $site_details=db_variables();
					// $site_brief=$site_details['site_brief'];
					// $site_name=$site_details['site_name'];
					// $site_email=$site_details['site_email'];
					// $site_address=$site_details['site_address'];

					// $emaillist_act=array("$lemail","$site_email");
					//          $json_string = array( 'to' =>$emaillist_act,'category' => 'signup-form');
					//          $tos="$lemail";
					//          $subject09="Your Business '".$lname."' has been Reviewed";
					//          $preheader="";
					//          $greet="Hi, $luser";
					//          $message="Your Business '<b>".$lname."</b>' has been Reviewed by '".$lr_name."'";
					//          $message.="<br/> Please visit website to view the Review.";
					//          $link=$listing_url;
					//          $linkname="Browse Website";
					//          $message2="$site_brief";
					//          $greet2='Thank you so much';
					//          $myName_emailis="Membership";
					//          $messageto90=email_template($preheader,$greet,$message,$link,$linkname,$message2,$greet2,$site_name,$site_address);
					//          send_email($tos,$subject09,$messageto90,$site_name,$json_string);
					echo 'YNAPS_SUCCESS';
				} else {
					echo "Please enter all the required fields";
				}
				break;

			case 'rmaterial':
				if ($lr_name != '' && $lr_email != '' && $lr_message != '' && $yid > 0) {
					$smid = $this->input->post('smid');

					$this->db->query("INSERT INTO `x_edu_material_review`(`mr_user`, `mr_type`, `mr_lid`, `mr_name`, `mr_email`, `mr_message`, `mr_date`, `mr_ip`, `mr_rating`, mr_smid) VALUES ('$yid', '$type', '$type_id', '$lr_name', '$lr_email','$lr_message', now(), '$ip', '$rating', '$smid')");

					//send email

					// $luser=$this->input->post('luser');
					// $lname=$this->input->post('lname');
					// $lemail=$this->input->post('lemail');

					// $listing_url=base_url('business/').$type_id.'/'.url_smart($lname);

					// $site_details=db_variables();
					// $site_brief=$site_details['site_brief'];
					// $site_name=$site_details['site_name'];
					// $site_email=$site_details['site_email'];
					// $site_address=$site_details['site_address'];

					// $emaillist_act=array("$lemail","$site_email");
					//          $json_string = array( 'to' =>$emaillist_act,'category' => 'signup-form');
					//          $tos="$lemail";
					//          $subject09="Your Business '".$lname."' has been Reviewed";
					//          $preheader="";
					//          $greet="Hi, $luser";
					//          $message="Your Business '<b>".$lname."</b>' has been Reviewed by '".$lr_name."'";
					//          $message.="<br/> Please visit website to view the Review.";
					//          $link=$listing_url;
					//          $linkname="Browse Website";
					//          $message2="$site_brief";
					//          $greet2='Thank you so much';
					//          $myName_emailis="Membership";
					//          $messageto90=email_template($preheader,$greet,$message,$link,$linkname,$message2,$greet2,$site_name,$site_address);
					//          send_email($tos,$subject09,$messageto90,$site_name,$json_string);
					echo 'YNAPS_SUCCESS';
				} else {
					echo "Please enter all the required fields";
				}
				break;

			default: //echo $type;
				break;
		}
	}

	function qbtest_user()
	{
		$qbid = $this->input->get('qbid');

		if (isset($_SESSION['yid']) && $_SESSION['yid'] > '0') {
			$yid = $_SESSION['yid'];

			$getheQbankUser = $this->db->query("select * from x_edu_qbank_user, x_edu_qbank where qb_id=qbu_qbid and qbu_qbid='$qbid' and qbu_mid='$yid' and qbstatus='1' order by qbu_id DESC");

			$thetheQbankUser = $getheQbankUser->row_array();
			//print_r($thetheQbankUser);
			//echo strtotime($thetheQbankUser['qbu_end_time']). '   '.strtotime(date('YmdHis'));
			if ($thetheQbankUser['qbu_status'] == '1' && (strtotime($thetheQbankUser['qbu_end_time']) < strtotime(date('YmdHis')))) {
				$exp_exam_id = $thetheQbankUser['qbu_exam_id'];
				//echo "UPDATE x_edu_qbank_user SET qbu_status='0', qbu_score='0' where qbu_qbid='$qbid' and qbu_mid='$yid' and qbu_exam_id='$exp_exam_id'";die();
				$this->db->query("UPDATE x_edu_qbank_user SET qbu_status='0', qbu_score='0' where qbu_qbid='$qbid' and qbu_mid='$yid' and qbu_exam_id='$exp_exam_id'");
			}

			$getheQbank = $this->db->query("select * from x_edu_qbank where qb_id='$qbid'");
			$thisQbank = $getheQbank->row_array();
			$duration = $thisQbank['qbtime'];

			$test_time = date('Y-m-d H:i:s');
			$test_time_end = date('Y-m-d H:i:s', strtotime('+' . $duration . 'mins'));

			$ip = $this->input->ip_address();
			$_SESSION['qbid'] = $qbid;
			$_SESSION['exam_user'] = $yid;
			$_SESSION['exam_id'] = $exam_id = date('ymdHis') . $yid;
			$qbu_sid = $_SESSION['sid'];

			$theQbankTest = $this->db->query("INSERT INTO x_edu_qbank_user (qbu_qbid, qbu_mid, qbu_start_time, qbu_end_time, qbu_status, qbu_ip, qbu_exam_id,qbu_sid) VALUES ('$qbid' ,'$yid', '$test_time', '$test_time_end', '1', '$ip', '$exam_id', '$qbu_sid')");

			redirect(base_url('qbtest'));
		}
	}

	function qbtest()
	{
		//print_r($_POST);
		$q = $this->input->post('q');
		$qbid = $this->input->post('qbid');
		$qbt_answer = $this->input->post('option');
		if ($qbt_answer == '') {
			redirect(base_url('qbtest?qbid=' . $qbid . '&q=' . $q));
		}
		$num = $this->input->post('num');
		$qid = $this->input->post('qid');
		// $q=$q+1;
		// if($q >= $num){
		// 	$q='last';
		// }    	    	

		if (isset($_SESSION['yid']) && $_SESSION['yid'] > '0') {
			$yid = $_SESSION['yid'];
			$exam_id = $_SESSION['exam_id'];
			if ($qbt_answer > '0' && $exam_id > '0') {
				$qbt_time = date('Y-m-d H:i:s');
				$ip = $this->input->ip_address();

				$getheQbankTest = $this->db->query("select * from x_edu_qbank_test where qbt_exam_id='$exam_id' and qbt_qid='$qid' and qbt_mid='$yid' and qbt_qbid='$qbid'");

				if (!empty($getheQbankTest) && $getheQbankTest->num_rows() == '0') {
					$theQbankTest = $this->db->query("INSERT INTO `x_edu_qbank_test`(`qbt_qid`, `qbt_qbid`, `qbt_answer`, `qbt_time`, `qbt_ip`, `qbt_status`, `qbt_mid`, `qbt_exam_id`) VALUES ('$qid', '$qbid', '$qbt_answer','$qbt_time','$ip','1', '$yid', '$exam_id')");
				} else {
					$theQbankTest = $this->db->query("UPDATE `x_edu_qbank_test` SET `qbt_answer`='$qbt_answer', `qbt_time`='$qbt_time', `qbt_ip`='$ip', `qbt_status`='1', `qbt_mid`='$yid' WHERE `qbt_exam_id`='$exam_id' and `qbt_qid`='$qid' and `qbt_qbid`='$qbid'");
				}
			}
		}
		//echo 'qbtest?qbid='.$qbid.'&q='.$q;die;
		redirect(base_url('qbtest?qbid=' . $qbid . '&q=' . $q));
	}

	function qbtest_status()
	{
		$q = $this->input->get('q');
		$qid = $this->input->get('qid');
		$qbid = $this->input->get('qbid');
		$what = $this->input->get('what');

		if (isset($_SESSION['yid']) && $_SESSION['yid'] > '0') {
			$yid = $_SESSION['yid'];
			$exam_id = $_SESSION['exam_id'];
			if ($what != 'erase') {
				switch ($what) {
					case 'skip':
						$qbt_status	= '2';
						break;
					case 'review':
						$qbt_status	= '3';
						break;
				}

				$qbt_time = date('Y-m-d H:i:s');
				$ip = $this->input->ip_address();

				$getheQbankTest = $this->db->query("select * from x_edu_qbank_test where qbt_exam_id='$exam_id' and qbt_qid='$qid' and qbt_mid='$yid' and qbt_qbid='$qbid'");

				if (!empty($getheQbankTest) && $getheQbankTest->num_rows() == '0') {
					$exam_id = $_SESSION['exam_id'];
					$theQbankTest = $this->db->query("INSERT INTO `x_edu_qbank_test`( `qbt_qid`, `qbt_qbid`, `qbt_time`, `qbt_ip`, `qbt_status`, `qbt_mid`, `qbt_exam_id`) VALUES ('$qid', '$qbid','$qbt_time','$ip','$qbt_status', '$yid', '$exam_id')");
				} else {
					// $theRow=$getheQbankTest->row_array();
					// $qbt_id=$theRow['qbt_id'];
					$theQbankTest = $this->db->query("UPDATE `x_edu_qbank_test` SET `qbt_time`='$qbt_time', `qbt_ip`='$ip', `qbt_status`='$qbt_status', `qbt_mid`='$yid', `qbt_answer`='0' WHERE `qbt_exam_id`='$exam_id' and `qbt_qid`='$qid' and `qbt_qbid`='$qbid'");
				}
			} elseif ($what == 'erase') {
				$getheQbankTest = $this->db->query("DELETE from x_edu_qbank_test where qbt_exam_id='$exam_id' and qbt_qid='$qid' and qbt_mid='$yid' and qbt_qbid='$qbid'");
			}
		}
		//echo 'qbtest?qbid='.$qbid.'&q='.$q;die;
		redirect(base_url('qbtest?qbid=' . $qbid . '&q=' . $q));
	}

	function add_bookmark()
	{
		$yid = @$_SESSION['yid'];
		$mat_id = $_GET['smid'];
		$enrol = $_GET['enrol'];

		$getheMatBookmark = $this->db->query("select * from x_edu_material_bookmark where emb_mat_id='$mat_id' and emb_mem_id='$yid'");

		if ($getheMatBookmark->num_rows() == '0') {
			$theQbankTest = $this->db->query("INSERT INTO `x_edu_material_bookmark`( `emb_mat_id`, `emb_mem_id`) VALUES ('$mat_id', '$yid')");
		} else {
			$theQbankTest = $this->db->query("DELETE FROM `x_edu_material_bookmark` WHERE `emb_mat_id`='$mat_id' and `emb_mem_id`='$yid'");
		}

		redirect(base_url('viewMaterial?enrol=' . $enrol . '&smid=' . $mat_id));
	}

	function series_enroll()
	{
		@session_start();
		$_SESSION['seriesID'] = $seriesID = $this->input->post('seriesID');
		$_SESSION['cat'] = $cat = $this->input->post('cat');
		check_session('2', 'account');
		$email = $_SESSION['email'];
		$phone = $_SESSION['phone'];
		$se_user_id = $_SESSION['yid'];
		$ecom_order_name = $_SESSION['name'];
		$_SESSION['series_name'] = $series_name = $this->input->post('series_name');
		$series_start = $this->input->post('series_start');
		$series_end = $this->input->post('series_end');
		$_SESSION['amount'] = $amount = $this->input->post('amount');
		$_SESSION['order_id'] = $order_id = date("dmyhms") . rand('1111', '9999') . $_SESSION['yid'] . $seriesID;
		$se_date = date('Y-m-d');

		if ($amount == '0') {
			$status = '1';
			$payment_status = '2';
			$redirect = base_url('thank-you?sor=') . $order_id;
		} else {
			$status = $payment_status = '0';
			$redirect = base_url('spay_now');
		}

		$this->db->query("INSERT INTO `x_edu_series_enroll`( `se_order_id`, `se_name`, `se_email`, `se_phone`, `se_amount`, `se_start_date`, `se_end_date`, `se_payment_status`, `se_status`, `se_series_id`, `se_user_id`, `se_date`) VALUES ('$order_id','$ecom_order_name','$email','$phone','$amount', '$series_start','$series_end','$payment_status','$status', '$seriesID', '$se_user_id', '$se_date') ");

		//send email

		$site_details = db_variables();
		$site_brief = $site_details['site_brief'];
		$site_name = $site_details['site_name'];
		$site_email = $site_details['site_email'];
		$site_address = $site_details['site_address'];

		$emaillist_act = array("$email", "$site_email");
		$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
		$tos = "$email";
		$subject09 = "'" . $courseName . "' Series Enrollment";
		$preheader = "";
		$greet = "Hi, $ecom_order_name";
		$message = "You have Enrolled successfully for the Series '<b>" . $series_name . "</b>'";
		$message .= "<br/> Please login to view the series Details.";
		$link = base_url();
		$linkname = "Browse Website";
		$message2 = "$site_brief";
		$greet2 = 'Thank you so much';
		$myName_emailis = "Membership";
		$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
		send_email($tos, $subject09, $messageto90, $site_name, $json_string);

		redirect($redirect);
	}

	function add_qbank_bookmark()
	{
		$yid = @$_SESSION['yid'];
		$qbid = $_GET['qbid'];
		$ques = $_GET['ques'];
		$q = @$_GET['q'];
		$page = @$_GET['page'];
		$check = @$_GET['check'];
		$exam_id = @$_GET['exam_id'];

		$getheQuesBookmark = $this->db->query("select * from x_edu_ques_bookmark where eqb_qid='$ques' and eqb_mem_id='$yid'");

		if ($getheQuesBookmark->num_rows() == '0') {
			$theQbankTest = $this->db->query("INSERT INTO `x_edu_ques_bookmark`( `eqb_qbid`, `eqb_mem_id`, `eqb_qid`) VALUES ('$qbid', '$yid', '$ques')");
		}
		// else{
		// 	$theQbankTest=$this->db->query("DELETE FROM `x_edu_ques_bookmark` WHERE `eqb_qbid`='$qbid' and `eqb_mem_id`='$yid'");
		// }

		//redirect(base_url('qbtest?qbid='.$qbid.'&q='.$q));
		if (isset($_GET['page']) && $_GET['page'] > '0') {
			redirect(base_url('qbtest_end?exam_id=') . $exam_id . '&check=' . $check . '&page=' . $page);
		} else {
			redirect(base_url('qbtest_end?exam_id=') . $exam_id . '&check=' . $check);
		}
	}

	function report_qbank()
	{
		$yid = @$_SESSION['yid'];
		$qbid = $_GET['qbid'];
		$ques = $_GET['ques'];
		$q = @$_GET['q'];
		$page = @$_GET['page'];
		$check = @$_GET['check'];
		$exam_id = @$_GET['exam_id'];

		$getheQuesReport = $this->db->query("select * from x_edu_ques_report where erb_qid='$ques' and erb_mem_id='$yid'");

		if ($getheQuesReport->num_rows() == '0') {
			$theQbankTest = $this->db->query("INSERT INTO `x_edu_ques_report`( `erb_qbid`, `erb_mem_id`, `erb_qid`) VALUES ('$qbid', '$yid', '$ques')");
		}

		//redirect(base_url('qbtest?qbid='.$qbid.'&q='.$q));
		if (isset($_GET['page']) && $_GET['page'] > '0') {
			redirect(base_url('qbtest_end?exam_id=') . $exam_id . '&check=' . $check . '&page=' . $page);
		} else {
			redirect(base_url('qbtest_end?exam_id=') . $exam_id . '&check=' . $check);
		}
	}

	function update_user_categories()
	{
		$yid = $_SESSION['yid'];
		$categories = $this->input->post('categories');
		$categories_str = !empty($categories) ? implode(',', $categories) : '';
		$update_data = ['user_categories' => $categories_str];
		$this->db->where('mid', $yid);
		$this->db->update('yn_site_mem', $update_data);

		echo "YNAPS_SUCCESS";
		die;
	}

	function user_favourite_me()
	{
		check_session(3, '');
		$favId = $this->input->post('itemID');
		$yid = $_SESSION['yid'];

		$CHK_follow = $this->db->query("SELECT * FROM `x_followers` WHERE `f_follow_by`='$yid' AND `f_follow_to`='$favId'");
		$exist = $CHK_follow->num_rows();

		if ($exist == 0) {
			$this->db->query("INSERT INTO `x_followers`(`f_follow_by`, `f_follow_to`, `f_date`) VALUES ('$yid','$favId',now())");
			$status = 'followed';
		} else {
			$this->db->query("DELETE FROM `x_followers` WHERE `f_follow_by`='$yid' AND `f_follow_to`='$favId'");
			$status = 'unfollowed';
		}

		myfav_users($yid, 'reset');

		echo json_encode(['status' => $status]);
		die;
	}

	function add_post()
	{
		if (!isset($_SESSION['yid'])) {
			echo "Please login to continue.";
			die;
		}

// 		echo "<pre>";
// 		print_r($_FILES); // Display uploaded file information
// 		echo "</pre>";
		
// 		echo "<hr/>";
// 		echo "<pre>";
// 		print_r($_POST);
// 		echo "</pre>";
// 		die;

		$yid = $_SESSION['yid'];
		$uniq_id = uniqid() . $yid;
		$post_data = addslashes($this->input->post('post'));
		$title = addslashes($this->input->post('title'));
		$tags = addslashes($this->input->post('tags'));
		$date = date('Y-m-d H:i:s');

		$post = '<p><strong>' . $title . '</strong></p>' . $post_data . '<p><strong><a href="javascript:void()">' . $tags . '</a></strong></p>';

		if (!isset($_SESSION['yid'])) {
			redirect(base_url('login'));
		}

		// Check if a poll is being created
		$poll_options = $this->input->post('poll_option');
		$is_poll = 0;
		$poll_data = '';

		if (!empty($poll_options)) {
			$is_poll = 1;
			$poll_data = json_encode(array_filter($poll_options)); // Save poll options as JSON
		}

		// Image Upload
    	// MULTIPLE IMAGE UPLOAD
    $post_image = '';
    $post_is_image = '0';
    
    if (!empty($_FILES['post_images']['name'][0])) {
        $uploaded = [];
        foreach ($_FILES['post_images']['name'] as $i => $name) {
            if ($_FILES['post_images']['error'][$i] == 0) {
                $tmp = $_FILES['post_images']['tmp_name'][$i];
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                $new_name = uniqid() . '.' . $ext;
                move_uploaded_file($tmp, FCPATH . "assets/avator/upload/" . $new_name);
                $uploaded[] = $new_name;
            }
        }
        if (!empty($uploaded)) {
            $post_image = implode(',', $uploaded); // comma-separated
            $post_is_image = '1';
        }
    }


		// Video Upload
		if (!empty($_FILES['post_video']['name'])) {
			$file_get_res = upload_doc('post_video', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$post_video = substr($file_get_res, 6);
				$post_is_video = '1';
			}
		} else {
			$post_video = '';
			$post_is_video = '0';
		}

		if (empty($post)) {
			echo "Write something to post";
			die;
		}
		$poll_id = rand(0, 9999);

		// Insert post into the database
		$insQry = $this->db->query("INSERT INTO x_posts (`p_user_id`,`p_uniq_id`,`p_content`,`p_image`,`p_video`,`post_is_image`,`post_is_video`,`p_created`,`is_poll`, `poll_data` ) 
    VALUES ('$yid','$uniq_id','$post','$post_image','$post_video','$post_is_image','$post_is_video','$date','$is_poll','$poll_data' )");

		if ($insQry && $is_poll && !empty($poll_options)) {
			$post_id = $this->db->insert_id(); // Get the last inserted post ID

			// Insert each poll option into the x_polls table
			foreach ($poll_options as $option_text) {
				$option_text = trim($option_text);
				if (!empty($option_text)) {
					$this->db->query("INSERT INTO x_polls (`post_id`, `option_text`) VALUES ('$post_id', '$option_text')");
				}
			}
		}
		if ($insQry) {
			echo "YNAPS_SUCCESS1";
			die;
		}
	}


	public function vote_poll()
	{
		if (!isset($_SESSION['yid'])) {
			redirect(base_url('login'));
		}

		$yid = $_SESSION['yid'];
		$poll_option_id = $this->input->post('poll_option'); // Poll option ID user voted for
		$post_id = $this->input->post('post_id'); // Post ID associated with the poll

        if (empty($poll_option_id)) {
			echo "You need to choose an option to vote.";
			die;
		}

		// Check if user has already voted on this poll
		$existing_vote = $this->db->get_where('x_votes', [
			'user_id' => $yid,
			'post_id' => $post_id
		])->row();

		if ($existing_vote) {
			echo "You have already voted on this poll.";
			die;
		}

		// Update vote count for the selected option
		$this->db->set('votes', 'votes+1', FALSE);
		$this->db->where('id', $poll_option_id);
		$this->db->update('x_polls');

		// Record the vote in x_votes table
		$this->db->insert('x_votes', [
			'user_id' => $yid,
			'option_id' => $poll_option_id,
			'post_id' => $post_id
		]);

		echo "Your vote has been recorded successfully.";
		redirect(base_url());
	}



	function edit_post()
	{
		if (!isset($_SESSION['yid'])) {
			echo "Please login to continue.";
			die;
		}

		$yid = $_SESSION['yid'];
		$post_id	= addslashes($this->input->post('p_id'));
		$post 		= addslashes($this->input->post('post'));
		$old_image 	= addslashes($this->input->post('old_image'));
		$old_video 	= addslashes($this->input->post('old_video'));


		if (!isset($_SESSION['yid'])) {
			redirect(base_url('login'));
		}

		// Image
		if (!empty($_FILES['post_image']['name'])) {
			$file_get_res = upload_doc('post_image', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$post_image = substr($file_get_res, 6);
				$post_is_image = '1';
			}
		} elseif ($old_image != '') {
			$post_image = $old_image;
			$post_is_image = '1';
		} else {
			$post_image = '';
			$post_is_image = '0';
		}

		// Video
		if (!empty($_FILES['post_video']['name'])) {
			$file_get_res = upload_doc('post_video', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$post_video = substr($file_get_res, 6);
				$post_is_video = '1';
			}
		} elseif ($old_video) {
			$post_video = $old_video;
			$post_is_video = '1';
		} else {
			$post_video = '';
			$post_is_video = '0';
		}

		if (empty($post)) {
			echo "Write something to post";
			die;
		}

		$checkUniqueId = $this->db->query("SELECT * FROM x_posts WHERE p_id = ? AND p_uniq_id != ''", array($post_id));

		$data = array(
			'p_content' => $post,
			'p_image' => $post_image,
			'p_video' => $post_video,
			'post_is_image' => $post_is_image,
			'post_is_video' => $post_is_video,
		);

		if ($checkUniqueId->num_rows() == 0) {
			$data['p_uniq_id'] = uniqid() . $yid;
		}


		$this->db->where('p_id', $post_id);
		$this->db->where('p_user_id', $yid);
		$this->db->update('x_posts', $data);

		if ($this->db->affected_rows() > 0) {
			echo "YNAPS_SUCCESS_POST";
			die;
		}
	}

function add_comment()
{
    if (!isset($_SESSION['yid'])) {
        echo "Login to continue";
        die;
    }

    $yid = $_SESSION['yid'];
    $comment = trim($this->input->post('comment-text'));
    $post_id = $this->input->post('post_id');

    if (empty($post_id)) {
        echo "Something went wrong";
        die;
    }

    if (empty($comment)) {
        echo "Comment cannot be empty";
        die;
    }

    $data = array(
        "c_user_id" => $yid,
        "c_comment_text" => addslashes($comment),
        "c_post_id" => $post_id,
        "c_created_at" => date('Y-m-d H:i:s'),
    );

    $this->db->insert('x_post_comments', $data);

    if ($this->db->affected_rows() > 0) {
        // ✅ Recalculate total comments count
        $comment_count = $this->db
            ->where("c_post_id", $post_id)
            ->count_all_results("x_post_comments");

        // ✅ Update the count in x_posts
        $this->db->where("p_id", $post_id)
                 ->update("x_posts", ["p_comments_count" => $comment_count]);

        echo "YNAPS_SUCCESS";
    } else {
        echo "Failed to add comment";
    }
    die;
}


	function kyc_verification()
	{
		$yid = $_SESSION['yid'];

		// Aadhaar Card Front
		if (!empty($_FILES['aadhar_front']['name'])) {
			$file_get_res = upload_doc('aadhar_front', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$aadhar_front = substr($file_get_res, 6);
			}
		} else {
			echo "Aadhaar card front image is required";
			die;
		}

		// Aadhaar Card Back
		if (!empty($_FILES['aadhar_back']['name'])) {
			$file_get_res = upload_doc('aadhar_back', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$aadhar_back = substr($file_get_res, 6);
			}
		} else {
			echo "Aadhaar card back image is required";
			die;
		}

		$data = array(
			'kyc_user_id' => $yid,
			'kyc_img_front' => $aadhar_front,
			'kyc_img_back' => $aadhar_back
		);

		$query = $this->db->insert('x_kyc', $data);

		if ($query) {
			$this->db->query("UPDATE yn_site_mem SET kyc_status = '0' WHERE mid = '$yid'");
			echo  "YNAPS_SUCCESS1";
			die;
		}
	}

	function create_shop()
	{
		$yid 			= $_SESSION['yid'];
		$what 			= $this->input->post('what');
		@$shop_id 		= $this->input->post('shop_id');
		$shop_name 		= addslashes($this->input->post('shop_name'));
		$shop_uniq_id 	= uniqid() . $yid;
		$shop_state 	= $this->input->post('shop_state');
		$shop_city 		= $this->input->post('shop_city');
		$shop_zip 		= $this->input->post('shop_zip');
		$shop_address 	= addslashes($this->input->post('shop_address'));
		$shop_desc 		= addslashes($this->input->post('shop_desc'));
		$existing_logo 	= addslashes($this->input->post('existing_logo'));

		if (empty($shop_name)) {
			echo "Shop name is required";
			die;
		}

		if (empty($shop_state)) {
			echo "Shop state is required";
			die;
		}

		if (empty($shop_city)) {
			echo "Shop city is required";
			die;
		}

		if (empty($shop_zip)) {
			echo "Shop postal/zip is required";
			die;
		}

		if (empty($shop_address)) {
			echo "Shop address is required";
			die;
		}

		if (empty($shop_desc)) {
			echo "Shop description is required";
			die;
		}

		if (!empty($_FILES['file_name']['name'])) {
			$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$logo = substr($file_get_res, 6);
			}
		} elseif (!empty($existing_logo)) {
			$logo = $existing_logo;
		} else {
			echo "Shop logo is required";
			die;
		}


		switch ($what) {
			case 'add':
				$insData = array(
					"shop_name" => $shop_name,
					"shop_uniq_id" => $shop_uniq_id,
					"shop_state" => $shop_state,
					"shop_city" => $shop_city,
					"shop_zip" => $shop_zip,
					"shop_address" => $shop_address,
					"shop_desc" => $shop_desc,
					"shop_logo" => $logo,
					"shop_user_id" => $yid
				);
				$this->db->insert('x_vendor_shop', $insData);
				$this->db->query("UPDATE yn_site_mem SET `is_vendor`='1' WHERE mid = '$yid'");
				echo  "YNAPS_SUCCESS1";
				die;
				break;
			case 'update':
				$updData = array(
					"shop_name" => $shop_name,
					"shop_state" => $shop_state,
					"shop_city" => $shop_city,
					"shop_zip" => $shop_zip,
					"shop_address" => $shop_address,
					"shop_desc" => $shop_desc,
					"shop_logo" => $logo
				);
				$this->db->where('shop_id', $shop_id);
				$this->db->update('x_vendor_shop', $updData);
				echo "YNAPS_SUCCESS1";
				die;
				break;
		}
	}

	function add_product()
	{
		$yid 			= $_SESSION['yid'];
		$user_profile 	= $this->ynaps_model->getprofile_data('*', $yid);
		$user_shop_id	= $user_profile['user_shop_id'];
		$what			= $this->input->post('what');
		@$product_id	= $this->input->post('product_id');
		$product_name	= $this->input->post('p_name');
		$p_category		= $this->input->post('p_category');
		$p_sku			= $this->input->post('p_sku');
		$p_stock			= $this->input->post('p_stock');
		$p_price		= $this->input->post('p_price');
		$p_price_type	= $this->input->post('p_price_type');
		$p_price_show	= $this->input->post('p_price_show');
		$p_descp		= addslashes($this->input->post('p_descp'));
		$existing_img	= $this->input->post('existing_img');

		if (empty($product_name)) {
			echo "Product name is required";
			die;
		}

		if (empty($p_category)) {
			echo "Category is required";
			die;
		}

		if (empty($p_sku)) {
			$p_sku = uniqid();
		}

		if (empty($p_stock)) {
			echo "Stock is required";
			die;
		}

		if (empty($p_price)) {
			echo "Price is required";
			die;
		}

		if (empty($p_price_type)) {
			echo "Price type required";
			die;
		}

		if (empty($p_descp)) {
			echo "Description required";
			die;
		}

		$created_at = date('Y-m-d H:i:s');

		if (!empty($_FILES['file_name']['name'])) {
			$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$p_cover = substr($file_get_res, 6);
			}
		} elseif (!empty($existing_img)) {
			$p_cover = $existing_img;
		} else {
			echo "Product thumbnail is required";
			die;
		}

		switch ($what) {
			case 'add_product':

				$insData = array(
					"p_name" => $product_name,
					"p_category" => $p_category,
					"p_sku" => $p_sku,
					"p_stock" => $p_stock,
					"p_price" => $p_price,
					"p_price_type" => $p_price_type,
					"p_price_show" => $p_price_show,
					"p_descp" => $p_descp,
					"p_cover" => $p_cover,
					"p_mid" => $yid,
					"p_vendor" => $user_shop_id,
					"created_at" => $created_at
				);
				$this->db->insert('yn_ecom_products', $insData);
				echo "YNAPS_SUCCESS1";
				die;
				break;

			case 'edit_product':
				$updData = array(
					"p_name" => $product_name,
					"p_category" => $p_category,
					"p_sku" => $p_sku,
					"p_stock" => $p_stock,
					"p_price" => $p_price,
					"p_price_type" => $p_price_type,
					"p_price_show" => $p_price_show,
					"p_descp" => $p_descp,
					"p_cover" => $p_cover
				);
				$this->db->where('p_id', $product_id);
				$this->db->update('yn_ecom_products', $updData);
				echo "YNAPS_SUCCESS1";
				die;
				break;
		}
	}

	function fetch_nft_graph_data()
	{

		header('Content-Type: application/json');

		$apiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJub25jZSI6IjVlZjc2OGY0LWVjNDAtNGJmNy04MGZkLWIyNGFjNWExZTFhMSIsIm9yZ0lkIjoiNDM2ODcyIiwidXNlcklkIjoiNDQ5NDMwIiwidHlwZUlkIjoiYmY0MTk1ZTUtMDUzMC00M2M5LTkzMmUtOWYxMTY4OTc4MTQ2IiwidHlwZSI6IlBST0pFQ1QiLCJpYXQiOjE3NDIyODA0MzcsImV4cCI6NDg5ODA0MDQzN30._NZ_FKjn5jknUPCQP7Q2p3AG-EfBZJN_y_8a823JoSg";
		$marketCapUrl = "https://deep-index.moralis.io/api/v2.2/market-data/nfts/top-collections";

		// Fetch NFT Data
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $marketCapUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => ["X-API-Key: $apiKey"],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) {
			echo json_encode(["error" => $err]);
		} else {
			$nftData = json_decode($response, true);
			$labels = [];
			$values = [];

			foreach ($nftData['result'] as $nft) {
				$labels[] = $nft['collection_title'];
				$values[] = floatval($nft['floor_price']);
			}

			echo json_encode(["labels" => $labels, "values" => $values]);
		}
	}

	function fetch_data()
	{
		$apiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJub25jZSI6IjVlZjc2OGY0LWVjNDAtNGJmNy04MGZkLWIyNGFjNWExZTFhMSIsIm9yZ0lkIjoiNDM2ODcyIiwidXNlcklkIjoiNDQ5NDMwIiwidHlwZUlkIjoiYmY0MTk1ZTUtMDUzMC00M2M5LTkzMmUtOWYxMTY4OTc4MTQ2IiwidHlwZSI6IlBST0pFQ1QiLCJpYXQiOjE3NDIyODA0MzcsImV4cCI6NDg5ODA0MDQzN30._NZ_FKjn5jknUPCQP7Q2p3AG-EfBZJN_y_8a823JoSg"; // Replace with your actual Moralis API Key
		$nftTokens = [
			["token_address" => "0xb47e3cd837ddf8e4c57f05d70ab865de6e193bbb", "token_id" => "1"],  // CryptoPunks
			["token_address" => "0xbc4ca0eda7647a8ab7c2061c2e118a18a936f13d", "token_id" => "5"],  // Bored Ape Yacht Club
			["token_address" => "0x8a90cab2b38dba80c64b7734e58ee1db38b8992e", "token_id" => "10"], // Doodles
			["token_address" => "0xbd3531da5cf5857e7cfaa92426877b022e612cf8", "token_id" => "15"], // Pudgy Penguins
			["token_address" => "0xd774557b647330c91bf44cfeab205095f7e6c367", "token_id" => "3"],  // Moonbirds
			["token_address" => "0xed5af388653567af2f388e6224dc7c4b3241c544", "token_id" => "4"],  // Azuki
			["token_address" => "0x7bd29408f11d2bfc23c34f18275bbf23bb716bc7", "token_id" => "8"],  // Meebits
			["token_address" => "0x1a92f7381b9f03921564a437210bb9396471050c", "token_id" => "9"],  // Cool Cats
			["token_address" => "0x3b3ee1931dc30c1957379fac9aba94d1c48a5405", "token_id" => "13"], // FND NFT
			["token_address" => "0xabefbc9fd2f806065b4f3c237d4b59d9a97bcac7", "token_id" => "16"], // Zora NFT
			["token_address" => "0x31385d3520bced94f77aae104b406994d8f2168c", "token_id" => "19"], // Bastard Gan Punks
			["token_address" => "0xe785e82358879f061bc3dcac6f0444462d4b5330", "token_id" => "20"], // World of Women
			["token_address" => "0x59468516a8259058bad1ca5f8f4bff190d30e066", "token_id" => "23"], // Invisible Friends
			["token_address" => "0xff9c1b15b16263c61d017ee9f65c50e4ae0113d7", "token_id" => "24"], // Loot (for Adventurers)
			["token_address" => "0xa7d8d9ef8d8ce8992df33d8b8cf4aebabd5bd270", "token_id" => "25"], // Art Blocks Curated
		];

		$requestBody = json_encode(["tokens" => $nftTokens, "normalizeMetadata" => false, "media_items" => true]);

		$ch = curl_init("https://deep-index.moralis.io/api/v2.2/nft/getMultipleNFTs?chain=eth");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"X-API-Key: $apiKey",
			"Content-Type: application/json"
		]);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);

		$response = curl_exec($ch);
		curl_close($ch);

		$data = json_decode($response, true);

		$nftLabels = [];
		$nftRarity = [];

		if (!empty($data) && is_array($data)) {
			foreach ($data as $nft) {
				$nftLabels[] = $nft['name'] ?? "Unknown NFT";
				$nftRarity[] = $nft['rarity_percentage'] ?? rand(1, 100); // Default random value if missing
			}
		}

		// Return JSON for Chart.js
		echo json_encode(["labels" => $nftLabels, "values" => $nftRarity]);
	}


	public function property_search()
	{
		$type = $this->input->get('type');
		$city = $this->input->get('city');

		$type = strtolower(trim($type));
		$city = trim($city);

		$this->db->distinct();
		$this->db->select('prop_city_name');
		$this->db->from('x_home_property');
		$this->db->where('prop_rent_sale', $type);

		if (!empty($city)) {
			$this->db->like('prop_city_name', $city);
		}

		$this->db->limit(10);
		$query = $this->db->get();
		$cities = $query->result_array();

		echo json_encode($cities);
	}

	public function get_recommendations()
	{
		$budget = $this->input->get('budget');
		$bedrooms = $this->input->get('bedrooms');
		$bathrooms = $this->input->get('bathrooms');

		$this->db->select('prop_id, prop_name, prop_price, prop_bedroom, prop_bathroom, prop_area');
		$this->db->from('x_home_property');
		$this->db->where('prop_status', 1);

		if (!empty($budget)) {
			$this->db->where('prop_price <=', $budget);
		}
		if (!empty($bedrooms)) {
			$this->db->where('prop_bedroom', $bedrooms);
		}
		if (!empty($bathrooms)) {
			$this->db->where('prop_bathroom', $bathrooms);
		}

		$this->db->limit(10);
		$result = $this->db->get()->result_array();
		echo json_encode($result);
	}

	public 	function add_property()
	{
		$what 				= $this->input->post('what');
		@$prop_id 			= $this->input->post('prop_id');
		$prop_name 			= addslashes($this->input->post('prop_name'));
		$prop_category 		= $this->input->post('prop_category');
		$prop_sub_category 	= $this->input->post('prop_sub_category');
		$prop_rent_sale 	= $this->input->post('prop_rent_sale');
		$prop_area 			= addslashes($this->input->post('prop_area'));
		$prop_bedroom 		= $this->input->post('prop_bedroom');
		$prop_bathroom 		= $this->input->post('prop_bathroom');
		$prop_facing 		= $this->input->post('prop_facing');
		$prop_furnished 	= $this->input->post('prop_furnished');
		$prop_floor 		= $this->input->post('prop_floor');
		$prop_total_floors	= $this->input->post('prop_total_floors');
		$prop_balcony		= $this->input->post('prop_balcony');
		$prop_state			= $this->input->post('prop_state');
		$prop_city			= $this->input->post('prop_city');
		$prop_youtube			= $this->input->post('prop_youtube');
		$prop_address		= addslashes($this->input->post('prop_address'));
		$prop_price			= $this->input->post('prop_price');
		$old_img			= $this->input->post('old_img');
		$prop_amenity_list	= $this->input->post('prop_amenity_list');
		$prop_furnish_list	= $this->input->post('prop_furnish_list');
		$prop_desc 			= addslashes($this->input->post('prop_desc'));
		$prop_vendor	= $this->input->post('prop_vendor');
		$prop_map	= $this->input->post('prop_map');

		if (empty($prop_name)) {
			echo "Property name is required";
			die;
		}

		if (empty($prop_category)) {
			echo "Category is required";
			die;
		}

		if (empty($prop_sub_category)) {
			echo "Sub category is required";
			die;
		}

		if (empty($prop_rent_sale)) {
			echo "Property for is required";
			die;
		}

		if (empty($prop_area)) {
			echo "Property Area is required";
			die;
		}

		if (empty($prop_bedroom)) {
			echo "Number of Bedrooms is required";
			die;
		}

		if (empty($prop_bathroom)) {
			echo "Number of Bathrooms is required";
			die;
		}

		if (empty($prop_facing)) {
			echo "Property facing is required";
			die;
		}

		if (empty($prop_furnished)) {
			echo "is Furbished is required";
			die;
		}

		if ($prop_floor == '') {
			echo "Floor is required";
			die;
		}

		if ($prop_total_floors == '') {
			echo "Total floors is required";
			die;
		}

		if ($prop_balcony == '') {
			echo "Total balconies is required";
			die;
		}

		if (empty($prop_state)) {
			echo "State is required";
			die;
		}

		if (empty($prop_city)) {
			echo "City is required";
			die;
		}

		if (empty($prop_address)) {
			echo "Address is required";
			die;
		}

		if (empty($prop_price)) {
			echo "Price is required";
			die;
		}

		if (empty($prop_map)) {
			echo "Map is required";
			die;
		}

		$prop_state_name = getState($prop_state, 'st_name');
		$prop_city_name = getCity($prop_city, 'ct_name');
		$prop_cat_name = getCategory($prop_category);
		$prop_scat_name = getsubCat($prop_sub_category, 'sct_name');

		if (!empty($_FILES['prop_img1']['name'])) {
			$file_get_res = upload_doc('prop_img1', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$prop_img1 = substr($file_get_res, 6);
			}
		} elseif (!empty($old_img)) {
			$prop_img1 = $old_img;
		} else {
			echo "Thumbnail image is required";
			die;
		}

		if (!empty($_FILES['prop_brochure']['name'])) {
			$file_get_res = upload_doc('prop_brochure', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$prop_brochure = substr($file_get_res, 6);
			}
		} elseif (!empty($old_brochure)) {
			$prop_brochure = $old_brochure;
		} else {
			echo "Brochure is required";
			die;
		}

		switch ($what) {
			case 'add_property':
				$this->db->query("INSERT INTO `x_home_property` (`prop_name`, `prop_cat`, `prop_scat`, `prop_rent_sale`, `prop_area`, `prop_bedroom`, `prop_bathroom`, `prop_facing`, `prop_furnished`, `prop_floor`, `prop_total_floors`, `prop_balcony`, `prop_price`, `prop_img1`, `prop_desc`,`prop_state`,`prop_city`,`prop_address`,`prop_state_name`,`prop_city_name`, `prop_cat_name`, `prop_scat_name`,`prop_youtube`,`prop_vendor`,`prop_map` ,`prop_brochure`) VALUES ('$prop_name', '$prop_category', '$prop_sub_category', '$prop_rent_sale', '$prop_area', '$prop_bedroom', '$prop_bathroom', '$prop_facing', '$prop_furnished', '$prop_floor', '$prop_total_floors', '$prop_balcony', '$prop_price', '$prop_img1', '$prop_desc', '$prop_state', '$prop_city', '$prop_address', '$prop_state_name', '$prop_city_name', '$prop_cat_name', '$prop_scat_name' , '$prop_youtube','$prop_vendor','$prop_map','$prop_brochure')");

				$inserted_id = $this->db->insert_id();

				// Amenitiies
				$theAmenities = '';
				if (isset($_POST['prop_amenity_list'])) {
					if (count($prop_amenity_list) > 0) {
						@$theAmenities = @implode(',', $prop_amenity_list);

						$get_alllists = $this->db->query("select * from yn_site_tags where stg_tgid IN ($theAmenities) ");
						$allthedetails = $get_alllists->result_array();
						$thelist_de_19o = '';
						foreach ($allthedetails as $thelists_data) {
							$tgid = $thelists_data['stg_tgid'];
							$thelist_de_19o = $thelist_de_19o . ',' . $thelists_data['stg_tgid'];

							$this->db->query("INSERT INTO `x_home_prop_amenity`(`pa_prop_id`,`pa_tag_id`) VALUES ('$inserted_id', '$tgid')");
						}
						@$theAmenities = substr($thelist_de_19o, 1);
					}
				}

				// Facilities
				$theFurnish = '';
				if (isset($_POST['prop_furnish_list'])) {
					if (count($prop_furnish_list) > 0) {
						@$theFurnish = @implode(',', $prop_furnish_list);

						$get_alllists = $this->db->query("select * from yn_site_tags where stg_tgid IN ($theFurnish) ");
						$allthedetails = $get_alllists->result_array();
						$thelist_de_19o1098 = '';
						foreach ($allthedetails as $thelists_data) {
							$tfid = $thelists_data['stg_tgid'];
							$thelist_de_19o1098 = $thelist_de_19o1098 . ',' . $thelists_data['stg_tgid'];

							$this->db->query("INSERT INTO `x_home_prop_furnished`(`pf_prop_id`,`pf_tag_id`) VALUES ('$inserted_id', '$tfid')");
						}
						@$theFurnish = substr($thelist_de_19o1098, 1);
					}
				}

				if ($theFurnish != '') {
					$this->db->query("UPDATE `x_home_property` SET prop_furnish_list='$theFurnish' WHERE `prop_id`='$inserted_id'");
				}

				if ($theAmenities != '') {
					$this->db->query("UPDATE `x_home_property` SET prop_amenity_list='$theAmenities' WHERE `prop_id`='$inserted_id'");
				}

				echo "YNAPS_SUCCESS";
				die;
				break;

			case 'edit_property':
				$this->db->query("UPDATE `x_home_property` SET `prop_name`='$prop_name', `prop_cat`='$prop_category',`prop_brochure`='$prop_brochure' , `prop_scat`='$prop_sub_category', `prop_rent_sale`='$prop_rent_sale', `prop_area`='$prop_area', `prop_bedroom`='$prop_bedroom', `prop_bathroom`='$prop_bathroom', `prop_facing`='$prop_facing', `prop_furnished`='$prop_furnished', `prop_floor`='$prop_floor', `prop_total_floors`='$prop_total_floors', `prop_balcony`='$prop_balcony', `prop_price`='$prop_price', `prop_img1`='$prop_img1', `prop_desc`='$prop_desc', `prop_state`='$prop_state', `prop_city`='$prop_city', `prop_address`='$prop_address', `prop_state_name`='$prop_state_name',`prop_city_name`='$prop_city_name', `prop_cat_name`='$prop_cat_name', `prop_scat_name`='$prop_scat_name' , `prop_youtube`='$prop_youtube' , `prop_vendor`='$prop_vendor' , `prop_map` = '$prop_map' WHERE `prop_id`='$prop_id'");

				$this->db->query("DELETE FROM x_home_prop_amenity WHERE pa_prop_id='$prop_id'");
				$this->db->query("DELETE FROM x_home_prop_furnished WHERE pf_prop_id='$prop_id'");

				// Amenitiies
				$theAmenities = '';
				if (isset($_POST['prop_amenity_list'])) {
					if (count($prop_amenity_list) > 0) {
						@$theAmenities = @implode(',', $prop_amenity_list);

						$get_alllists = $this->db->query("select * from yn_site_tags where stg_tgid IN ($theAmenities) ");
						$allthedetails = $get_alllists->result_array();
						$thelist_de_19o = '';
						foreach ($allthedetails as $thelists_data) {
							$tgid = $thelists_data['stg_tgid'];
							$thelist_de_19o = $thelist_de_19o . ',' . $thelists_data['stg_tgid'];

							$this->db->query("INSERT INTO `x_home_prop_amenity`(`pa_prop_id`,`pa_tag_id`) VALUES ('$prop_id', '$tgid')");
						}
						@$theAmenities = substr($thelist_de_19o, 1);
					}
				}

				// Facilities
				$theFurnish = '';
				if (isset($_POST['prop_furnish_list'])) {
					if (count($prop_furnish_list) > 0) {
						@$theFurnish = @implode(',', $prop_furnish_list);

						$get_alllists = $this->db->query("select * from yn_site_tags where stg_tgid IN ($theFurnish) ");
						$allthedetails = $get_alllists->result_array();
						$thelist_de_19o1098 = '';
						foreach ($allthedetails as $thelists_data) {
							$tfid = $thelists_data['stg_tgid'];
							$thelist_de_19o1098 = $thelist_de_19o1098 . ',' . $thelists_data['stg_tgid'];

							$this->db->query("INSERT INTO `x_home_prop_furnished`(`pf_prop_id`,`pf_tag_id`) VALUES ('$prop_id', '$tfid')");
						}
						@$theFurnish = substr($thelist_de_19o1098, 1);
					}
				}

				if ($theFurnish != '') {
					$this->db->query("UPDATE `x_home_property` SET prop_furnish_list='$theFurnish' WHERE `prop_id`='$prop_id'");
				}

				if ($theAmenities != '') {
					$this->db->query("UPDATE `x_home_property` SET prop_amenity_list='$theAmenities' WHERE `prop_id`='$prop_id'");
				}
				echo "YNAPS_SUCCESS";
				die;
				break;
		}
	}

	// action.php
	public function get_subcategories()
	{
		$categoryId = $this->input->get('cat_id');

		// Fetch the subcategories based on the category ID
		$this->load->database();
		$query = $this->db->query("SELECT * FROM yn_site_sub_cat WHERE sc_ctid = ?", array($categoryId));
		$subcategories = $query->result_array();

		// Return the subcategories as a JSON response
		echo json_encode($subcategories);
	}

	public function delete_property()
	{
		$id = $_GET['delete'];
		// Delete the property from the database
		$this->db->query("DELETE FROM x_home_property WHERE prop_id = '$id'");

		// Redirect to "My Properties" tab
		redirect($_SERVER['HTTP_REFERER']);
	}

	function send_message()
	{
		$receiver_id = $this->input->post('receiver_id');
		@$product_id = $this->input->post('product_id');
		$chat_id = $this->input->post('chat_id');

		$ip = $this->input->ip_address();
		$message = addslashes($this->input->post('msg'));
		// Get Seller Data Start
		$getSellerData = $this->db->query("SELECT name,contact,email FROM yn_site_mem WHERE mid = '$receiver_id'");
		$sellerData = $getSellerData->row_array();
		$receiver_name = $sellerData['name'];
		$receiver_email = $sellerData['email'];
		$mobile = $sellerData['contact'];
		// Get Seller Data End
		$sender_id = $_SESSION['yid'];
		$sender_name = $_SESSION['name'];
	

		if ($chat_id == '') {
			// Get Chat ID
			$getChatUniqID = $this->db->query("SELECT chat_uniq_id FROM x_chat WHERE chat_sender_id = '$sender_id' AND chat_receiver_id = '$receiver_id' AND chat_uniq_id != ''");
			if ($getChatUniqID->num_rows() > 0) {
				$chat_id_detail = $getChatUniqID->row();
				$chat_id = $chat_id_detail->chat_uniq_id;
			} else {
				$chat_id = date('yhis') . '-' . $sender_id . '-' . $receiver_id . (empty($product_id) ? '' : '-' . $product_id);
			}
		}

		if (!empty($_FILES['file_name']['name'])) {
			$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$msg_img = substr($file_get_res, 6);
			}
		} else {
			$msg_img = '';
		}

	    if ($message == '' && $msg_img == '' ) {
			echo 'Please type something first';
			die;
		}
		$last_seen = date('Y-m-d H:i:s');

		$data = array(
			'chat_uniq_id' => $chat_id,
			'chat_sender_id' => $sender_id,
			'chat_receiver_id' => $receiver_id,
			'chat_msg' => $message,
			'chat_product_id' => $product_id,
			'chat_ip' => $ip,
			'chat_attachment' => $msg_img,
			'chat_created_at' => $last_seen
		);
		$this->db->insert('x_chat', $data);

		$sms_mess = "Hello $receiver_name, You've received a new message from " . $sender_name . ' - ' . $message;
		$route = base_url('message?chat=' . $chat_id . '&user=' . $sender_id);

		$site_details = db_variables();
		$site_brief = $site_details['site_brief'];
		$site_name = $site_details['site_name'];
		$site_email = $site_details['site_email'];
		$site_address = $site_details['site_address'];
		$emaillist_act = array("$receiver_email", "$site_email");
		$json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
		$tos = "$receiver_email";
		$subject09 = "New message received!";
		$preheader = "New message received!";
		$greet = "Hi,";
		$message = $sms_mess;
		$link = $route;
		$linkname = 'Browse website';
		$message2 = "$site_brief";
		$greet2 = 'Thank you so much';
		$myName_emailis = "Password Reset";
		$messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
		if ($receiver_email != '') {
			// send_email($tos, $subject09, $messageto90, $site_name, $json_string);
		}

		update_last_seen($last_seen, $sender_id);
		// echo 'YNAPS_SUCCESS1';
		echo 'YNAPS_SUCCESS_MSG';
	}


	// THE MAIN CONTROLER
}
